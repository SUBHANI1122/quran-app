@extends('layouts/layoutMaster')

@section('title', 'Chart of Account - AMS')

<!-- Vendor Styles -->
@section('vendor-style')
@vite([
'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
'resources/assets/vendor/libs/flatpickr/flatpickr.scss',
'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'
])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
@vite([
'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
'resources/assets/vendor/libs/moment/moment.js',
'resources/assets/vendor/libs/flatpickr/flatpickr.js',
'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'
])
@endsection

<!-- Page Scripts -->
@section('page-script')
@vite([
'resources/assets/js/tables-datatables-advanced.js',
'resources/js/modal-general-ledger.js'])

@endsection

@section('content')



<!-- Advanced Search -->
<div class="card">
    <div class="d-flex justify-content-between align-items-center m-5">
        <h5 class="mb-0">General Ledger</h5>
    </div>
    <!-- Search Form -->
    <div class="card-body">
        <form class="dt_adv_search" method="POST">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-2">
                    <label class="form-label">Account Nem</label>
                    <select class="form-control select2" data-column-index="6" name="account_name" id="account_name">
                        <option value="">Select Account</option>
                        @foreach ($accounts as $account)
                        <option value="{{$account->account_name}}">{{$account->account_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-sm-6 col-lg-4">
                    <label class="form-label">From:</label>
                    <input type="date" class="form-control dt-input" data-column="2" placeholder="Enter Account Name" name="date_from" id="date_from" data-column-index="1">
                </div>
                <div class="col-12 col-sm-6 col-lg-4">
                    <label class="form-label">To:</label>
                    <input type="date" class="form-control dt-input" data-column="3" placeholder="Enter Account Name" name="date_to" id="date_to" data-column-index="6">
                </div>
                <div class="row mt-3">
                    <div class="col-2">
                        <button type="button" class="btn btn-primary" id="searchBtn">Search</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
    <div class="card-datatable table-responsive">
        <table class="table datatables-general-ledger">
            <thead>
                <tr>

                    <th>V.No</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Debit</th>
                    <th>Credit</th>
                    <th>Balance</th>

                </tr>
            </thead>
            <tfoot>
                <tr>

                    <th>V.No</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Debit</th>
                    <th>Credit</th>
                    <th>Balance</th>

                </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- Modal -->
<div id="generalLedger" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">General Ledger Details</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Voucher Information -->
                <div class="mb-4">
                    <h6 class="text-muted">Voucher Information</h6>
                    <table id="date-user-details" class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>Voucher No</th>
                                <th>Approved By</th>
                                <th>Approved At</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

                <!-- Account Details -->
                <div>
                    <h6 class="text-muted">Account Details</h6>
                    <table id="account-details" class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>Account Name</th>
                                <th class="text-end">FC Amount</th>
                                <th class="text-end">Debit Amount</th>
                                <th class="text-end">Credit Amount</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>




@endsection