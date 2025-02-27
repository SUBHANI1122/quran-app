'use strict';

$(function () {
    var dt_adv_filter_table = $('.datatables-report-rate');
    if (dt_adv_filter_table.length) {
        var dt_user = dt_adv_filter_table.DataTable({
            scrollX: true,
            scrollCollapse: true,
            buttons: [
                {
                    extend: 'csvHtml5',
                    title: 'Rate Reports - AMS',
                    className: 'btn btn-primary', // Hide the default button, we are using a custom one
                    text: 'Export to CSV' // Set custom text for the button
                }
            ],
            fixedColumns: {
                leftColumns: 1  // Fix the first two columns
            },
            colResize: true,
        });
        dt_user.buttons().container()
    .appendTo('.csv-report');
    }
    // $('#export-csv').on('click', function() {
    //     dt_user.button('.buttons-csv').trigger(); // Trigger the CSV export
    // });
    
})