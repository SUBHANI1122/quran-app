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
<script>
    const fileId = {{$file_id}};
</script>
@vite(['resources/assets/js/tables-datatables-advanced.js', 'resources/js/hold-files.js'])

@endsection

@section('content')
<div class="container">
    <h2>Records for {{ $file->file_name }} </h2>
    <div class="alert alert-warning">
        <strong>Duplicate Records:</strong>
        <ul>
            @php
            $duplicateRecords = json_decode($file->errors, true);

            @endphp

            @if(is_array($duplicateRecords) && !empty($duplicateRecords))
            @foreach($duplicateRecords['duplicates'] as $duplicate)
            @if(isset($duplicate['row']) && isset($duplicate['data']))
            <li>At Row: {{ $duplicate['row'] }} - Records are duplicate</li>
            @else
            <li>Invalid record format.</li>
            @endif
            @endforeach
            @else
            <li>No duplicate records found.</li>
            @endif
        </ul>
    </div>




    <table class="table hold-file-datatable">
        <thead>
            <tr>
                <th>#</th>
                <th>Status</th>
                <th>Agent</th>
                <th>Payment</th>
                <th>LC Amount</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
            <tr>
                <th>#</th>
                 <th>Status</th>
                <th>Agent</th>
                <th>Payment</th>
                <th>LC Amount</th>
                <th>Date</th>
            </tr>
        </tfoot>
    </table>
</div>
@endsection