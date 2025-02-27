/**
 * Page User List
 */

'use strict';



$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('click', '.delete-group', function () {
    let postingDate = $(this).data('date');
    Swal.fire({
        title: 'Are you sure?',
        text: "This action will delete all entries for this date.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/delete-entries-for-date',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'DELETE',
                data: {
                    date: postingDate,
                },
                success: function (response) {
                    Swal.fire(
                        'Deleted!',
                        'Entries have been deleted successfully.',
                        'success'
                    );
                    location.reload();
                },
                error: function () {
                    Swal.fire(
                        'Error!',
                        'Something went wrong. Please try again.',
                        'error'
                    );
                }
            });
        }
    });
});


$(document).on('click', '.approve-group', function () {
    let postingDate = $(this).data('date');

    Swal.fire({
        title: 'Are you sure?',
        text: "This action will approve all entries for this date.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, approve it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/approve-entries-for-date',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    date: postingDate,
                },
                success: function (response) {
                    Swal.fire(
                        'Approved!',
                        'Entries have been approved successfully.',
                        'success'
                    );
                    location.reload();
                },
                error: function () {
                    Swal.fire(
                        'Error!',
                        'Something went wrong. Please try again.',
                        'error'
                    );
                }
            });
        }
    });
});





