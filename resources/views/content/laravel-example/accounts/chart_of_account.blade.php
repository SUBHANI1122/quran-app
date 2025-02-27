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
'resources/js/modal-add-chart-of-account.js'])

@endsection

@section('content')



<!-- Advanced Search -->
<div class="card">
    <div class="d-flex justify-content-between align-items-center m-5">
        <h5 class="mb-0">Chart of Account</h5>
        <button type="button" class="btn btn-primary add-new" data-bs-toggle="modal" data-bs-target="#addChartofAccount"> Add Chart of Account</button>
    </div>
    <!-- Search Form -->
    <div class="card-body">
        <form class="dt_adv_search" method="POST">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-2">
                    <label class="form-label">Prefix</label>
                    <input type="text" class="form-control dt-input" data-column="1" placeholder="Enter Prefix" name="prefix" id="prefix" data-column-index="2">
                </div>
                <div class="col-12 col-sm-6 col-lg-4">
                    <label class="form-label">Account Name:</label>
                    <input type="text" class="form-control dt-input" data-column="2" placeholder="Enter Account Name" name="account_name" id="account_name" data-column-index="1">
                </div>
                <div class="col-12 col-sm-6 col-lg-4">
                    <label class="form-label">Country Code:</label>
                    <input type="text" class="form-control dt-input" data-column="3" placeholder="Enter Account Name" name="currency" id="currency" data-column-index="6">
                </div>
                <div class="col-12 col-sm-6 col-lg-2">
                    <label class="form-label">Status:</label>
                    <select class="form-control" data-column-index="6" name="status" id="statuss">
                        <option value="">Select Status</option>
                        <option value="1">Active</option>
                        <option value="0">In-Active</option>
                    </select>
                </div>
            </div>

        </form>
    </div>
    <div class="card-datatable table-responsive">
        <table class="table datatables-chart-of-account">
            <thead>
                <tr>

                    <th>Code</th>
                    <th>Name</th>
                    <th>Prefix</th>
                    <th>Type</th>
                    <th>Classification</th>
                    <th>Country</th>
                    <th>Currency</th>
                    <td>Status</td>
                    <th></th>

                </tr>
            </thead>
            <tfoot>
                <tr>

                    <th>Code</th>
                    <th>Name</th>
                    <th>Prefix</th>
                    <th>Type</th>
                    <th>Classification</th>
                    <th>Country</th>
                    <th>Currency</th>
                    <td>Status</td>
                    <th></th>

                </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- /Advanced Search -->
@include('_partials/_modals/modal-chart-of-account')
@endsection