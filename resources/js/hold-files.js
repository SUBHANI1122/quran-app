/**
 * Page User List
 */

'use strict';

var dt_adv_filter_table = $('.hold-file-datatable');

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
            url: baseUrl + `records/${fileId}/hold`,
            dataSrc: ''
        },

        columns: [
            { data: null, title: 'Serial No' },
            { data: null, title: 'Status' },
            { data: 'agent_name', title: 'Agent' },
            { data: 'payment_no', title: 'Payment #' },
            { data: 'fc_amount', title: 'LC Amount' },
            { data: 'date', title: 'Date' },

        ],

        columnDefs: [
            {
                targets: 0,
                render: function (data, type, full, meta) {
                    return meta.row + 1;
                }
            },
            {
                targets: 1,
                render: function (data, type, full, meta) {
                    let statusBadge;
                    switch (full.status) {
                        case 'posted':
                            statusBadge = '<span class="badge bg-success">Posted</span>';
                            break;
                        case 'not_posted':
                            statusBadge = '<span class="badge bg-warning">Not Posted</span>';
                            break;
                        case 'failed':
                            statusBadge = '<span class="badge bg-danger">Failed</span>';
                            break;
                        default:
                            statusBadge = '<span class="badge bg-secondary">Unknown</span>';
                    }
                    return statusBadge;
                }
            },
            {
                targets: 2,
                render: function (data, type, full, meta) {
                    return `<span>${full.agent_name}</span>`;
                }
            },
            {
                
                targets: 3,
                render: function (data, type, full, meta) {
                    return `<span>${full.payment_no}</span>`;
                }
            },
            {
                
                targets: 4,
                render: function (data, type, full, meta) {
                    return `<span>${full.fc_amount}</span>`;
                }
            },

            {
                targets: 5,
                render: function (data, type, full, meta) {
                    return `<span>${full.date}</span>`;
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


