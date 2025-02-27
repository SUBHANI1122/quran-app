@extends('layouts/layoutMaster')

@section('title', 'Classifications - AMS')

<!-- Vendor Styles -->
@section('vendor-style')
@vite(['resources/assets/vendor/libs/jstree/jstree.scss',
'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
'resources/assets/vendor/libs/flatpickr/flatpickr.scss',
'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'])

<style>
    /* General table styles */
    /* General table styles */
    table {
        width: 100%;
        border-collapse: collapse;
        /* background-color: #fff; */
        margin-bottom: 20px;
        /* box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.1); */
    }

    table th,
    table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        font-size: 16px;
        color: #333;
    }

    /* Header styles */
    table th {
        /* background-color: #f5f5f5; */
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Row hover effect */
    /* table tr {
        transition: background-color 0.3s ease;
    } */

    table tr:hover {
        background-color: #f1f9ff;
        /* Soft blue hover */
        cursor: pointer;
    }

    /* Level-specific styles for indentation */
    table tr.level-0 td {
        font-weight: bold;
        /* background-color: #e8f4fa; */
    }

    table tr.level-1 td:nth-child(1),
    table tr.level-2 td:nth-child(1),
    table tr.level-3 td:nth-child(1),
    table tr.level-4 td:nth-child(1) {
        padding-left: 30px;
        /* Increase indentation for first-level child */
    }

    table tr.level-2 td:nth-child(1) {
        padding-left: 50px;
        /* Increase indentation for second-level child */
    }

    table tr.level-3 td:nth-child(1) {
        padding-left: 70px;
        /* Increase indentation for third-level child */
    }

    table tr.level-4 td:nth-child(1) {
        padding-left: 90px;
        /* Increase indentation for fourth-level child */
    }

    /* Add float right style for child rows */
    table tr.level-1,
    table tr.level-2,
    table tr.level-3,
    table tr.level-4 {
        text-align: right;
        /* Align child rows to the right */
    }

    /* Responsive styling */
    @media (max-width: 768px) {

        table th,
        table td {
            padding: 10px;
            font-size: 14px;
        }
    }
</style>
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
@vite(['resources/assets/vendor/libs/jstree/jstree.js',
'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
'resources/assets/vendor/libs/moment/moment.js',
'resources/assets/vendor/libs/flatpickr/flatpickr.js',
'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'])
@endsection

<!-- Page Scripts -->
@section('page-script')
@vite('resources/js/extended-ui-treeview.js')
@endsection

@php
// Recursive function to render parent and child rows
function renderClassification($classification, $parent_id = null, $level = 0) {
foreach ($classification as $item) {
if ($item->parent_id == $parent_id) {
$indent = str_repeat('&nbsp;', $level * 4);

echo '<tr class="level-' . $level . ' parent-row" data-id="' . $item->id . '" data-parent-id="' . $item->parent_id . '">';
    echo '<td>' . $indent . $item->name . '</td>';
    echo '<td>' . $item->code . '</td>';
    echo '<td>' . ($item->status == 1
        ? '<span class="badge bg-success">Active</span>'
        : '<span class="badge bg-danger">Inactive</span>') . '</td>';

    echo '<td>
        <div class="d-flex align-items-center gap-50">
            <button class="btn btn-sm btn-icon edit-record btn-text-secondary rounded-pill waves-effect" data-id="' . $item->id . '" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser">
                <i class="ti ti-edit"></i>
            </button>
        </div>
    </td>';

    echo '</tr>';
renderClassification($classification, $item->id, $level + 1);
}
}
}
@endphp


@section('content')

<!-- JSTree -->
<div class="card">
    <div class="d-flex justify-content-between align-items-center m-5">
        <h5 class="mb-0">Classification</h5>
        <button type="button" class="btn btn-primary add-new" data-bs-toggle="modal" data-bs-target="#addAccountClassification"> Add Classification</button>
    </div>
    <div class="card-datatable table-responsive">
        <table class=" table datatables-classifications">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="classification-tree">
                <!-- Start rendering classification from the top level (parent_id = null) -->
                @php
                renderClassification($classification);
                @endphp
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

@include('_partials/_modals/modal-acount-classification')

@endsection