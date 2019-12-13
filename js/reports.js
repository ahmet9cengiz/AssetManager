$(document).ready(function()
{
    $("#menu").menu();

    table = null;
    table = $('#report-table, #canned-report-table').DataTable({
        dom: 'Blfrtip',
        lengthMenu: [[250, 500, -1], [250, 500, "All"]],
        pageLength: 250,
        buttons:[
                {
                    extend: 'csv',
                    title: function(){return $("#report-name").val()},
                },
                {
                    extend:'pdf',
                    title: function(){return $("#report-name").val()},
                },
                {
                    extend: 'print',
                    title: function(){return $("#report-name").val()},
                },
                ]
    });
    $("#cr-radio").change(function()
    {
      var crManu = $("#cr-radio").val();
      $.ajax({
        url: "inc/dynamicDropdown.php",
        method: "POST",
        data: { crManu }
      }).done(function(reports){
        report = JSON.parse(reports);
        $("#stuff").empty();
        $("#stuff").append(
          'Model: ' + report.Model + ', Qty: ' + report.QTY
        );
      });
    });
});
