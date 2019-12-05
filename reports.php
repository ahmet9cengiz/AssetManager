<?php
  session_start();
  require_once "inc/dbconnect.php";
  require "inc/sessionVerify.php";
	require "inc/report-query.php";
	require "inc/util.php";
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
  <META http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="text/html; charset=UTF-8" http-equiv="Content-Type"/>
  <title>Reports</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- CSS to define theme colors -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css" type="text/css" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/dataTables.jqueryui.css" type="text/css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/jquery.dataTables.css" type="text/css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/css/mdb.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css" type="text/css" rel="stylesheet">
  <link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" type="text/css" rel="stylesheet">
  <link href="css/style.css" type="text/css" rel="stylesheet">

  <!--  Js Links-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/js/mdb.min.js"></script>

	<!-- jQuery Validation -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.js"></script>

  <!-- DataTables JS functionality-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/dataTables.dataTables.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/dataTables.jqueryui.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>

  <!-- jQuery UI functionality -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>

	<!-- DataTables JS functionality-->
  <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

  <!-- Main JS -->
  <script src="js/reports.js"></script>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
  <div class="container">
    <a class="navbar-left">
      <img src="images/iu.png" width="70" height="60" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link navigation" href="home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link navigation" href="forms.php">Forms</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link navigation" href="reports.php">Reports</a>
        </li>
        <li class="nav-item">
          <a class="nav-link navigation" href="asset-manager.php">Asset Manager</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link navigation dropdown-toggle" href="#" data-toggle="dropdown">Settings</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item navigation" href="settings-users.php">Users</a></li>
            <li><a class="dropdown-item navigation" href="settings-categories.php">Categories</a></li>
            <li><a class="dropdown-item navigation" href="settings-manufacturers.php">Manufacturers</a></li>
            <li><a class="dropdown-item navigation" href="settings-models.php">Models</a></li>
            <li><a class="dropdown-item navigation" href="settings-locations.php">Locations</a></li>
            <li><a class="dropdown-item navigation" href="settings-networks.php">Networks</a></li>
          </ul>
        </li>
        <li>
          <a class="nav-link navigation" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container text-center">
  <div class="box">
    <div class="row justify-content-center align-items-center h-100">
  		<div id="report" class="col col-sm-6 col-md-6 col-lg-4 col-xl-3">
  			<label for="report-title">Report Name</label>
  			<input type="textbox" id="report-name" name="report-title" class="form-control" style="text-align: center" placeholder="Title">
  		</div>
    </div>
  </div>
  <div class="box">
    <table id="report-table" class="table table-bordered dt-responsive nowrap">
			<thead>
				<tr>
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
            print '<td>'.$RST[$i].'</td><td>'.$RMaN[$i].'</td><td>'.$RCN[$i].'</td><td>'.$RMoN[$i].'</td><td>'.$RNN[$i].'</td><td>'.$RLocN[$i].'</td><td>'.$RFN[$i].'</td><td>'.$RLN[$i].'</td>';
            print '</tr>';
          }
        ?>
	    </tbody>
    </table>
   </div>
</div>
</body>
</html>
