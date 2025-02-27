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
'resources/js/temp-transfer-entry.js',
'resources/assets/js/form-input-group.js'
])

@endsection

@section('content')


<!-- Advanced Search -->
<div class="card">
    <div class="d-flex justify-content-between align-items-center m-5">
        <h5 class="mb-0">Temp Transfer Entries</h5>
    </div>
    <div class="container mt-4">

        @forelse ($transferEntries as $postingDate => $entries)
        <div class="mt-4">
            <h5>Entries for {{ \Carbon\Carbon::parse($postingDate)->format('d M Y') }}</h5>
            <table class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Account Name</th>
                        <th>Description</th>
                        <th>Currency</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Posting Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($entries as $key => $entry)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $entry->account->account_name }}</td>
                        <td>{{ $entry->description }}</td>
                        <td>{{ $entry->account->currency->currency }}</td>
                        <td>{{ $entry->fc }}</td>
                        <td>{{ $entry->lc }}</td>
                        <td>{{ \Carbon\Carbon::parse($entry->posting_date)->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">No records found for this date.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <br>
            <div class="text-center">
                <button id="test-delete" class="btn btn-sm btn-danger delete-group" data-date="{{ $postingDate }}">Delete All</button>
                <button class="btn btn-sm btn-success approve-group" data-date="{{ $postingDate }}">Approve All</button>
            </div>
        </div>
        @empty
        <div class="alert alert-info text-center mt-4">
            <strong>No transfer entries available.</strong>
        </div>
        @endforelse
    </div>

</div>

@endsection