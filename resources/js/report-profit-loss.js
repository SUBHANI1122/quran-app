'use strict';

$(function () {
    var dt_adv_filter_table = $('.datatables-report-profit-loss');
    if (dt_adv_filter_table.length) {
        var dt_user = dt_adv_filter_table.DataTable({
            scrollX: true,
            scrollCollapse: true,
            buttons: [
                {
                    extend: 'csvHtml5',
                    title: 'Profit Loss Reports - AMS',
                    className: 'btn btn-primary', 
                    text: 'Export to CSV'
                }
            ],
            fixedColumns: {
                leftColumns: 1  
            },
            colResize: true,
        });
        dt_user.buttons().container()
    .appendTo('.csv-report');
    }
    
})