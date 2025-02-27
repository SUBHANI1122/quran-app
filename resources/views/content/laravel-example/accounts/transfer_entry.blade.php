@extends('layouts/layoutMaster')

@section('title', 'Transfer Entry - AMS')

<!-- Vendor Styles -->
@section('vendor-style')
@vite([
'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
'resources/assets/vendor/libs/flatpickr/flatpickr.scss',
'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss',
'resources/assets/vendor/libs/dropzone/dropzone.scss'
])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
@vite([
'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
'resources/assets/vendor/libs/moment/moment.js',
'resources/assets/vendor/libs/flatpickr/flatpickr.js',
'resources/assets/vendor/libs/sweetalert2/sweetalert2.js',
'resources/assets/vendor/libs/dropzone/dropzone.js'
])
@endsection

<!-- Page Scripts -->
@section('page-script')
@vite([
'resources/assets/js/tables-datatables-advanced.js',
'resources/js/modal-add-transfer-entry.js',
'resources/assets/js/form-input-group.js'
])

@endsection

@section('content')


<!-- Advanced Search -->
<div class="card">
    <div class="d-flex justify-content-between align-items-center m-5">
        <h5 class="mb-0">Transfer Entries</h5>
        <button type="button" class="btn btn-primary add-new" data-bs-toggle="modal" data-bs-target="#addTransferEntry">Add Transfer Entry</button>
    </div>
    <div class="card-datatable table-responsive">
        <table class="table table-bordered table-striped" style="text-align: center;">
            <thead>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="2">FC</td>
                    <td colspan="2">LC</td>
                    <td></td>
                </tr>
                <tr>
                    <td>#</td>
                    <td>Account Name</td>
                    <td>Description</td>
                    <td>Currency</td>
                    <td>Debit</td>
                    <td>Credit</td>
                    <td>Debit</td>
                    <td>Credit</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @php
                $totalFcDebit = 0;
                $totalFcCredit = 0;
                $totalLcDebit = 0;
                $totalLcCredit = 0;
                @endphp

                @foreach ($transferEntries as $key => $transferEntry)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $transferEntry->account->account_name }}</td>
                    <td>{{ $transferEntry->description }}</td>
                    <td>{{ $transferEntry->account->currency->currency }}</td>
                    <td>
                        @if ($transferEntry->type == 'debit')
                        {{ $transferEntry->fc }}
                        @php $totalFcDebit += $transferEntry->fc; @endphp
                        @endif
                    </td>
                    <td>
                        @if ($transferEntry->type == 'credit')
                        {{ $transferEntry->fc }}
                        @php $totalFcCredit += $transferEntry->fc; @endphp
                        @endif
                    </td>
                    <td>
                        @if ($transferEntry->type == 'debit')
                        {{ $transferEntry->lc }}
                        @php $totalLcDebit += $transferEntry->lc; @endphp
                        @endif
                    </td>
                    <td>
                        @if ($transferEntry->type == 'credit')
                        {{ $transferEntry->lc }}
                        @php $totalLcCredit += $transferEntry->lc; @endphp
                        @endif
                    </td>
                    <td class="text-center">
                        <!-- Edit and Delete Buttons -->
                        <button class="btn btn-sm btn-primary edit-record" data-id="{{ $transferEntry->id }}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger delete-record" data-id="{{ $transferEntry->id }}">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" style="text-align: right;">Total:</td>
                    <td></td>
                    <td></td>
                    <td>{{ $totalLcDebit }}</td>
                    <td>{{ $totalLcCredit }}</td>
                    @if (bccomp((string)$totalLcDebit, (string)$totalLcCredit, 2) === 0)
                    <td>
                        <button class="btn btn-sm post-record btn-primary">
                            Post
                        </button>
                    </td>
                    @endif
                </tr>
                @if (bccomp((string)$totalLcDebit, (string)$totalLcCredit, 2) !== 0)
                <tr>
                    <td colspan="9">
                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <span>You cannot post the entry until the sum of debit and credit are the same.</span>
                        </div>
                    </td>
                </tr>
                @endif
            </tfoot>




        </table>
    </div>
</div>
<!-- /Advanced Search -->
@include('_partials/_modals/modal-transfer-entry')

@endsection