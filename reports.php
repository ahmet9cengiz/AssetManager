<?php
  session_start();
  require_once "inc/dbconnect.php";
  require "inc/sessionVerify.php";
	require "inc/report-query.php";
	require "inc/util.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Reports</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSS -->
  <link href="css/style.css" type="text/css" rel="stylesheet">
	<link href="jquery/overcast/jquery-ui.css" rel="stylesheet">
	<link href="DataTables/datatables.css" type="text/css" rel="stylesheet">
	<link href="DataTables/DataTables-1.10.18/css/jquery.dataTables.css" type="text/css" rel="stylesheet">
	<link href="DataTables/DataTables-1.10.18/css/dataTables.jqueryui.css" type="text/css" rel="stylesheet">


	<!--hosted jQuery-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js"></script>

	<!-- jQuery Validation -->
	<script src="validation/dist/jquery.validate.js"></script>
	<script src="validation/dist/additional-methods.js"></script>

	<!-- jQuery UI functionality -->
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


  	<!-- Report-Specific JS -->
  <script src="jquery/jquery-ui.js"></script>
  <script src="js/reports.js"></script>
  	<!-- DataTables JS functionality-->
	<script src="DataTables/datatables.js"></script>
	<script scr="DataTables/DataTables-1.10.18/js/dataTables.jqueryui.js"></script>
	<script src="DataTables/buttons/js/dataTables.buttons.js"></script>
	<script src="DataTables/buttons/js/buttons.html5.js"></script>
	<script src='pdfmake/build/pdfmake.min.js'></script>
	<script src='pdfmake/build/vfs_fonts.js'></script>


</head>
<body>
	<div class="border">
		<div id="bg"></div>
		<div class="page">
      <div class="sidebar">
				<ul id="menu">
					<li>
						<a href="home.php">Home</a>
					</li>
          <li>
            <a href="forms.php">Forms</a>
          </li>
					<li class="selected">
						<a href="reports.php">Reports</a>
					</li>
					<li>
						<a href="asset-manager.php">Asset Manager</a>
					</li>
					<li >
						<a>Settings</a>
						<ul>
							<li><a href="settings-users.php">Users</a></li>
							<li><a href="settings-categories.php">Categories</a></li>
							<li><a href="settings-manufacturers.php">Manufacturers</a></li>
							<li><a href="settings-models.php">Models</a></li>
							<li><a href="settings-locations.php">Locations</a></li>
							<li><a href="settings-networks.php">Networks</a></li>
						</ul>
					</li>
					<li>
						<a href="logout.php">Logout</a>
					</li>
				</ul>
			</div>
			<div class="body">
				<div class="pallette">
				<div id="report">
					<h3>Report Name:</h3>
					<input type="textbox" id="report-name" name="report-title" placeholder="Report Name">
				</div>
				<br><br>
				<table id="report-table" class="display" style="width:100%">
					<thead>
						<tr>
              <th></th>
							<th>Service Tag</th>
							<th>Manufacturer</th>
							<th>Category</th>
							<th>Model Number</th>
							<th>Network Name</th>
							<th>Location</th>
							<th>First Name</th>
							<th>Last Name</th>
						</tr>
					</thead>
				  <tbody>
            <?php
              for($i = 0; $i < sizeof($RST); $i++)
              {
                print '<tr>';
                print '<td></td><td>'.$RST[$i].'</td><td>'.$RMaN[$i].'</td><td>'.$RCN[$i].'</td><td>'.$RMoN[$i].'</td><td>'.$RNN[$i].'</td><td>'.$RLocN[$i].'</td><td>'.$RFN[$i].'</td><td>'.$RLN[$i].'</td>';
                print '</tr>';
              }
                // print '<tr>';
                // print '<td>Totals</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>';
                // print '</tr>';
            ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>
