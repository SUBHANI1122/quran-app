@extends('layouts/layoutMaster')

@section('title', 'Payment List - AMS')

<!-- Vendor Styles -->
@section('vendor-style')
@vite([
'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss',
'resources/assets/vendor/libs/select2/select2.scss',
'resources/assets/vendor/libs/@form-validation/form-validation.scss',
'resources/assets/vendor/libs/animate-css/animate.scss',
'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'
])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
@vite([
'resources/assets/vendor/libs/moment/moment.js',
'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
'resources/assets/vendor/libs/select2/select2.js',
'resources/assets/vendor/libs/@form-validation/popular.js',
'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
'resources/assets/vendor/libs/@form-validation/auto-focus.js',
'resources/assets/vendor/libs/cleavejs/cleave.js',
'resources/assets/vendor/libs/cleavejs/cleave-phone.js',
'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'
])
@endsection

<!-- Page Scripts -->
@section('page-script')
@vite(['resources/js/payment-list.js'])
@endsection

@section('content')

<div class="row g-6 mb-6">
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span class="text-heading">No of Transactions</span>
                        <div class="d-flex align-items-center my-1">
                            <h4 class="mb-0 me-2">{{$totalTransactions}}</h4>
                            <p class="text-success mb-0"></p>
                        </div>
                        <small class="mb-0">Total Transactions</small>
                    </div>
                    <div class="avatar">
                        <span class="avatar-initial rounded bg-label-primary">
                            <i class="ti ti-user ti-26px"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <spanclass="text-heading">Total Volume</span>
                            <div class="d-flex align-items-center my-1">
                                <h4 class="mb-0 me-2">{{$totalTransactions}}</h4>
                                <p class="text-success mb-0"></p>
                            </div>
                            <small class="mb-0">Total Volume</small>
                    </div>
                    <div class="avatar">
                        <span class="avatar-initial rounded bg-label-success">
                            <i class="ti ti-user-check ti-26px"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span class="text-heading">Total Hold Transactions</span>
                        <div class="d-flex align-items-center my-1">
                            <h4 class="mb-0 me-2">{{$holdFileRecords}}</h4>
                            <p class="text-success mb-0"></p>
                        </div>
                        <small class="mb-0">Total Hold Transactions</small>
                    </div>
                    <div class="avatar">
                        <span class="avatar-initial rounded bg-label-danger">
                            <i class="ti ti-users ti-26px"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span class="text-heading">Total Cancel Transactions</span>
                        <div class="d-flex align-items-center my-1">
                            <h4 class="mb-0 me-2">{{$holdFileRecords}}</h4>
                            <p class="text-danger mb-0"></p>
                        </div>
                        <small class="mb-0">Total Cancel Transactions</small>
                    </div>
                    <div class="avatar">
                        <span class="avatar-initial rounded bg-label-warning">
                            <i class="ti ti-user-search ti-26px"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span class="text-heading">Total Paid Transactions</span>
                        <div class="d-flex align-items-center my-1">
                            <h4 class="mb-0 me-2">{{$paidFileRecords}}</h4>
                            <p class="text-danger mb-0"></p>
                        </div>
                        <small class="mb-0">Total Paid Transactions</small>
                    </div>
                    <div class="avatar">
                        <span class="avatar-initial rounded bg-label-warning">
                            <i class="ti ti-user-search ti-26px"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Users List Table -->
<div class="card">
    <div class="card-header border-bottom">
        <h5 class="card-title mb-0">Payment List</h5>
    </div>
    <div class="card-body">
        <form class="dt_adv_search" method="POST">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-3">
                    <label class="form-label">Payment #</label>
                    <input type="text" class="form-control dt-input" data-column="1" placeholder="Enter payment_no" name="payment_no" id="payment_no" data-column-index="2">
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <label class="form-label">Invoice #</label>
                    <input type="text" class="form-control dt-input" data-column="2" placeholder="Enter Invoice No" name="invoice_no" id="invoice_no" data-column-index="1">
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <label class="form-label">Sending Country:</label>
                    <select id="sending_country_id" name="sending_country_id" class="select2 form-select" data-allow-clear="true">
                        <option value="">Select Country</option>
                        @foreach ($currencies as $currency)
                        <option value="{{$currency->id}}" data-symbol="{{$currency->currency}}" data-name="{{$currency->name}}">{{$currency->country}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <label class="form-label">Receiving Country:</label>
                    <select id="receiving_country_id" name="receiving_country_id" class="select2 form-select" data-allow-clear="true">
                        <option value="">Select Country</option>
                        @foreach ($currencies as $currency)
                        <option value="{{$currency->id}}" data-symbol="{{$currency->currency}}" data-name="{{$currency->name}}">{{$currency->country}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-3">
                    <label class="form-label">File Date Range:</label>
                    <select class="form-control" data-column-index="6" name="file_type" id="file_type">
                        <option value="">Select file</option>
                        <option value="hold" selected>Hold</option>
                        <option value="paid">Paid</option>
                        <option value="cancel">Cancel</option>
                    </select>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <label class="form-label">Posting Date From:</label>
                    <input type="date" class="form-control dt-input" data-column="3" name="posting_date_from" id="posting_date_from" data-column-index="6">
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <label class="form-label">Posting Date To:</label>
                    <input type="date" class="form-control dt-input" data-column="3" name="poting_date_to" id="poting_date_to" data-column-index="6">
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <label class="form-label">Status:</label>
                    <select class="form-control" data-column-index="6" name="status" id="statuss">
                        <option value="">Select Status</option>
                        <option value="posted">Posted</option>
                        <option value="not_posted">Not Posted</option>
                        <option value="canceled">Canceled</option>
                    </select>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <button type="button" class="btn btn-primary" id="searchBtn">Search</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-header">
        <button id="process-button" class="btn btn-primary float-end">Process</button>
    </div>
    <div class="card-datatable table-responsive">

        <table class="datatables-users table">
            <thead class="border-top">
                <tr>
                    <th>#</th>
                    <th>Invoice #</th>
                    <th>Payment #</th>
                    <th>Agent</th>
                    <th>Sending Country</th>
                    <th>Receiving Country</th>
                    <th>Sending LC</th>
                    <th>Sending FC</th>
                    <th>Receiving Amount</th>
                    <th>FX Margin</th>
                    <th>File Date</th>
                    <th>Status</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection