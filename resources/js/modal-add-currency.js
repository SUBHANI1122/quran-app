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
var dt_adv_filter_table = $('.datatables-currency'),
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
            { data: 'updated_at', title: 'Updated At' },
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
                    return `<span>${full.updated_at}</span>`;
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
                        '<i class="ti ti-edit"></i>' +
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

    $('#statuss, #per_page').on('change', function () {
        dt_user.ajax.reload(null, false);

        // dt_user.draw();
    });

    // $('#statuss').on('change', function () {
    //     var statusValue = $(this).val();
    //     console.log('Selected status value:', statusValue);
    //     var columnIndex = $(this).data('column-index');
    //     console.log('Selected column index value:', columnIndex);

    //     dt_user.column(columnIndex).search(statusValue, true, false).draw();

    // });

    // $('#per_page').on('change', function () {
    //     var perPageValue = $(this).val();
    //     dt_user.page.len(perPageValue).draw();
    // });
}



$('#currency_id').on('change', function () {
    var selectedOption = $(this).find('option:selected');
    $('#symbol').val(selectedOption.data('symbol'));
    $('#country').val(selectedOption.data('country'));
});

$('.add-new').on('click', function () {
    $('#id').val(''); // Reset input field
    $('#offcanvasAddUserLabel').html('Add Currency');
});

$(document).on('click', '.edit-record', function () {
    var user_id = $(this).data('id');
    $('#addCurrency').modal('show');

    // hide responsive modal in small screen
    // if (dtrModal.length) {
    //     dtrModal.modal('hide');
    // }
    $('#offcanvasAddUserLabel').html('Edit Currency');

    // get data
    $.get(`${baseUrl}currency-management\/${user_id}\/edit`, function (data) {
        $('#user_id').val(data.id);
        $('#currency_id').val(data.currency_id).trigger('change');
        $('#type').val(data.type).trigger('change');
        $('#status').val(data.status).trigger('change');
        $('#re_value').val(data.re_value).trigger('change');
        $('#profit').val(data.profit).trigger('change');
        $('#min_rate_limit').val(data.min_rate_limit);
        $('#max_rate_limit').val(data.max_rate_limit);
        $('#auto_create_unpaid_tranx_account').prop('checked', data.auto_create_unpaid_tranx_account == 1);
        $('#auto_create_unearned_admin_service_fee_account').prop('checked', data.auto_create_unearned_admin_service_fee_account == 1);
        $('#auto_create_unearned_agent_service_fee_account').prop('checked', data.auto_create_unearned_agent_service_fee_account == 1);
    });
});

// Form validation and submission logic
FormValidation.formValidation(document.getElementById('addCurrencyForm'), {
    fields: {
        currency_id: { validators: { notEmpty: { message: 'Please select Currency' } } },
        type: { validators: { notEmpty: { message: 'Please select type' } } },
        status: { validators: { notEmpty: { message: 'Please select status' } } },
        re_value: { validators: { notEmpty: { message: 'Please select Re Value' } } },
        profit: { validators: { notEmpty: { message: 'Please select profit' } } },
        min_rate_limit: {
            validators: {
                notEmpty: { message: 'Please enter minimum rate limit' },
                numeric: { message: 'The value must be a valid number' }
            }
        },
        max_rate_limit: {
            validators: {
                notEmpty: { message: 'Please select maximum rate limit' },
                numeric: { message: 'The value must be a valid number' }
            }
        }
    },
    plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
            eleValidClass: '',
            rowSelector: '.col-12'
        }),
        submitButton: new FormValidation.plugins.SubmitButton(),
        autoFocus: new FormValidation.plugins.AutoFocus()
    }
}).on('core.form.valid', function () {
    $.ajax({
        data: $('#addCurrencyForm').serialize(),
        url: `${baseUrl}currency-management`,
        type: 'POST',
        success: function (status) {

            $('#addCurrencyForm')[0].reset();
            $('.select2').val(null).trigger('change');
            $('#addCurrency').modal('hide');

            Swal.fire({
                icon: 'success',
                title: `Successfully ${status}!`,
                text: `Currency ${status} Successfully.`,
                customClass: { confirmButton: 'btn btn-success' }
            });
            dt_user.ajax.reload(null, false);
        },
        error: function () {

            Swal.fire({
                title: 'Duplicate Entry!',
                text: 'Your email should be unique.',
                icon: 'error',
                customClass: { confirmButton: 'btn btn-success' }
            });
        }
    });
});

