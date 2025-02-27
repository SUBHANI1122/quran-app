@extends('layouts/layoutMaster')

@section('title', 'Rates - AMS')

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
'resources/js/rate-updates.js'])

@endsection

@section('content')



<!-- Advanced Search -->
<div class="card">
    <h5 class="card-header">Rates

    </h5>
    <!-- Search Form -->
    <div class="card-body">
        <form class="dt_adv_search">
            <div class="row">
                <div class="col-12 col-md-2">
                    <label class="form-label" for="currency">Posted Date</label>
                    <input type="date" class="form-control" name="date" id="date">
                </div>
                <div class="col-12 col-sm-6 col-lg-2">
                    <label class="form-label">Code:</label>
                    <input type="text" class="form-control dt-input" data-column="1" placeholder="Enter Code" name="code" id="code" data-column-index="0">
                </div>
                <div class="col-12 col-sm-6 col-lg-4">
                    <label class="form-label">Currency Name:</label>
                    <input type="text" class="form-control dt-input" data-column="2" placeholder="Enter Currency Name" name="currency" id="currency" data-column-index="1">
                </div>
                <div class="col-12 col-sm-6 col-lg-2">
                    <label class="form-label">Status:</label>
                    <select class="form-control" data-column-index="6" name="status" id="statuss">
                        <option value="">Select Status</option>
                        <option value="1">Active</option>
                        <option value="0">In-Active</option>
                    </select>
                </div>
                <div class="col-12 col-sm-6 col-lg-2">
                    <label class="form-label">Per Page:</label>
                    <select class="form-control" data-column="4" name="per_page" id="per_page" data-column-index="3">
                        <option value="">Per Page</option>
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>

        </form>
    </div>
    <div class="card-datatable table-responsive">
        <table class=" table datatables-rate-update">
            <thead>
                <tr>

                    <th>Code</th>
                    <th>Name</th>
                    <th>Country</th>
                    <th>Type</th>
                    <th>Min Rate Limit</th>
                    <th>Max Rate Limit</th>
                    <th>Status</th>
                    <td>Rate</td>
                    <th></th>
                    <th>Actions</th>

                </tr>
            </thead>
            <tfoot>
                <tr>

                    <th>Code</th>
                    <th>Name</th>
                    <th>Country</th>
                    <th>Type</th>
                    <th>Min Rate Limit</th>
                    <th>Max Rate Limit</th>
                    <th>Status</th>
                    <td>Rate</td>
                    <th></th>
                    <th>Actions</th>

                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection