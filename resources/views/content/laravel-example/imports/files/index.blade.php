@extends('layouts/layoutMaster')

@section('title', 'Currencies - AMS')

@section('vendor-style')
@vite([
'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
'resources/assets/vendor/libs/flatpickr/flatpickr.scss',
'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'
])
@endsection

@section('vendor-script')
@vite([
'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
'resources/assets/vendor/libs/moment/moment.js',
'resources/assets/vendor/libs/flatpickr/flatpickr.js',
'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'
])
@endsection

@section('page-script')
@vite(['resources/assets/js/tables-datatables-advanced.js', 'resources/js/import-files.js'])
@endsection

@section('content')
<div class="card shadow-sm">
    <!-- Error Messages -->
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('errors'))
    <div class="alert alert-danger">
        <strong>Validation Errors:</strong>
        <ul>
            @foreach(session('errors') as $error)
            <li>
                Row {{ $error['row'] }}{{ isset($error['field']) ? ', Column ' . $error['field'] : '' }}: {{ $error['error'] }}
            </li> @endforeach
        </ul>
    </div>
    @endif

    @if(session('duplicate_records'))
    <div class="alert alert-warning">
        <strong>Duplicate Records:</strong>
        <ul>
            @foreach(session('duplicate_records') as $duplicate)
            <li>Row: {{ $duplicate['row'] }} - Data: {{ json_encode($duplicate['data']) }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- File Import Form -->
    <div class="card-body">
        <form action="{{ route('importFile.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="file" class="form-label">Select File:</label>
                <input type="file" name="file" class="form-control" id="file" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">
                <i class="ti ti-upload mr-1"></i> Import File
            </button>
        </form>
    </div>
    <div class="card-body pt-0">
        <div class="card-datatable table-responsive">
            <table class="table datatables-files">
                <thead>
                    <tr>
                        <th>File Name</th>
                        <th>Added By</th>
                        <th>Created At</th>
                        <th>Total Records</th>
                        <th>File Type</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dynamic content here -->
                </tbody>
                <tfoot>
                    <tr>
                        <th>File Name</th>
                        <th>Added By</th>
                        <th>Created At</th>
                        <th>Total Records</th>
                        <th>File Type</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- SweetAlert for Success/Error Messages -->
<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: "{{ session('success') }}",
            confirmButtonClass: 'btn btn-success'
        });
        @endif

        @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: "{{ session('error') }}",
            confirmButtonClass: 'btn btn-danger'
        });
        @endif
    });
</script> -->

@endsection