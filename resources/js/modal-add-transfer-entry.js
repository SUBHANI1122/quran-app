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
// Existing functionality for account change
$('#account_id').on('change', function () {
    const accountId = this.value;
    if (accountId) {
        const selectedOption = this.options[this.selectedIndex];
        const currency = selectedOption.getAttribute('data-currency');
        const currencySymbolSpan = document.getElementById('currency-symbol');
        currencySymbolSpan.textContent = currency || '@';
        const fcInput = document.getElementById('fc');
        if (currency === 'GBP') {
            fcInput.readOnly = true;
        } else {
            fcInput.readOnly = false;
        }
        document.getElementById('rate').value = '';
        fetch(`/get-rate/${accountId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('rate').value = data.rate;
                } else {
                    Swal.fire({
                        title: 'Rate Error!',
                        text: 'Rate not found for the selected account.',
                        icon: 'error',
                        customClass: { confirmButton: 'btn btn-success' }
                    });
                }
            })
            .catch(error => {
                console.error('Error fetching rate:', error);
            });
    } else {
        document.getElementById('rate').value = '';
    }
});
document.getElementById('fc').addEventListener('input', function () {
    const rate = parseFloat(document.getElementById('rate').value) || 0;
    const fcValue = parseFloat(this.value) || 0;
    const accountId = document.getElementById('account_id').value;

    const selectedOption = document.getElementById('account_id').options[document.getElementById('account_id').selectedIndex];
    const currency = selectedOption.getAttribute('data-currency');

    if (currency !== 'GBP' && rate > 0) {
        document.getElementById('lc').value = (fcValue / rate).toFixed(2);
    }
});

document.getElementById('lc').addEventListener('input', function () {
    const rate = parseFloat(document.getElementById('rate').value) || 0;
    const lcValue = parseFloat(this.value) || 0;
    const accountId = document.getElementById('account_id').value;

    const selectedOption = document.getElementById('account_id').options[document.getElementById('account_id').selectedIndex];
    const currency = selectedOption.getAttribute('data-currency');

    if (currency !== 'GBP' && rate > 0) {
        document.getElementById('fc').value = (lcValue * rate).toFixed(2);
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


$('.add-new').on('click', function () {
    $('#id').val('');
    $('#offcanvasAddUserLabel').html('Add Transfer Entry');
});


// Form validation and submission logic
FormValidation.formValidation(document.getElementById('addTransferEntryForm'), {
    fields: {
        account_id: { validators: { notEmpty: { message: 'Please select Account' } } },
        posting_date: { validators: { notEmpty: { message: 'Please select Date' } } },
        type: { validators: { notEmpty: { message: 'Please select type' } } },
        lc: { validators: { notEmpty: { message: 'Please enter lc amount' } } },
        description: { validators: { notEmpty: { message: 'Please enter description' } } }
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
        data: $('#addTransferEntryForm').serialize(),
        url: `${baseUrl}transfer-entry`,
        type: 'POST',
        success: function (status) {

            $('#addTransferEntryForm')[0].reset();
            $('.select2').val(null).trigger('change');
            $('#addTransferEntry').modal('hide');

            Swal.fire({
                icon: 'success',
                title: `Successfully ${status}!`,
                text: `Currency ${status} Successfully.`,
                customClass: { confirmButton: 'btn btn-success' }
            });
            window.location.reload(true);
        },
        error: function (xhr) {
            // Handle error response
            const errorMessage = xhr.responseJSON?.error || 'An unexpected error occurred.';
            Swal.fire({
                title: 'Error',
                text: errorMessage,
                icon: 'error',
                customClass: { confirmButton: 'btn btn-success' }
            });
        }
    });
});

$(document).on('click', '.edit-record', function () {
    var user_id = $(this).data('id');
    $('#addTransferEntry').modal('show');

    // hide responsive modal in small screen
    // if (dtrModal.length) {
    //     dtrModal.modal('hide');
    // }
    $('#offcanvasAddUserLabel').html('Edit Transfer Entry');

    // get data
    $.get(`${baseUrl}transfer-entry\/${user_id}\/edit`, function (data) {
        $('#user_id').val(data.id);
        $('#posting_date').val(data.posting_date);
        $('#account_id').val(data.account_id).trigger('change');
        $('#type').val(data.type).trigger('change');
        $('#fc').val(data.fc);
        $('#lc').val(data.lc);
        $('#description').val(data.description);
    });
});

$(document).on('click', '.delete-record', function () {
    var user_id = $(this).data('id');

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to delete this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        customClass: {
            confirmButton: 'btn btn-primary me-3',
            cancelButton: 'btn btn-label-secondary'
        },
        buttonsStyling: false
    }).then(function (result) {
        if (result.isConfirmed) {
            // Perform the AJAX DELETE request
            $.ajax({
                type: 'DELETE',
                url: `${baseUrl}transfer-entry/${user_id}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: response.message,
                        customClass: {
                            confirmButton: 'btn btn-success'
                        }
                    });

                    $(`#entry-${user_id}`).remove();
                    window.location.reload(true);

                },
                error: function (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: error.responseJSON ? error.responseJSON.message : 'An error occurred while deleting.',
                        customClass: {
                            confirmButton: 'btn btn-danger'
                        }
                    });
                    console.log(error);
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: 'Cancelled',
                text: 'Transfer entry is not deleted!',
                icon: 'error',
                customClass: {
                    confirmButton: 'btn btn-success'
                }
            });
        }
    });
});

$(document).on('click', '.post-record', function () {
    Swal.fire({
        title: 'Are you sure?',
        text: "This will post all entries and record will be pending for approvel!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, post it!',
        customClass: {
            confirmButton: 'btn btn-primary me-3',
            cancelButton: 'btn btn-label-secondary'
        },
        buttonsStyling: false
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                type: 'PATCH',
                url: `${baseUrl}transfer-entries/post`,
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Posted!',
                        text: response.message,
                        customClass: {
                            confirmButton: 'btn btn-success'
                        }
                    });
                    window.location.reload(true);
                },
                error: function (error) {
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'There was an issue posting the entries.',
                        customClass: {
                            confirmButton: 'btn btn-danger'
                        }
                    });
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: 'Cancelled',
                text: 'No changes were made.',
                icon: 'error',
                customClass: {
                    confirmButton: 'btn btn-success'
                }
            });
        }
    });
});

// $(document).on('click', '.delete-group', function () {
//     let postingDate = $(this).data('date');
//     Swal.fire({
//         title: 'Are you sure?',
//         text: "This action will delete all entries for this date.",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#d33',
//         cancelButtonColor: '#3085d6',
//         confirmButtonText: 'Yes, delete it!',
//         cancelButtonText: 'Cancel'
//     }).then((result) => {
//         if (result.isConfirmed) {
//             $.ajax({
//                 url: '/delete-entries-for-date',
//                 method: 'DELETE',
//                 data: {
//                     date: postingDate,
//                     _token: '{{ csrf_token() }}'
//                 },
//                 success: function (response) {
//                     Swal.fire(
//                         'Deleted!',
//                         'Entries have been deleted successfully.',
//                         'success'
//                     );
//                     location.reload();
//                 },
//                 error: function () {
//                     Swal.fire(
//                         'Error!',
//                         'Something went wrong. Please try again.',
//                         'error'
//                     );
//                 }
//             });
//         }
//     });
// });


// $(document).on('click', '.approve-group', function () {
//     let postingDate = $(this).data('date');
//     alert(postingDate);

//     Swal.fire({
//         title: 'Are you sure?',
//         text: "This action will approve all entries for this date.",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#28a745',
//         cancelButtonColor: '#3085d6',
//         confirmButtonText: 'Yes, approve it!',
//         cancelButtonText: 'Cancel'
//     }).then((result) => {
//         if (result.isConfirmed) {
//             $.ajax({
//                 url: '/approve-entries-for-date',
//                 method: 'POST',
//                 data: {
//                     date: postingDate,
//                     _token: '{{ csrf_token() }}'
//                 },
//                 success: function (response) {
//                     Swal.fire(
//                         'Approved!',
//                         'Entries have been approved successfully.',
//                         'success'
//                     );
//                     location.reload();
//                 },
//                 error: function () {
//                     Swal.fire(
//                         'Error!',
//                         'Something went wrong. Please try again.',
//                         'error'
//                     );
//                 }
//             });
//         }
//     });
// });





