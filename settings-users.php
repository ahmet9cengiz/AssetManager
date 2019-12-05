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
<html>
<head>
  <title>Settings</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,  initial-scale=1">

  <!-- CSS-->
	<link href="jquery/overcast/jquery-ui.css" rel="stylesheet">
	<link  href="css/style.css" type="text/css" rel="stylesheet">
  <link href="DataTables/datatables.css" type="text/css" rel="stylesheet">
  <link href="DataTables/DataTables-1.10.18/css/dataTables.jqueryui.css" type="text/css" rel="stylesheet">
  <link href="DataTables/DataTables-1.10.18/css/jquery.dataTables.css" type="text/css" rel="stylesheet">

  <!--hosted jQuery-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <!-- jQuery Validation -->
  <script src="validation/dist/jquery.validate.js"></script>
  <script src="validation/dist/additional-methods.js"></script>

  <!-- jQuery UI functionality -->
	<script src="DataTables/datatables.js"></script>
	<script scr="DataTables/DataTables-1.10.18/js/dataTables.jqueryui.js"></script>
	<script src="jquery/jquery-ui.js"></script>
  <script src="js/settings-users.js"></script>


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
							<li class="selected"><a href="settings-users.php">Users</a></li>
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
					<div id="tabs">
						<ul>
							<li><a href="#add-user">Add User</a></li>
							<li><a href="#update-user">Update User</a></li>
							<li><a href="#delete-user">Delete User</a></li>
						</ul>
						<div id="add-user">
							<form action="process/user-process.php" method="POST" style="height: 100px;">
								<label>First Name: </label><input type="text" name="add-fn" required>
								<label>Last Name: </label><input type="text" name="add-ln" required>
								<label>Email: </label><input type="email" name="add-email" required>
								<br><br>
								<label>Phone Number: </label><input type="phone" name="add-phone">
								<label>Room: </label><input type="text" name="add-room">
								<input name = "add-user" type="submit" value="Add" id="add-user">
							</form>
						</div>
						<div id="update-user">
							<form action="process/user-process.php" method="POST">
								<fieldset>
									<legend>Old Info</legend>
									<label>First Name: </label>
									<input type="text" name="old-fn" required>
									<label>Last Name: </label>
									<input type="text" name="old-ln" required>
									<label>Email: </label>
									<input type="email" name="old-email" required>
								</fieldset>
								<fieldset>
									<legend>New Info</legend>
									<label>First Name: </label>
									<input type="text" name="new-fn" required>
									<label>Last Name: </label>
									<input type="text" name="new-ln" required>
									<label>Email: </label>
									<input type="email" name="new-email" required>
									<br><br><br>
									<label>Phone Number: </label>
									<input type="phone" name="new-phone">
									<label>Room: </label>
									<input type="text" name="new-room">
									<input name = "update-user" type="submit" value="Update" id="update-user">
								</fieldset>
							</form>
						</div>
						<div id="delete-user">
							<form action="process/user-process.php" method="POST" style="height: 50px;">
								<label>First Name: </label><input type="text" name="del-fn" required>
								<label>Last Name: </label><input type="text" name="del-ln" required>
								<label>Email: </label><input type="email" name="del-email" required>
								<input name = "delete-user" type="submit" value="Delete" id="delete-user">
							</form>
						</div>
					</div>
					<br>
					<div id="user-msg">
						<?php
							if($_SESSION['msg'] == NULL){}
							else print $_SESSION['msg'];
							unset($_SESSION['msg']);
						?>
					</div>
					<br>
          <fieldset>
            <legend><h3><span>Current Users</span></h3></legend>
            <table id="current-users" class="display" style="width:auto;">
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
		</div>
	</div>
</body>
</html>
