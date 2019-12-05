$(document).ready(function()
{
    $("#menu").menu();
    
    table = null;
    table = $('#report-table').DataTable({
        dom: 'lfrtipB',
        buttons:[
                {
                    extend: 'csv',
                    title: function(){return $("#report-name").val()},
                },
                {
                    extend:'pdf',
                    title: function(){return $("#report-name").val()},
                }
                ]
    });
});
