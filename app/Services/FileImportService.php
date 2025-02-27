<?php

namespace App\Services;

use App\Models\ChartOfAccount;
use App\Models\Currency;
use App\Models\GeneralLedger;
use App\Models\HoldFileRecord;
use App\Models\ImportFiles;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class FileImportService
{
    protected $fileType;
    protected $columns;
    protected $model;
    protected $fileId;

    public function __construct($fileType, $columns, $model)
    {
        $this->fileType = $fileType;
        $this->columns = $columns;
        $this->model = $model;
    }

    /**
     * Process and import the file records.
     *
     */
    public function importFile($filePath, $fileId)
    {
        $csvData = array_map('str_getcsv', file($filePath));
        $header = array_shift($csvData);

        $duplicateRecords = [];
        $uniqueRecords = [];
        $insertedRecords = 0;
        $errors = [];
        $hasValidationErrors = false;

        foreach ($csvData as $rowIndex => $row) {

            $recordData = $this->mapColumnsToData($row, $this->columns);
            $excludeColumns = ['father_name', 'sub_agent', 'reward_amount', 'admin_charges', 'agent_charges'];

            $filteredColumns = array_diff($this->columns, $excludeColumns);

            $missingFields = array_filter($filteredColumns, fn($column) => empty($recordData[$column]));
            if (!empty($missingFields)) {
                $errors[] = [
                    'row' => $rowIndex + 1,
                    'error' => 'Missing fields: ' . implode(', ', $missingFields)
                ];
                $hasValidationErrors = true;
                continue;
            }
            $recordData['admin_charges'] = empty($recordData['admin_charges']) ? null : $recordData['admin_charges'];
            $recordData['agent_charges'] = empty($recordData['agent_charges']) ? null : $recordData['agent_charges'];
            $recordData['reward_amount'] = empty($recordData['reward_amount']) ? null : $recordData['reward_amount'];
            $recordData['merchant_reference'] = empty($recordData['merchant_reference']) ? null : $recordData['merchant_reference'];


            $this->convertDateFormat($recordData, 'date');
            $this->convertDateFormat($recordData, 'posting_date');

            // Validate the record
            $validationResult = $this->validateRecord($recordData, $rowIndex);
            if (!empty($validationResult['errors'])) {
                $errors = array_merge($errors, $validationResult['errors']);
                $hasValidationErrors = true;
                continue;
            }

            if ($this->fileType === 'paid' || $this->fileType === 'hold') {
                $agentAccount = ChartOfAccount::where('prefix', $recordData['agent_name'])->first();
                if (!$agentAccount) {
                    $errors[] = [
                        'row' => $rowIndex + 1,
                        'error' => 'Agent account "' . $recordData['agent_name'] . '" does not exist in ChartOfAccount.'
                    ];
                    $hasValidationErrors = true;
                    continue;
                } else {
                    // Save agent account ID
                    $recordData['agent_id'] = $agentAccount->id;
                }

                // Validate currency account
                $expectedAccountName = 'Unpaid Transactions-' . $recordData['currency'];
                $currencyAccount = ChartOfAccount::where('account_name', $expectedAccountName)->first();
                if (!$currencyAccount) {
                    $errors[] = [
                        'row' => $rowIndex + 1,
                        'error' => 'Account "' . $expectedAccountName . '" does not exist in ChartOfAccount.'
                    ];
                    $hasValidationErrors = true;
                    continue;
                } else {
                    $recordData['customer_id'] = $currencyAccount->id;
                }

                // Validate sending country and its currency
                $sendingCountryCurrency = Currency::whereHas('rate_manager', function ($query) use ($recordData) {
                    $query->where('country', $recordData['sending_country']);
                })->with('rate_manager')->first();

                if (!$sendingCountryCurrency) {
                    $errors[] = [
                        'row' => $rowIndex + 1,
                        'error' => 'Sending country "' . $recordData['sending_country'] . '" does not have a defined currency in Rate Manager.'
                    ];
                    $hasValidationErrors = true;
                    continue;
                } elseif (is_null($sendingCountryCurrency->rate_manager->rate)) {
                    $errors[] = [
                        'row' => $rowIndex + 1,
                        'error' => 'The rate for sending country "' . $recordData['sending_country'] . '" is not updated in Rate Manager.'
                    ];
                    $hasValidationErrors = true;
                    continue;
                }

                // Validate receiving country and its currency
                $receivingCountryCurrency = Currency::whereHas('rate_manager', function ($query) use ($recordData) {
                    $query->where('country', $recordData['receiving_country']);
                })->with('rate_manager')->first();

                if (!$receivingCountryCurrency) {
                    $errors[] = [
                        'row' => $rowIndex + 1,
                        'error' => 'Receiving country "' . $recordData['receiving_country'] . '" does not have a defined currency in Rate Manager.'
                    ];
                    $hasValidationErrors = true;
                    continue;
                } elseif (is_null($receivingCountryCurrency->rate_manager->rate)) {
                    $errors[] = [
                        'row' => $rowIndex + 1,
                        'error' => 'The rate for receiving country "' . $recordData['receiving_country'] . '" is not updated in Rate Manager.'
                    ];
                    $hasValidationErrors = true;
                    continue;
                }
            }
            if ($this->fileType === 'deposit') {
                $creditAccount = ChartOfAccount::where('prefix', $recordData['credit_account_head'])->first();
                if (!$creditAccount) {
                    $errors[] = [
                        'row' => $rowIndex + 1,
                        'error' => 'Credit account "' . $recordData['credit_account_head'] . '" does not exist in ChartOfAccount.'
                    ];
                    $hasValidationErrors = true;
                    continue;
                } else {
                    // Save agent account ID
                    $recordData['credit_account_id'] = $creditAccount->id;
                }
                $agentAccount = ChartOfAccount::where('prefix', $recordData['debit_account_head'])->first();
                if (!$agentAccount) {
                    $errors[] = [
                        'row' => $rowIndex + 1,
                        'error' => 'Debit account "' . $recordData['debit_account_head'] . '" does not exist in ChartOfAccount.'
                    ];
                    $hasValidationErrors = true;
                    continue;
                } else {
                    // Save agent account ID
                    $recordData['debit_account_id'] = $agentAccount->id;
                }
            }


            // Check if trans_id exists in hold table for 'paid' file type
            if ($this->fileType === 'paid') {
                $transIdExists = HoldFileRecord::where('tran_id', $recordData['tran_id'])->exists();
                if (!$transIdExists) {
                    $errors[] = [
                        'row' => $rowIndex + 1,
                        'error' => 'Transaction ID ' . $recordData['tran_id'] . ' does not exist in the hold table.'
                    ];
                    $hasValidationErrors = true;
                    continue;
                }
            }

            // Check for duplicates
            if ($this->fileType != 'deposit' && $this->isDuplicate($recordData)) {
                if (!isset($uniqueRecords[serialize($recordData)])) {
                    $duplicateRecords[] = [
                        'row' => $rowIndex + 1,
                        'data' => $recordData,
                    ];
                    $uniqueRecords[serialize($recordData)] = true;
                }
                continue;
            }

            // Save valid records to the database
            try {
                $recordData['file_id'] = $fileId;
                if ($this->fileType === 'deposit') {
                    $this->saveToGeneralLedger($recordData);
                }
                $this->model::create($recordData);
                $insertedRecords++;
            } catch (\Exception $e) {
                $errors[] = [
                    'row' => $rowIndex + 1,
                    'error' => 'Insert failed: ' . $e->getMessage()
                ];
            }
        }

        // Update the import file status with errors
        ImportFiles::where('id', $fileId)->update([
            'errors' => json_encode(['errors' => $errors, 'duplicates' => $duplicateRecords]),
        ]);

        if ($insertedRecords === 0) {
            // ImportFiles::destroy($fileId);
            return [
                'status' => 'error',
                'message' => 'No records were saved. Please check the errors for details.',
                'errors' => $errors,
                'duplicate_records' => $duplicateRecords,
                'inserted_records' => 0,
            ];
        }

        return [
            'status' => 'success',
            'message' => 'File imported successfully.',
            'inserted_records' => $insertedRecords,
            'duplicate_records' => $duplicateRecords,
        ];
    }

    private function validateRecord($recordData, $rowIndex)
    {
        $validationRules = $this->getValidationRules($this->fileType);
        $validator = Validator::make($recordData, $validationRules);
        if ($validator->fails()) {
            return [
                'errors' => collect($validator->errors()->messages())->map(function ($messages, $field) use ($rowIndex) {
                    return [
                        'row' => $rowIndex + 1,
                        'error' => $field . ': ' . implode(', ', $messages),
                    ];
                })->toArray(),
            ];
        }
        return ['errors' => []];
    }



    protected function saveToGeneralLedger(array $recordData): void
    {
        $currentTimestamp = now();

        $creditAccount = ChartOfAccount::where('id', $recordData['credit_account_id'])->first();
        $debitAccount = ChartOfAccount::where('id', $recordData['debit_account_id'])->first();

        if (!$creditAccount || !$debitAccount) {
            throw new \Exception('Credit or Debit account not found.');
        }

        GeneralLedger::create([
            'account_name' => $creditAccount->account_name,
            'account_id' => $creditAccount->id,
            'debit' => null,
            'credit' => $recordData['credit_amount'],
            'details' => $recordData['details'],
            'approved_by' => Auth::id(),
            'voucher_no' => 123,
            'approved_at' => $currentTimestamp,
            'file_type' => 'deposit',
        ]);

        $creditAccount->balance += $recordData['credit_amount'];
        $creditAccount->save();

        GeneralLedger::create([
            'account_name' => $debitAccount->account_name,
            'account_id' => $debitAccount->id,
            'debit' => $recordData['debit_amount'],
            'credit' => null,
            'details' => $recordData['details'],
            'approved_by' => Auth::id(),
            'voucher_no' => 123,
            'approved_at' => $currentTimestamp,
            'file_type' => 'deposit',
        ]);

        $debitAccount->balance -= $recordData['debit_amount'];
        $debitAccount->save();
    }

    private function convertDateFormat(&$recordData, $field)
    {
        if (isset($recordData[$field]) && !empty($recordData[$field])) {
            if (strpos($recordData[$field], '/') !== false) {
                $recordData[$field] = Carbon::createFromFormat('d/m/Y', $recordData[$field])->format('Y-m-d');
            } elseif (strpos($recordData[$field], '-') !== false) {
                $recordData[$field] = Carbon::createFromFormat('d-m-Y', $recordData[$field])->format('Y-m-d');
            }
        }
    }




    protected function getValidationRules($fileType)
    {
        switch ($fileType) {
            case 'hold':
                return [
                    'file_id' => 'nullable|exists:import_files,id',
                    'agent_id' => 'nullable|string',
                    'agent_name' => 'nullable|string',
                    'customer_id' => 'nullable|string',
                    'customer_name' => 'nullable|string',
                    'tran_id' => 'nullable|string',
                    'beneficiary_name' => 'nullable|string',
                    'phone' => 'nullable|string',
                    'address' => 'nullable|string',
                    'city' => 'nullable|string',
                    'code' => 'nullable|string',
                    'currency' => 'nullable|string',
                    'fc_amount' => 'nullable|numeric',
                    'main_agent_rate' => 'nullable|numeric',
                    'pounds' => 'nullable|numeric',
                    'payment_no' => 'nullable|string',
                    'date' => 'nullable|date',
                    'bene_payment_method' => 'nullable|string',
                    'sending_country' => 'nullable|string',
                    'receiving_country' => 'nullable|string',
                    'rate' => 'nullable|numeric',
                    'transaction_payment_method' => 'nullable|string',
                    'merchant_reference' => 'nullable|string',
                ];

            case 'deposit':
                return [
                    'file_id' => 'nullable|exists:import_files,id',
                    'credit_account_head' => 'nullable|string',
                    'credit_amount' => 'nullable|numeric',
                    'type' => 'nullable|string',
                    'details' => 'nullable|string',
                    'debit_account_head' => 'nullable|string',
                    'debit_amount' => 'nullable|numeric',
                    'lc_amount' => 'nullable|numeric',
                    'posting_date' => 'nullable|date',
                ];

            case 'paid':
                return [
                    'file_id' => 'nullable|exists:import_files,id',
                    'agent_id' => 'nullable|string',
                    'agent_name' => 'nullable|string',
                    'customer_id' => 'nullable|string',
                    'customer_name' => 'nullable|string',
                    'tran_id' => 'nullable|string',
                    'recipient' => 'nullable|string',
                    'phone' => 'nullable|string',
                    'address' => 'nullable|string',
                    'city' => 'nullable|string',
                    'code' => 'nullable|string',
                    'currency' => 'nullable|string',
                    'fc_amount' => 'nullable|numeric',
                    'rate' => 'nullable|numeric',
                    'pounds' => 'nullable|numeric',
                    'payment_no' => 'nullable|string',
                    'date' => 'nullable|date',
                    'buyer_rate' => 'nullable|numeric',
                    'buyer' => 'nullable|string',
                    'buyer_rate_sc' => 'nullable|numeric',
                    'buyer_rate_dc' => 'nullable|numeric',
                    'bene_payment_method' => 'nullable|string',
                    'sending_country' => 'nullable|string',
                    'receiving_country' => 'nullable|string',
                    'company_name' => 'nullable|string',
                    'posting_date' => 'nullable|date',
                ];

            default:
                return [];
        }
    }



    /**
     * Map CSV columns to the database columns.
     *
     * @param array $row
     * @param array $columns
     * @return array
     */
    protected function mapColumnsToData(array $row, array $columns)
    {

        $mappedData = [];
        foreach ($columns as $key => $dbColumn) {
            $mappedData[$dbColumn] = $row[$key] ?? null;
        }
        return $mappedData;
    }

    /**
     * Check if a record is a duplicate based on TRAN ID or other unique field.
     *
     * @param array $recordData
     * @return bool
     */
    protected function isDuplicate($recordData)
    {
        return $this->model::where('tran_id', $recordData['tran_id'])->exists();
    }
}
