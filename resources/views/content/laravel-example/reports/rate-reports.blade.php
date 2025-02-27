@extends('layouts/layoutMaster')

@section('title', 'Rate Reports - AMS')

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
'resources/js/report-rate.js'])

@endsection

@section('content')
<style>
    .datatables-report-rate th:first-child, .datatables-report-rate td:first-child {
    min-width: 100px !important; /* Set the width you want here */
    max-width: 100px !important;
    word-break: break-word; /* Optionally break long words */
}
</style>


<!-- Advanced Search -->
<div class="card">
<div class="d-flex justify-content-between align-items-center m-5 csv-report">
    <h5 class="mb-0">Rate Reports</h5>
    {{-- <button type="button" class="btn btn-primary" id="export-csv" >Export to CSV</button> --}}
</div>

    <!-- Search Form -->
    <div class="card-body">
        <form class="dt_adv_search" method="GET" action="{{ route('rates.report.get') }}">
            @csrf
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-2">
                    <label class="form-label">From:</label>
                    <input type="date" class="form-control dt-input" data-column="1"  name="from" id="from" data-column-index="0" value="{{ $from ?? '' }}">
                </div>
                <div class="col-12 col-sm-6 col-lg-2">
                    <label class="form-label">To:</label>
                    <input type="date" class="form-control dt-input" data-column="1"  name="to" id="to" data-column-index="0" value="{{ $to ?? '' }}">
                </div>
                <div class="col-12 col-sm-6 col-lg-2">
                    <label for="" class="form-label"></label>
                    <button class="form-control" type="submit">Search</button>
                </div>
                <div class="col-12 col-sm-6 col-lg-2">
                    <label for="" class="form-label"></label>
                    <a href="{{ route('rates.report') }}" class="form-control text-center text-decoration-none" type="button">Reset</a>
                </div>
            </div>
        </form>
    </div>
    <div class="card-datatable table-responsive">
        <table class="table datatables-report-rate">
            <thead>
                <tr>
                    <th>Date</th>
                    @foreach ( $currencies as $currency )
                        <th >{{ $currency->currency }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @if(isset($newArray))
                    @foreach ($newArray as $key=>$currencyRates)
                    <tr>
                            <td>{{ $key }}</td>
                            @foreach ($currencyRates as $rate)
                            <td >{{ $rate }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <th>Date</th>
                    @foreach ( $currencies as $currency )
                        <th>{{ $currency->currency }}</th>
                    @endforeach
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- /Advanced Search -->
@endsection