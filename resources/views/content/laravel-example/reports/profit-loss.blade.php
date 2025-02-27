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
'resources/js/report-profit-loss.js'])

@endsection

@section('content')


<div class="card">
    <div class="d-flex justify-content-between align-items-center m-5 csv-report">
        <h5 class="mb-0">Profit and Loss Report</h5>
    </div>

    <!-- Search Form -->
    <div class="card-body">
        <form class="dt_adv_search" method="GET" action="{{ route('rates.report') }}">
            @csrf
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-2">
                    <label class="form-label">From:</label>
                    <input type="date" class="form-control dt-input" name="from" id="from" value="{{ $from ?? '' }}">
                </div>
                <div class="col-12 col-sm-6 col-lg-2">
                    <label class="form-label">To:</label>
                    <input type="date" class="form-control dt-input" name="to" id="to" value="{{ $to ?? '' }}">
                </div>
                <div class="col-12 col-sm-6 col-lg-2">
                    <label class="form-label"></label>
                    <button class="form-control btn btn-primary" type="submit">Search</button>
                </div>
                <div class="col-12 col-sm-6 col-lg-2">
                    <label class="form-label"></label>
                    <a href="{{ route('rates.report') }}" class="form-control text-center text-decoration-none btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>
    </div>

    <!-- Ledger Report Table -->
    <div class="card-datatable table-responsive">
    @if (!empty($reportData))
        <div class="text-center mb-4">
            <h4>Profit and Loss (P&L)</h4>
            <h5>Roze Remit AMS</h5>
            <p>Statement Period: {{ $from->format('d M, Y') }} to {{ $to->format('d M, Y') }}</p>
        </div>
        <table class="table datatables-report-profit-loss">
            <thead>
                <tr>
                    <th>Account Head</th>
                    @foreach ($months as $month)
                        <th>{{ $month }}</th>
                    @endforeach
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <!-- Revenue Section -->
                <tr>
                    <th colspan="{{ $months->count() + 2 }}" class="bg-light">Revenue</th>
                </tr>
                @foreach ($reportData as $accountHead => $data)
                    @if (in_array($accountHead, $accounts->where('classification_type', 'Income')->pluck('account_name')->toArray()))
                        <tr>
                            <td>{{ $accountHead }}</td>
                            @foreach ($months as $month)
                                <td>{{ $data[$month] ?? 0 }}</td>
                            @endforeach
                            <td>{{ array_sum($data) }}</td>
                        </tr>
                    @endif
                @endforeach

                <!-- Expense Section -->
                <tr>
                    <th colspan="{{ $months->count() + 2 }}" class="bg-light">Expenses</th>
                </tr>
                @foreach ($reportData as $accountHead => $data)
                    @if (in_array($accountHead, $accounts->where('classification_type', 'Expense')->pluck('account_name')->toArray()))
                        <tr>
                            <td>{{ $accountHead }}</td>
                            @foreach ($months as $month)
                                <td>{{ $data[$month] ?? 0 }}</td>
                            @endforeach
                            <td>{{ array_sum($data) }}</td>
                        </tr>
                    @endif
                @endforeach

                <!-- Total Revenue and Expense -->
                <tr>
                    <th>Total Revenue</th>
                    @foreach ($months as $month)
                        <th>{{ $totals[$month] ?? 0 }}</th>
                    @endforeach
                    <th>{{ $totals['overall'] ?? 0 }}</th>
                </tr>
            </tbody>
        </table>
    @else
        <p class="text-center mt-5">No data available. Please select a date range and search.</p>
    @endif
</div>

</div>


@endsection