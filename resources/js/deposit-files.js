/**
 * Page User List
 */

'use strict';

var dt_adv_filter_table = $('.deposit-file-datatable');

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

if (dt_adv_filter_table.length) {
    var dt_user = dt_adv_filter_table.DataTable({
        dom: "<'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6 dataTables_pager'p>>",
        ajax: {
            url: baseUrl + `records/${fileId}/deposit`,
            dataSrc: ''
        },

        columns: [
            { data: null, title: 'Serial No' },
            { data: 'credit_account_head', title: 'Credit Account Head' },
            { data: 'credit_amount', title: 'Credit Amount' },
            { data: 'type', title: 'Type' },
            { data: 'debit_account_head', title: 'Debit Account Head' },
            { data: 'debit_amount', title: 'Debit Amount' },
            { data: 'lc_amount', title: 'LC Amount' },
            { data: 'posting_date', title: 'Posting Date' },

        ],

        columnDefs: [
            {
                targets: 0,
                render: function (data, type, full, meta) {
                    return meta.row + 1;
                }
            },
            {
                targets: 2,
                render: function (data, type, full, meta) {
                    return `<span>${full.credit_account_head}</span>`;
                }
            },
            {
                
                targets: 3,
                render: function (data, type, full, meta) {
                    return `<span>${full.credit_amount}</span>`;
                }
            },
            {
                
                targets: 4,
                render: function (data, type, full, meta) {
                    return `<span>${full.type}</span>`;
                }
            },

            {
                targets: 5,
                render: function (data, type, full, meta) {
                    return `<span>${full.debit_account_head}</span>`;
                }
            },
            {
                
                targets: 3,
                render: function (data, type, full, meta) {
                    return `<span>${full.debit_amount}</span>`;
                }
            },
            {
                
                targets: 4,
                render: function (data, type, full, meta) {
                    return `<span>${full.lc_amount}</span>`;
                }
            },

            {
                targets: 5,
                render: function (data, type, full, meta) {
                    return `<span>${full.posting_date}</span>`;
                }
            }

        ],
        language: {
            paginate: {
                next: '<i class="ti ti-chevron-right ti-sm"></i>',
                previous: '<i class="ti ti-chevron-left ti-sm"></i>'
            }
        },
        orderCellsTop: true,

    });
}


