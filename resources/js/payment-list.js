'use strict';

$(function () {
    var dt_user_table = $('.datatables-users'),
        select2 = $('.select2'),
        userView = baseUrl + 'app/user/view/account',
        offCanvasForm = $('#offcanvasAddUser');

    if (select2.length) {
        select2.each(function () {
            $(this).wrap('<div class="position-relative"></div>').select2({
                placeholder: 'Select value',
                dropdownParent: $(this).parent()
            });
        });
    }

    // ajax setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#searchBtn').click(function () {
        const postingDateFrom = $('#posting_date_from').val();
        const postingDateTo = $('#poting_date_to').val();

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

    // Users datatable
    if (dt_user_table.length) {
        var dt_user = dt_user_table.DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: baseUrl + 'payments-list/filter',
                type: 'POST',
                data: function (d) {
                    d.payment_no = $('#payment_no').val();
                    d.tran_id = $('#invoice_no').val();
                    d.sending_country_id = $('#sending_country_id').val();
                    d.receiving_country_id = $('#receiving_country_id').val();
                    d.file_type = $('#file_type').val();
                    d.posting_date_from = $('#posting_date_from').val();
                    d.posting_date_to = $('#poting_date_to').val();
                    d.status = $('#statuss').val();
                }
            },
            columns: [
                { data: '#' },
                { data: 'invoice' },
                { data: 'payment_no' },
                { data: 'agent' },
                { data: 'sending_country' },
                { data: 'receiving_country' },
                { data: 'sending_lc' },
                { data: 'sending_fc' },
                { data: 'receiving_amount' },
                { data: 'fx_margin' },
                { data: 'date' },
                { data: 'status' }
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
                        return `<span>${full.invoice}</span>`;
                    }
                },
                {
                    targets: 2,
                    render: function (data, type, full, meta) {
                        return `<span>${full.payment_no}</span>`;
                    }
                },
                {
                    targets: 3,
                    render: function (data, type, full, meta) {
                        return `<span>${full.agent}</span>`;
                    }
                },
                {
                    targets: 4,
                    render: function (data, type, full, meta) {
                        return `<span>${full.sending_country}</span>`;
                    }
                },
                {
                    targets: 5,
                    render: function (data, type, full, meta) {
                        return `<span>${full.receiving_country}</span>`;
                    }
                },
                {
                    targets: 6,
                    render: function (data, type, full, meta) {
                        return `<span>${full.sending_lc}</span>`;
                    }
                },
                {
                    targets: 7,
                    render: function (data, type, full, meta) {
                        return `<span>${full.sending_fc}</span>`;
                    }
                },
                {
                    targets: 8,
                    render: function (data, type, full, meta) {
                        return `<span>${full.receiving_amount}</span>`;
                    }
                },
                {
                    targets: 9,
                    render: function (data, type, full, meta) {
                        return `<span>${full.fx_margin}</span>`;
                    }
                },
                {
                    targets: 10,
                    render: function (data, type, full, meta) {
                        return `<span>${full.date}</span>`;
                    }
                },
                {
                    targets: 11,
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
            ],
            order: [[2, 'desc']],
            dom:
                '<"row"' +
                '<"col-md-2"<"ms-n2"l>>' +
                '<"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-6 mb-md-0 mt-n6 mt-md-0"f>>' +
                '>t' +
                '<"row"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            lengthMenu: [7, 10, 20, 50, 70, 100],
            language: {
                sLengthMenu: '_MENU_',
                search: '',
                searchPlaceholder: 'Search User',
                info: 'Displaying _START_ to _END_ of _TOTAL_ entries',
                paginate: {
                    next: '<i class="ti ti-chevron-right ti-sm"></i>',
                    previous: '<i class="ti ti-chevron-left ti-sm"></i>'
                }
            },
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return 'Details of ' + data['name'];
                        }
                    }),
                    type: 'column',
                    renderer: function (api, rowIdx, columns) {
                        var data = $.map(columns, function (col, i) {
                            return col.title !== ''
                                ? '<tr data-dt-row="' +
                                col.rowIndex +
                                '" data-dt-column="' +
                                col.columnIndex +
                                '">' +
                                '<td>' +
                                col.title +
                                ':</td> ' +
                                '<td>' +
                                col.data +
                                '</td>' +
                                '</tr>'
                                : '';
                        }).join('');
                        return data ? $('<table class="table"/><tbody />').append(data) : false;
                    }
                }
            }
        });
    }

    document.getElementById('process-button').addEventListener('click', function () {
        let type = document.getElementById('file_type').value;

        if (!type) {
            Swal.fire({
                title: 'Warning!',
                text: 'Please select a type before processing.',
                icon: 'warning',
                customClass: { confirmButton: 'btn btn-warning' }
            });
            return;
        }

        fetch('/process-records', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ type: type })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Processed!',
                        text: 'Record processed successfully.',
                        customClass: { confirmButton: 'btn btn-success' }
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: data.message || 'Something went wrong, record is not processed.',
                        icon: 'error',
                        customClass: { confirmButton: 'btn btn-danger' }
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'An unexpected error occurred. Please try again later.',
                    icon: 'error',
                    customClass: { confirmButton: 'btn btn-danger' }
                });
            });
    });


});
