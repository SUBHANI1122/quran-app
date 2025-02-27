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
var dt_adv_filter_table = $('.datatables-chart-of-account'),
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

if (dt_adv_filter_table.length) {
    var dt_user = dt_adv_filter_table.DataTable({
        dom: "<'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6 dataTables_pager'p>>",
        ajax: {
            url: baseUrl + 'chart-of-account/filter',
            type: 'POST',
            data: function (d) {
                d.prefix = $('#prefix').val();
                d.account_name = $('#account_name').val();
                d.statuss = $('#statuss').val();
                d.currency = $('#currency').val();
            }
        },

        columns: [
            // { data: null, title: 'Serial No' },
            { data: 'code', title: 'Code' },
            { data: 'name', title: 'Name' },
            { data: 'prefix', title: 'Prefix' },
            { data: 'type', title: 'Type' },
            { data: 'classification', title: 'Classification' },
            { data: 'country', title: 'Country' },
            { data: 'currency', title: 'Currency' },
            { data: 'status', title: 'Status' },
            { data: 'action', title: '' }

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
                // Name column
                targets: 2,
                render: function (data, type, full, meta) {
                    return `<span>${full.prefix}</span>`;
                }
            },
            {
                // Country column
                targets: 3,
                render: function (data, type, full, meta) {
                    return `<span>${full.type}</span>`;
                }
            },
            {
                // Country column
                targets: 4,
                render: function (data, type, full, meta) {
                    return `<span>${full.classification}</span>`;
                }
            },
            {
                // Country column
                targets: 5,
                render: function (data, type, full, meta) {
                    return `<span>${full.country}</span>`;
                }
            },
            {
                // Country column
                targets: 6,
                render: function (data, type, full, meta) {
                    return `<span>${full.currency}</span>`;
                }
            },
            {
                targets: 7,
                render: function (data, type, full, meta) {
                    return full.status == 1
                        ? '<i class="ti fs-4 ti-shield-check text-success"></i>'
                        : '<i class="ti fs-4 ti-shield-x text-danger"></i>';
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

    $('#statuss').on('change', function () {
        dt_user.ajax.reload(null, false);

        // dt_user.draw();
    });
}



$('#currency_id').on('change', function () {
    var selectedOption = $(this).find('option:selected');
    $('#symbol').val(selectedOption.data('symbol'));
    $('#country').val(selectedOption.data('country'));
});

$('.add-new').on('click', function () {
    $('#id').val(''); // Reset input field
    $('#offcanvasAddUserLabel').html('Add Chart Of Account');
});

$(document).on('click', '.edit-record', function () {
    var user_id = $(this).data('id');
    $('#addChartofAccount').modal('show');

    // hide responsive modal in small screen
    // if (dtrModal.length) {
    //     dtrModal.modal('hide');
    // }
    $('#offcanvasAddUserLabel').html('Edit Chart of Account');

    // get data

    $.get(`${baseUrl}chart-of-account\/${user_id}\/edit`, function (data) {
        $('#user_id').val(data.id);
        $('#parent_account_id').val(data.parent_account_id).trigger('change');
        $('#account').val(data.account_name);
        $('#debit_limit').val(data.debit_limit);
        $('#credit_limit').val(data.credit_limit);
        $('#prefixs').val(data.prefix);
        $('#account_type').val(data.account_type).trigger('change');
        $('#sc_dc').val(data.sc_dc).trigger('change');
        $('#currency_id').val(data.currency_id).trigger('change');
        $('#status').val(data.status).trigger('change');
        $('#re_value').val(data.re_value).trigger('change');
        $('#cost_of_sale').val(data.cost_of_sale).trigger('change');
    });
});

// Form validation and submission logic
FormValidation.formValidation(document.getElementById('addChartOfAccountForm'), {
    fields: {
        parent_account_id: { validators: { notEmpty: { message: 'Please select Parent Account' } } },
        currency_id: { validators: { notEmpty: { message: 'Please select Country' } } },
        account_name: { validators: { notEmpty: { message: 'Please enter account name' } } },
        status: { validators: { notEmpty: { message: 'Please select status' } } },
        re_value: { validators: { notEmpty: { message: 'Please select Re Value' } } },
        profit: { validators: { notEmpty: { message: 'Please select profit' } } },
        cost_of_sale: { validators: { notEmpty: { message: 'Please select cost of sale' } } },
        debit_limit: {
            validators: {
                notEmpty: { message: 'Please enter debit limit' },
                numeric: { message: 'The value must be a valid number' }
            }
        },
        credit_limit: {
            validators: {
                notEmpty: { message: 'Please select credit limit' },
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
        data: $('#addChartOfAccountForm').serialize(),
        url: `${baseUrl}chart-of-account`,
        type: 'POST',
        success: function (status) {

            $('#addChartOfAccountForm')[0].reset();
            $('.select2').val(null).trigger('change');
            $('#addChartofAccount').modal('hide');

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

