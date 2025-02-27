/**
 * Page User List
 */

'use strict';

var dt_adv_filter_table = $('.datatables-files');


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
            url: baseUrl + 'importFile',
        },

        columns: [
            { data: 'file_name', title: 'File Name' },
            { data: 'uploaded_by', title: 'Added By' },
            { data: 'uploaded_at', title: 'Created At' },
            { data: 'total_records', title: 'Total Records' },
            { data: 'file_type', title: 'File Type' },
            { data: 'action', title: '' }

        ],

        columnDefs: [
            {
                // Code column
                targets: 0,
                render: function (data, type, full, meta) {
                    return `<span>${full.file_name}</span>`;
                }
            },
            {
                // Name column
                targets: 1,
                render: function (data, type, full, meta) {
                    return `<span>${full.uploaded_by}</span>`;
                }
            },
            {
                // Name column
                targets: 2,
                render: function (data, type, full, meta) {
                    return `<span>${full.uploaded_at}</span>`;
                }
            },

            {
                // Min Rate Limit column
                targets: 3,
                render: function (data, type, full, meta) {
                    return `<span>${full.total_records}</span>`;
                }
            },
            {
                // Min Rate Limit column
                targets: 4,
                render: function (data, type, full, meta) {
                    return `<span>${full.file_type}</span>`;
                }
            },
            {
                // Actions column
                targets: -1,
                searchable: false,
                orderable: false,
                render: function (data, type, full, meta) {
                    return (
                      `<div class="d-flex align-items-center gap-50">
                <a href="/records/${full.id}/${full.file_type}" class="btn btn-sm btn-icon view-record btn-text-secondary rounded-pill waves-effect">
                    <i class="ti ti-eye"></i>
                </a>
            </div>`
                    );
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

    setTimeout(function() {
        const alerts = document.querySelectorAll('.fade-out');
        alerts.forEach(alert => {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        });
    }, 5000);


