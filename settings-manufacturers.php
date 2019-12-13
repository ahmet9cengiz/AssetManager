<?php
	session_start();
	require "inc/sessionVerify.php";
	require "inc/dbconnect.php";
	require "tables/settings-manufacturer-table.php";
	require_once "inc/dynamicDropdown.php";
	require "inc/util.php";

	if(!isset($_SESSION['msg']))
	{
		$_SESSION['msg'] = array();
	}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
  <META http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="text/html; charset=UTF-8" http-equiv="Content-Type"/>
  <title>Manufacturer Settings</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- CSS to define theme colors -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css" type="text/css" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/dataTables.jqueryui.css" type="text/css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/jquery.dataTables.css" type="text/css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/css/mdb.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css" type="text/css" rel="stylesheet">
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

	<!-- Main JS -->
  <script src="js/settings-manufacturers.js"></script>
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
          <li class="nav-item">
            <a class="nav-link navigation" href="reports.php">Reports</a>
          </li>
          <li class="nav-item">
            <a class="nav-link navigation" href="asset-manager.php">Asset Manager</a>
          </li>
          <li class="nav-item dropdown active">
            <a class="nav-link navigation dropdown-toggle" href="#" data-toggle="dropdown">Settings</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item navigation" href="settings-users.php">Users</a></li>
              <li><a class="dropdown-item navigation" href="settings-categories.php">Categories</a></li>
              <li><a class="dropdown-item navigation active" href="settings-manufacturers.php">Manufacturers</a></li>
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
      <div class="nav-tabs" id="tabs" style="text-align: center">
				<ul>
					<li style="float: none; display: inline-block;"><a href="#add-manufacturer">Add Manufacturer</a></li>
					<li style="float: none; display: inline-block;"><a href="#update-manufacturer">Update Manufacturer</a></li>
					<li style="float: none; display: inline-block;"><a href="#delete-manufacturer">Delete Manufacturer</a></li>
				</ul>
				<div id="add-manufacturer">
					<form action="process/manufacturer-process.php" method="POST">
						<div class="row justify-content-center align-items-center h-100">
							<div class="form-group col-3">
								<label for="manu-name">Manufacturer Name: </label>
								<input type="text" name="manu-name" class="form-control" required>
							</div>
							<div class="form-group col-3">
								<label for="manu-phone">Phone: </label>
								<input type="text" name="manu-phone" class="form-control">
							</div>
							<div class="form-group col-3">
								<label for="manu-web">Website: </label>
								<input type="text" name="manu-web" class="form-control">
							</div>
						</div>
						<input name="add-manufacturer" type="submit" value="Add" id="add-manufacturer">
					</form>
				</div>
				<div id="update-manufacturer">
					<form action="process/manufacturer-process.php" method="POST">
						<div class="row justify-content-center align-items-center h-100">
							<div class="form-group col-3">
								<legend>Old Info</legend>
								<label for="old-manuname">Manufacturer Name: </label>
								<input type="text" name="old-manuname" class="form-control" required>
							</div>
						</div>
						<div class="row justify-content-center align-items-center h-100">
							<legend>New Info</legend>
							<div class="form-group col-3">
									<label for="new-manuname">Manufacturer Name: </label>
									<input type="text" name="new-manuname" class="form-control" required>
							</div>
							<div class="form-group col-3">
								<label for="new-manuphone">Phone: </label>
								<input type="text" name="new-manuphone" class="form-control">
							</div>
							<div class="form-group col-3">
								<label for="new-manuweb">Website: </label>
								<input type="text" name="new-manuweb" class="form-control">
							</div>
						</div>
						<input name="update-manufacturer" type="submit" value="Update" id="update-manufacturer">
					</form>
				</div>
				<div id="delete-manufacturer">
					<form action="process/manufacturer-process.php" method="POST">
						<div class="row justify-content-center align-items-center h-100">
							<div class="form-group col-3">
								<label for="del-manu">Manufacturer Name: </label>
								<input type="text" name="del-manu" id="del-manu" class="form-control" required>
						  </div>
						</div>
						<input name="delete-manufacturer" type="submit" value="Delete" id="delete-manufacturer">
					</form>
			 </div>
		</div>
		<div id="manu-msg">
			<?php
				if($_SESSION['msg'] == NULL){}
				else print $_SESSION['msg'];
				unset($_SESSION['msg']);
			?>
		</div>
	</div>
	<br><br>
	<div class="box">
		<fieldset>
		<legend><h3><span>Manufacturers</span></h3></legend>
		<table id="current-manufacturers" class="table table-striped table-bordered nowrap">
		<thead>
		<tr>
		<th>Name</th>
		<th>Phone</th>
		<th>Website</th>
		</tr>
		</thead>
		<tbody>
		<?php
		for($i = 0; $i < sizeof($TMName); $i++)
		{
		print '<tr>';
		print '<td>'.$TMName[$i].'</td><td>'.$TMPhNum[$i].'</td><td>'.$TMWeb[$i].'</td>';
		print '</tr>';
		}
		?>
		</tbody>
		</table>
		</fieldset>
	</div>
	</div>
	</div>
</body>
</html>
