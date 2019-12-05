<?php
	session_start();
	require "inc/sessionVerify.php";
	require "inc/dbconnect.php";
	require "tables/settings-location-table.php";
	require_once "inc/dynamicDropdown.php";
	require "inc/util.php";
	if(!isset($_SESSION['msg']))
	{
		$_SESSION['msg'] = array();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Settings</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,  initial-scale=1">

  <!-- CSS-->
  <link href="jquery/overcast/jquery-ui.css" rel="stylesheet">
  <link href="DataTables/datatables.css" type="text/css" rel="stylesheet">
  <link href="DataTables/DataTables-1.10.18/css/dataTables.jqueryui.css" type="text/css" rel="stylesheet">
  <link href="DataTables/DataTables-1.10.18/css/jquery.dataTables.css" type="text/css" rel="stylesheet">
  <link href="css/style.css" type="text/css" rel="stylesheet">

  <!--hosted jQuery-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <!-- jQuery Validation -->
  <script src="validation/dist/jquery.validate.js"></script>
  <script src="validation/dist/additional-methods.js"></script>

  <!-- jQuery UI functionality -->
  <script src="jquery/jquery-ui.js"></script>

  <!-- DataTables JS functionality-->
  <script src="DataTables/datatables.js"></script>
  <script scr="DataTables/DataTables-1.10.18/js/dataTables.jqueryui.js"></script>

  <!-- Main JS -->
  <script src="js/settings-locations.js"></script>

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
					<li>
						<a href="reports.php">Reports</a>
					</li>
					<li>
						<a href="asset-manager.php">Asset Manager</a>
					</li>
					<li>
						<a>Settings</a>
						<ul>
							<li><a href="settings-users.php">Users</a></li>
							<li><a href="settings-categories.php">Categories</a></li>
							<li><a href="settings-manufacturers.php">Manufacturers</a></li>
							<li><a href="settings-models.php">Models</a></li>
							<li class="selected"><a href="settings-locations.php">Locations</a></li>
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
					<div id="tabs">
						<ul>
							<li><a href="#add-location">Add Location</a></li>
							<li><a href="#update-location">Update Location</a></li>
							<li><a href="#delete-location">Delete Location</a></li>
						</ul>
						<div id="add-location">
						<form action="process/location-process.php" method="POST" style="height: 50px;">
							<label for="add-location">Location Name:</label>
							<input type="text" name="location" required>
							<input name = "add-location" type="submit" value="Add" id="add-location">
						</form>
					  </div>
						<div id="update-location">
							<form action="process/location-process.php" method="POST">
								<fieldset>
									<legend>Old Info</legend>
									<label for="old-location">Location Name:</label>
									<input type="text" name="old-location" required>
								</fieldset>
								<fieldset>
									<legend>New Info</legend>
									<label for="new-location">Location Name:</label>
									<input type="text" name="new-location" required>
									<input name="update-location" type="submit" value="Update" id="update-location">
								</fieldset>
							</form>
					 </div>
					 <div id="delete-location">
							<form action="process/location-process.php" method="POST" style="height: 50px;">
								<label>Location Name:</label>
								<input type="text" name="del-location" required>
								<input name = "delete-location" type="submit" value="Delete" id="delete-location">
							</form>
					</div>
				</div>
				<div id="loc-msg">
					<?php
						if($_SESSION['msg'] == NULL){}
						else print $_SESSION['msg'];
						unset($_SESSION['msg']);
					?>
			  </div>
        <br>
				<br>
        <fieldset>
          <legend><h3><span>Locations</span></h3></legend>
          <table id="current-locations" class="display" style="width:35%">
            <thead>
              <tr>
                <th>Location Name</th>
              </tr>
            </thead>
            <tbody>
              <?php
                for($i = 0; $i < sizeof($LocName); $i++)
                {
                  print '<tr>';
                  print '<td>'.$LocName[$i].'</td>';
                  print '</tr>';
                }
              ?>
            </tbody>
          </table>
        </fieldset>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
