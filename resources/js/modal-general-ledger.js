/**
 * Page User List
 */

'use strict';

// Datatable (jquery)
$(function () {
    const select2 = $('.select2');

    // Select2 Country
    if (select2.length) {
        select2.each(function () {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>').select2({
                placeholder: 'Select value',
                dropdownParent: $this.parent()
            });
        });
    }
});
var dt_adv_filter_table = $('.datatables-general-ledger'),
    startDateEle = $('.start_date'),
    endDateEle = $('.end_date'),
    offCanvasForm = $('#offCanvasForm');


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var isRtl = $('html').attr('dir') === 'rtl';

// Datepicker for advanced filter
var rangePickr = $('.flatpickr-range'),
    dateFormat = 'MM/DD/YYYY';

if (rangePickr.length) {
    rangePickr.flatpickr({
        mode: 'range',
        dateFormat: 'm/d/Y',
        orientation: isRtl ? 'auto right' : 'auto left',
        locale: {
            format: dateFormat
        },
        onClose: function (selectedDates) {
            var startDate = '',
                endDate = new Date();
            if (selectedDates[0] != undefined) {
                startDate = moment(selectedDates[0]).format('MM/DD/YYYY');
                startDateEle.val(startDate);
            }
            if (selectedDates[1] != undefined) {
                endDate = moment(selectedDates[1]).format('MM/DD/YYYY');
                endDateEle.val(endDate);
            }
            $(rangePickr).trigger('change').trigger('keyup');
        }
    });
}



$('#currency_id').on('change', function () {
    var selectedOption = $(this).find('option:selected');
    var symbol = selectedOption.data('symbol');
    var currencyname = selectedOption.data('name');
    $('#currency_symbol').val(currencyname + ' - ' + symbol);
});

$('#searchBtn').click(function () {
    const postingDateFrom = $('#date_from').val();
    const postingDateTo = $('#date_to').val();

    if (postingDateFrom && !postingDateTo) {
        Swal.fire({
            title: 'Error!',
            text: 'Please select the "To Date" when "From Date" is selected.',
            icon: 'error',
            customClass: { confirmButton: 'btn btn-success' }
        });
        return;
    } else if (!postingDateFrom && postingDateTo) {
        Swal.fire({
            title: 'Error!',
            text: 'Please select the "From Date" when "To Date" is selected.',
            icon: 'error',
            customClass: { confirmButton: 'btn btn-success' }
        });
        return;
    }
    dt_user.ajax.reload();
});
if (dt_adv_filter_table.length) {
    var dt_user = dt_adv_filter_table.DataTable({
        dom: "<'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6 dataTables_pager'p>>",
        ajax: {
            url: baseUrl + 'general-ledger/filter',
            type: 'POST',
            data: function (d) {
                d.account_name = $('#account_name').val();
                d.date_from = $('#date_from').val();
                d.date_to = $('#date_to').val();
            }
        },
        columns: [
            {
                data: 'id',
                title: 'V.No',
                targets: 0,
                render: function (data, type, full, meta) {
                    return `<strong class="sr-no" data-voucher_no="${full.voucher_id}" data-file_type="${full.file_type}">${full.voucher_id}</strong>`;
                }
            },
            { data: 'approved_at', title: 'Date' },
            { data: 'details', title: 'Description' },
            { data: 'debit', title: 'Debit' },
            { data: 'credit', title: 'Credit' },
            { data: 'balance', title: 'Balance' },
        ],
        language: {
            paginate: {
                next: '<i class="ti ti-chevron-right ti-sm"></i>',
                previous: '<i class="ti ti-chevron-left ti-sm"></i>'
            }
        },
        orderCellsTop: true,
    });

    $('input.dt-input').on('keyup', function () {
        dt_user.ajax.reload(null, false);
    });

    $('#statuss').on('change', function () {
        dt_user.ajax.reload(null, false);
    });
}



$(document).on('click', '.sr-no', function () {
    const voucherNo = $(this).data('voucher_no');
    const file = $(this).data('file_type');

    $.ajax({
        url: '/fetch-general-ledger',
        type: 'GET',
        data: { voucher_no: voucherNo, fileType: file },
        success: function (response) {
            if (response.success) {
                const { voucher_no, entries } = response.data;

                const approvedBy = entries[0]?.approved_by || 'N/A';
                const approvedAt = entries[0]?.approved_at || 'N/A';

                $('#date-user-details tbody').html(`
                    <tr>
                        <td class="text-center"><strong>${voucher_no}</strong></td>
                        <td class="text-center">${approvedBy}</td>
                        <td class="text-center">${approvedAt}</td>
                    </tr>
                `);

                // Initialize totals
                let totalFcAmount = 0;
                let totalDebitAmount = 0;
                let totalCreditAmount = 0;

                // Populate account details and calculate totals
                const accountDetails = entries.map(entry => {
                    const fcAmount = parseFloat(entry.fc_amount) || 0;
                    const debitAmount = parseFloat(entry.debit_amount) || 0;
                    const creditAmount = parseFloat(entry.credit_amount) || 0;

                    totalFcAmount += fcAmount;
                    totalDebitAmount += debitAmount;
                    totalCreditAmount += creditAmount;

                    return `
                        <tr>
                            <td>${entry.account_head}<br>${entry.details || 'N/A'}</td>
                            <td class="text-end">${fcAmount ? fcAmount.toFixed(2) : '-'}</td>
                            <td class="text-end">${debitAmount ? debitAmount.toFixed(2) : '-'}</td>
                            <td class="text-end">${creditAmount ? creditAmount.toFixed(2) : '-'}</td>
                        </tr>
                    `;
                }).join('');

                // Append the rows and the summary row
                const summaryRow = `
                    <tr class="table-light">
                        <td class="text-end"><strong>Total</strong></td>
                        <td class="text-end"><strong>${totalFcAmount.toFixed(2)}</strong></td>
                        <td class="text-end"><strong>${totalDebitAmount.toFixed(2)}</strong></td>
                        <td class="text-end"><strong>${totalCreditAmount.toFixed(2)}</strong></td>
                    </tr>
                `;

                $('#account-details tbody').html(accountDetails + summaryRow);

                // Show the modal
                $('#generalLedger').modal('show');
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: response.message,
                    icon: 'error',
                    confirmButtonClass: 'btn btn-danger'
                });
            }
        },
        error: function () {
            Swal.fire({
                title: 'Error!',
                text: 'An unexpected error occurred.',
                icon: 'error',
                confirmButtonClass: 'btn btn-danger'
            });
        }
    });
});










