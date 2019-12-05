$(document).ready(function()
{
	$("#accordion").accordion({
	  collapsible: true
	});

	$("#accordion-resizer").resizable(
	{
	  minHeight: 140,
	  minWidth: 200,
	  resize: function()
	  {
		$( "#accordion" ).accordion( "refresh" );
	  }
	});

  $("#menu").menu();
});
