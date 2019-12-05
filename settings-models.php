<?php
	session_start();
	require "inc/sessionVerify.php";
	require "inc/dbconnect.php";
	require "tables/settings-model-table.php";
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
  <script src="js/settings-models.js"></script>
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
							<li class="selected"><a href="settings-models.php">Models</a></li>
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
							<li><a href="#add-model">Add Model</a></li>
							<li><a href="#update-model">Update Model</a></li>
							<li><a href="#delete-model">Delete Model</a></li>
						</ul>
					<div id="add-model">
						<form id="add-model" action="process/model-process.php" method="POST" style="height:125px;">
						<label for="add-category">Category: </label>
						<div class="row">
							<div class="form-group">
								<select name="add-category" required>
									<?php
										$categories = loadCategories();
										foreach($categories as $category)
										{
											echo "<option>".$category['CategoryName']."</option>";
										}
									?>
								</select>
							 </div>
						 </div>
						<label for="add-manufacturer">Manufacturer:</label>
						<div class="row">
							<div class="form-group">
								<select name="add-manufacturer" required>
									<?php
										$manufacturers = loadManufacturers();
										foreach($manufacturers as $manufacturer)
										{
											echo "<option>" .$manufacturer['ManufacturerName']. "</option>";
										}
										?>
								</select>
							</div>
						</div>
						<br><br>
						<label for="add-model-number">Model Number:</label>
						<input type="text" name="add-model-number" required>
						<label for="add-model-name">Model Name:</label>
						<input type="text" name="add-model-name">
						<br><br>
						<input name = "add-model" type="submit" value="Add" id="add-model">
				  </form>
				  </div>
					<div id="update-model">
					<form id="update-model" action="process/model-process.php" method="POST" style="height:300px;">
						<fieldset>
							<legend>Old Info</legend>
								<label for="old-category">Category: </label>
								<div class="row">
									<div class="form-group">
										<select name="old-category" required>
											<?php
											$cateList = loadCategories();
											foreach($cateList as $cate)
											{
												echo "<option>" .$cate['CategoryName']. "</option>";
											}
											?>
										</select>
									 </div>
								 </div>
								<label for="old-manufacturer">Manufacturer:</label>
								<div class="row">
									<div class="form-group">
										<select name="old-manufacturer" required>
											<?php

												$manuList = loadManufacturers();
												foreach($manuList as $manu)
												{
													echo "<option>" .$manu['ManufacturerName']. "</option>";
												}
												?>
										</select>
									</div>
								</div>
								<br><br>
								<label for="old-model-number">Model Number:</label>
								<input type="text" name="old-model-number" required>
								<label for="old-model-name">Model Name:</label>
								<input type="text" name="old-model-name">
						</fieldset>
						<fieldset>
							<legend>New Info</legend>
								<label for="new-category">Category: </label>
								<div class="row">
									<div class="form-group">
										<select name="new-category" required>
											<?php
											$cateList = loadCategories();
											foreach($cateList as $cate)
											{
												echo "<option>" .$cate['CategoryName']. "</option>";
											}
											?>
										</select>
									 </div>
								 </div>
								<label for="new-manufacturer">Manufacturer:</label>
								<div class="row">
									<div class="form-group">
										<select name="new-manufacturer" required>
											<?php
												$manuList = loadManufacturers();
												foreach($manuList as $manu)
												{
													echo "<option>" .$manu['ManufacturerName']. "</option>";
												}
												?>
										</select>
									</div>
								</div>
								<br><br>
								<label for="new-model-number">Model Number:</label><input type="text" name="new-model-number" required>
								<label for="new-model-name">Model Name:</label><input type="text" name="new-model-name">
								<br><br>
								<input name = "update-model" type="submit" value="Update" id="update-model">
						</fieldset>
					</form>
					</div>
					<div id="delete-model">
						<form id="delete-model" action="process/model-process.php" method="POST" style="height:125px;">
							<label for="del-category">Category: </label>
							<div class="row">
								<div class="form-group">
									<select name = "del-category" required>
										<?php
										$cateList = loadCategories();
										foreach($cateList as $cate)
										{
											echo "<option>" .$cate['CategoryName']. "</option>";
										}
										?>
									</select>
								 </div>
							 </div>
							<label for="del-manufactuer">Manufacturer:</label>
							<div class="row">
								<div class="form-group">
									<select name="del-manufacturer" required>
										<?php
											$manuList = loadManufacturers();
											foreach($manuList as $manu)
											{
												echo "<option>" .$manu['ManufacturerName']. "</option>";
											}
											?>
									</select>
								</div>
							</div>
							<br><br>
							<label for="del-model-number">Model Number:</label><input type="text" name="del-model-number" required>
							<label for="del-model-name">Model Name:</label><input type="text" name="del-model-name">
							<br><br>
							<input name="delete-model" type="submit" value="Delete" id="delete-model">
					  </form>
					</div>
				</div>
				<div id="model-msg">
					<?php
						if($_SESSION['msg'] == NULL){}
						else print $_SESSION['msg'];
						unset($_SESSION['msg']);
					?>
				</div>
          <br><br>
          <fieldset>
            <legend><h3><span>Models</span></h3></legend>
            <table id="current-models" class="display" style="width: auto">
              <thead>
                <tr>
                  <th>Model Number</th>
                  <th>Model Name</th>
                  <th>Manufacturer</th>
                  <th>Category</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  for($i = 0; $i < sizeof($MoNum); $i++)
                  {
                    print '<tr>';
                    print '<td>'.$MoNum[$i].'</td><td>'.$MoName[$i].'</td><td>'.$MoManu[$i].'</td><td>'.$MoCat[$i].'</td>';
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
