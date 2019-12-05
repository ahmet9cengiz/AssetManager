<?php
	session_start();
	require "inc/sessionVerify.php";
	require "inc/dbconnect.php";
	require "tables/settings-user-table.php";
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
  <title>Asset Manager</title>
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
  <script src="js/settings-users.js"></script>


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
              <li><a class="dropdown-item navigation active" href="settings-users.php">Users</a></li>
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
      <div class="nav-tabs" id="tabs" style="text-align: center;">
	      <ul>
					<li style="float: none; display: inline-block;"><a href="#add-user">Add User</a></li>
					<li style="float: none; display: inline-block;"><a href="#update-user">Update User</a></li>
					<li style="float: none; display: inline-block;"><a href="#delete-user">Delete User</a></li>
				</ul>
					<div id="add-user">
						<form action="process/user-process.php" method="POST">
							<div class="row justify-content-center align-items-center h-100">
   							<div class="form-group col-2">
									<label>First Name: </label><input type="text" name="add-fn" class="form-control" required>
								</div>
								<div class="form-group col-2">
									<label>Last Name: </label><input type="text" name="add-ln" class="form-control" required>
								</div>
								<div class="form-group col-2">
									<label>Email: </label><input type="email" name="add-email" class="form-control" required>
								</div>
								<div class="form-group col-2">
									<label>Phone Number: </label><input type="phone" name="add-phone" class="form-control">
								</div>
								<div class="form-group col-2">
									<label>Room: </label><input type="text" name="add-room" class="form-control">
								</div>
							</div>
							<input name = "add-user" type="submit" value="Add" id="add-user">
						</form>
					</div>
					<div id="update-user">
						<form action="process/user-process.php" method="POST">
							<div class="row justify-content-center align-items-center h-100">
								<legend>Old Info</legend>
								<div class="form-group col-2">
									<label>First Name: </label>
									<input type="text" name="old-fn" class="form-control" required>
								</div>
								<div class="form-group col-2">
									<label>Last Name: </label>
									<input type="text" name="old-ln" class="form-control" required>
								</div>
								<div class="form-group col-2">
									<label>Email: </label>
									<input type="email" name="old-email" class="form-control" required>
								</div>
								<legend>New Info</legend>
								<div class="form-group col-2">
									<label>First Name: </label>
									<input type="text" name="new-fn" class="form-control" required>
								</div>
								<div class="form-group col-2">
									<label>Last Name: </label>
									<input type="text" name="new-ln" class="form-control" required>
								</div>
								<div class="form-group col-2">
									<label>Email: </label>
									<input type="email" name="new-email" class="form-control" required>
								</div>
								<div class="form-group col-2">
									<label>Phone Number: </label>
									<input type="phone" name="new-phone" class="form-control">
								</div>
								<div class="form-group col-2">
									<label>Room: </label>
									<input type="text" name="new-room" class="form-control">
								</div>
						</div>
						<input name = "update-user" type="submit" value="Update" id="update-user">
					</form>
				</div>
				<div id="delete-user">
					<form action="process/user-process.php" method="POST">
						<div class="row justify-content-center align-items-center h-100">
							<div class="form-group col-2">
								<label>First Name: </label><input type="text" name="del-fn" class="form-control" required>
							</div>
							<div class="form-group col-2">
								<label>Last Name: </label><input type="text" name="del-ln" class="form-control" required>
							</div>
							<div class="form-group col-2">
								<label>Email: </label><input type="email" name="del-email" class="form-control" required>
							</div>
						</div>
						<input name = "delete-user" type="submit" value="Delete" id="delete-user">
					</form>
				</div>
			</div>
			<div id="user-msg">
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
	      <legend><h3><span>Current Users</span></h3></legend>
	      <table id="current-users" class="display">
	        <thead>
	          <tr>
	            <th>First Name</th>
	            <th>Last Name</th>
	            <th>Email</th>
	            <th>Phone</th>
	            <th>Room</th>
	          </tr>
	        </thead>
	        <tbody>
	          <?php
	            for($i = 0; $i < sizeof($SUTLN); $i++)
	            {
	              print '<tr>';
	              print '<td>'.$SUTFN[$i].'</td><td>'.$SUTLN[$i].'</td><td>'.$SUTE[$i].'</td><td>'.$SUTPH[$i].'</td><td>'.$SUTR[$i].'</td>';
	              print '</tr>';
	            }
	          ?>
	        </tbody>
	      </table>
	    </fieldset>
		</div>
	</div>
</body>
</html>
