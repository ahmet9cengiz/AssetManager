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
  <script src="js/settings-manufacturers.js"></script>
  <!-- DataTables JS functionality-->
  <script src="DataTables/datatables.js"></script>
  <script scr="DataTables/DataTables-1.10.18/js/dataTables.jqueryui.js"></script>

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
							<li class="selected"><a href="settings-manufacturers.php">Manufacturers</a></li>
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
					<div id="tabs">
						<ul>
							<li><a href="#add-manufacturer">Add Manufacturer</a></li>
							<li><a href="#update-manufacturer">Update Manufacturer</a></li>
							<li><a href="#delete-manufacturer">Delete Manufacturer</a></li>
						</ul>
						<div id="add-manufacturer">
							<form action="process/manufacturer-process.php" method="POST" style="height: 50px;">
								<label for="manu-name">Manufacturer Name: </label>
								<input type="text" name="manu-name" required>
								<label for="manu-phone">Phone: </label>
								<input type="text" name="manu-phone">
								<label for="manu-web">Website: </label>
								<input type="text" name="manu-web"><br><br>
								<input name="add-manufacturer" type="submit" value="Add" id="add-manufacturer">
							</form>
						</div>
						<div id="update-manufacturer">
							<form action="process/manufacturer-process.php" method="POST">
								<fieldset>
									<legend>Old Info</legend>
									<label for="old-manuname">Manufacturer Name: </label>
									<input type="text" name="old-manuname" required>
								</fieldset>
								<fieldset>
									<legend>New Info</legend>
									<label for="new-manuname">Manufacturer Name: </label>
									<input type="text" name="new-manuname" required>
									<label for="new-manuphone">Phone: </label>
									<input type="text" name="new-manuphone">
									<label for="new-manuweb">Website: </label>
									<input type="text" name="new-manuweb">
									<input name="update-manufacturer" type="submit" value="Update" id="update-manufacturer">
								</fieldset>
							</form>
						</div>
						<div id="delete-manufacturer">
							<form action="process/manufacturer-process.php" method="POST" style="height: 50px;">
									<label for="manuname">Manufacturer Name: </label>
									<input type="text" name="del-manu" required>
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
          <br><br>
          <fieldset>
            <legend><h3><span>Manufacturers</span></h3></legend>
            <table id="current-manufacturers" class="display" style="width: auto">
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
	</div>
</body>
</html>
