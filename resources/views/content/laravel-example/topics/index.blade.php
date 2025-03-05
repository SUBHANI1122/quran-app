@extends('layouts/layoutMaster')

@section('title', 'Topics - Quran App')

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
'resources/js/topics.js'])

@endsection

@section('content')



<!-- Advanced Search -->
<div class="card">
    <div class="d-flex justify-content-between align-items-center m-5">
        <h5 class="mb-0">Topics</h5>
        <a href="{{ route('topic.create') }}" class="btn btn-primary add-new">Add Topic</a>
    </div>
    <div class="card-datatable table-responsive">
        <table class="table datatables-topics">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Topic Name</th>
                    <th>Description</th>
                    <th>Ayah Count</th>
                    <th>Hadith Count</th>
                </tr>
            <tbody>
                @foreach($topics as $index => $topic)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $topic->name }}</td>
                    <td>{{ $topic->description }}</td>
                    <td>{{ $topic->ayahs_count }}</td>
                    <td>{{ $topic->hadiths_count }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection