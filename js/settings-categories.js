$(document).ready(function(){
    table = null;
    table = $('#current-categories').DataTable();

    $("#tabs").tabs({
  		collapsible: true
  	});
    
    $("#menu").menu();
});
