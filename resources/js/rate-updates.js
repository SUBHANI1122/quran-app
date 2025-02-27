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
var dt_adv_filter_table = $('.datatables-rate-update'),
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

if (dt_adv_filter_table.length) {
    var dt_user = dt_adv_filter_table.DataTable({
        dom: "<'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6 dataTables_pager'p>>",
        ajax: {
            url: baseUrl + 'currency-management/filter',
            type: 'POST',
            data: function (d) {
                d.code = $('#code').val();
                d.currency = $('#currency').val();
                d.statuss = $('#statuss').val();
                d.per_page = $('#per_page').val();
                d.date = $('#date').val();

            }
        },
        columns: [
            // { data: null, title: 'Serial No' },
            { data: 'code', title: 'Code' },
            { data: 'name', title: 'Name' },
            { data: 'country', title: 'Country' },
            { data: 'type', title: 'Type' },
            { data: 'min_rate_limit', title: 'Min Rate Limit' },
            { data: 'max_rate_limit', title: 'Max Rate Limit' },
            { data: 'status', title: 'Status' },
            { data: 'rate', title: 'Rate' },
            { data: '', title: '' },
            { data: 'action', title: 'Action' }

        ],

        columnDefs: [
            // {
            //     // Serial number column
            //     targets: 0,
            //     render: function (data, type, full, meta) {
            //         return meta.row + 1; // Serial number based on row index
            //     }
            // },
            {
                // Code column
                targets: 0,
                render: function (data, type, full, meta) {
                    return `<span>${full.code}</span>`;
                }
            },
            {
                // Name column
                targets: 1,
                render: function (data, type, full, meta) {
                    return `<span>${full.name}</span>`;
                }
            },
            {
                // Country column
                targets: 2,
                render: function (data, type, full, meta) {
                    return `<span>${full.country}</span>`;
                }
            },
            {
                targets: 3,
                render: function (data, type, full, meta) {
                    if (full.type === 0) {
                        return '<span class="badge bg-warning badge-sm">Divide</span>';
                    } else {
                        return '<span class="badge bg-success badge-sm">Multiply</span>';
                    }
                }
            },

            {
                // Min Rate Limit column
                targets: 4,
                render: function (data, type, full, meta) {
                    return `<span>${full.min_rate_limit}</span>`;
                }
            },
            {
                // Max Rate Limit column
                targets: 5,
                render: function (data, type, full, meta) {
                    return `<span>${full.max_rate_limit}</span>`;
                }
            },
            {
                targets: 6,
                render: function (data, type, full, meta) {
                    return full.status == 1
                        ? '<i class="ti fs-4 ti-shield-check text-success"></i>'
                        : '<i class="ti fs-4 ti-shield-x text-danger"></i>';
                }
            },
            {
                // Last Updated column
                targets: 7,
                render: function (data, type, full, meta) {
                    return `<span>${full.rate}</span>`;
                }
            },
            {
                // Input field in the column
                targets: 8,
                render: function (data, type, full, meta) {
                    return `<input type="number" class="form-control input-rate" value="" />`;
                }
            },
            {
                // Actions column
                targets: -1,
                searchable: false,
                orderable: false,
                render: function (data, type, full, meta) {
                    return (
                        '<div class="d-flex align-items-center gap-50">' +
                        `<button class="btn btn-sm btn-icon edit-record btn-text-secondary rounded-pill waves-effect" data-id="${full.id}" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser">` +
                        '<i class="ti ti-plus"></i>' +
                        '</button>' +
                        '</div>'
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

    $('input.dt-input').on('keyup', function () {
        dt_user.ajax.reload(null, false);

        // dt_user.draw();
    });

    $('#date').on('change', function () {
        dt_user.ajax.reload(null, false);
    });

    $('#statuss, #per_page').on('change', function () {
        dt_user.ajax.reload(null, false);

        // dt_user.draw();
    });
}


$(document).on('click', '.edit-record', function () {
    var id = $(this).data('id');
    var rateInput = $(this).closest('tr').find('input.input-rate').val();
    var selectedDate = $('#date').val();
    if (!rateInput || isNaN(rateInput) || rateInput <= 0) {
        Swal.fire({
            title: 'Invalid Input!',
            text: 'Please enter a valid rate greater than 0.',
            icon: 'error',
            customClass: { confirmButton: 'btn btn-danger' }
        });
        return;
    }

    $.ajax({
        url: baseUrl + 'update-rates',
        method: 'POST',
        data: {
            id: id,
            rate: rateInput,
            date: selectedDate,
        },
        success: function (status) {
            Swal.fire({
                icon: 'success',
                title: `Successfully ${status}!`,
                text: `Rate ${status} Successfully.`,
                customClass: { confirmButton: 'btn btn-success' }
            });
            dt_user.ajax.reload(null, false);
        },
        error: function (xhr) {
            const response = xhr.responseJSON;
            const errorMessage = response && response.message ? response.message : 'An error occurred. Please try again.';

            Swal.fire({
                title: 'Error!',
                text: errorMessage,
                icon: 'error',
                customClass: { confirmButton: 'btn btn-danger' }
            });
        }
    });
});

