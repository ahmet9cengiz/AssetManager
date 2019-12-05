<?php
    session_start();
    require_once "inc/dbconnect.php";
    require "inc/sessionVerify.php";
    require 'inc/dynamicDropdown.php';
    require "inc/util.php";
    require "tables/asset-manager-table.php";

    if(!isset($_SESSION['msg']))
    {
      $_SESSION['msg'] = array();
    }

    //Autofill for duplicate button
    $category = NULL;
    $manufacturer = NULL;
    $model = NULL;
    $purchase = NULL;
    $warranty = NULL;
    $verifyDays = NULL;
    $surplus = NULL;
    $location = NULL;
    $network = NULL;
    $notes = NULL;

    if(isset($_SESSION['duplicate'])){
      $category = $_SESSION['category'];
      $manufacturer = $_SESSION['manufacturer'];
      $model = $_SESSION['model'];
      $purchase = $_SESSION['purchase'];
      $warranty = $_SESSION['warranty'];
      $verifyDays = $_SESSION['verifyDays'];
      $surplus = $_SESSION['surplus'];
      $location = $_SESSION['location'];
      $network = $_SESSION['network'];
      $notes = $_SESSION['notes'];
      unset($_SESSION['duplicate']); //unset the duplicate session variable each time
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
  <script src="js/asset-manager.js"></script>

  <!-- Add asset duplicate preselection -->
  <script>

  $(document).ready(function(){
    //preselect if duplicate

    var category = "<?php echo $category; ?>";
	  if(category != ""){
      var dropdown = document.getElementById('add-category');
      dropdown.options[0].selected = false;

      for(i = 0; i< dropdown.options.length; i++){

        if (dropdown.options[i].value == category){

          dropdown.options[i].selected = true;

          break;
        }
      }
    }

    //preselect if duplicate

    var manufacturer = "<?php echo $manufacturer; ?>";
    if(manufacturer != ""){
      var dropdown = document.getElementById('add-manufacturer');
      dropdown.options[0].selected = false;

      for(i = 0; i< dropdown.options.length; i++){

        if (dropdown.options[i].value == manufacturer){

          dropdown.options[i].selected = true;

          break;
        }
      }
    }

    //trigger the change event on manufacturer dropdown to load models
    $("#add-manufacturer").trigger('change');


    function preselectModel(){
      //preselect if duplicate
      var model = "<?php echo $model; ?>";
      if(model != ""){
        var dropdown = document.getElementById('model');
        dropdown.options[0].selected = false;

        for(i = 0; i< dropdown.options.length; i++){

          if (dropdown.options[i].value == model){

            dropdown.options[i].selected = true;

            break;
          }
        }

      }
    }


    setTimeout(preselectModel, 500);

    //preselect if duplicate

    var location = "<?php echo $location; ?>";
    if(location != ""){
      var dropdown = document.getElementById('add-location');
      dropdown.options[0].selected = false;

      for(i = 0; i< dropdown.options.length; i++){

        if (dropdown.options[i].value == location){

          dropdown.options[i].selected = true;

          break;
        }
      }

    }

    //preselect if duplicate
    var network = "<?php echo $network; ?>";
    if(network != ""){
      var dropdown = document.getElementById('add-network');
      dropdown.options[0].selected = false;

      for(i = 0; i< dropdown.options.length; i++){

        if (dropdown.options[i].value == network){

          dropdown.options[i].selected = true;

          break;
        }
      }

    }

    //preselect if duplicate

    var surplus = "<?php echo $surplus; ?>";
    if(surplus == "yes"){
      $('#surplus').checked = true;
    }

  });

  </script>

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
          <li class="nav-item active">
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
      <div class="nav-tabs" id="tabs">
        <ul>
          <li style="float: none; display: inline-block;"><a href="#add-asset">Add Item</a></li>
          <li style="float: none; display: inline-block;"><a href="#update-asset">Update Item</a></li>
          <li style="float: none; display: inline-block;"><a href="#delete-asset">Delete Item</a></li>
        </ul>
        <div id="add-asset">
          <form action="process/asset-process.php" method ="POST">
            <div class="row justify-content-center align-items-center h-100">
              <div class="form-group col-3">
                <label for="service-tag">Service Tag</label>
                <input type="text" class="form-control" name="service-tag" id="service-tag" required>
              </div>
              <div class="form-group col-3">
                <label for="add-category">Category</label>
                <select id="add-category" class="form-control" name="add-category">
                  <option disabled = "" selected = "">Select Category</option>
                  <?php
                  $categories = loadCategories();
                  foreach ($categories as $category)
                  {
                    echo "<option id = '" . $category['CategoryID'] . "'value = '" . $category['CategoryID'] . "'>" . $category['CategoryName'] . "</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group col-3">
                <label for="add-manufacturer">Manufacturer</label>
                <select id="add-manufacturer" class="form-control" name="add-manufacturer">
                  <option disabled="" selected="">Select Manufacturer</option>
                  <?php
                  $manufacturers = loadManufacturers();
                  foreach ($manufacturers as $manufacturer)
                  {
                    echo "<option id = '" . $manufacturer['ManufacturerID'] . "'value = '" . $manufacturer['ManufacturerID'] . "'>" . $manufacturer['ManufacturerName'] . "</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group col-3">
                <label for="model">Model</label>
                <select id = "model" class="form-control" name = "model" required>
                  <option disabled = "" selected = "">Select Model</option>
                </select>
              </div>
            </div>
            <div class="row justify-content-center align-items-center h-100">
              <div class="form-group col-3">
                <label for="add-location">Location</label>
                <select id="add-location" class="form-control" name="add-location">
                  <option disabled="" selected="">Select location</option>
                  <?php
                  $locations = loadLocations();
                  foreach ($locations as $location)
                  {
                    echo "<option id = '" . $location['LocationID'] . "'value = '" . $location['LocationName'] . "'>" . $location['LocationName'] . "</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group col-3">
                <label for="add-network">Network</label>
                <select id="add-network" class="form-control" name="add-network">
                  <option disabled="" selected="">Select Network</option>
                  <?php
                  $networks = loadNetworks();
                  foreach ($networks as $network)
                  {
                    echo "<option id = '" . $network['NetworkID'] . "'value = '" . $network['NetworkName'] . "'>" . $network['NetworkName'] . "</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group col-3">
                <label for="purchase-date">Purchase Date</label>
                <input type="date" name="purchase-date" class="form-control" value="<?php echo ($purchase == NULL) ? "" : $purchase; ?>" required>
              </div>
              <div class="form-group col-3">
                <label for="warranty">Warranty(in years)</label>
                <input type="number" name="warranty" class="form-control" value="<?php echo ($warranty == NULL) ? "" : $warranty; ?>" min="0" required>
              </div>
            </div>
            <div class="row justify-content-center align-items-center h-100">
              <div class="form-group col-3">
                <label for='verification-days'>Verification Days</label>
                <input type="number" name="verification-days" class="form-control" value="<?php echo ($verifyDays == NULL) ? "" : $verifyDays; ?>" min="0" required>
              </div>
              <div class="form-group col-4">
                <label for="notes">Notes</label>
                <textarea type="message" name="notes" class="form-control" cols="25" rows="1" maxlength="500"><?php echo ($notes == NULL) ? "" : $notes; ?></textarea><br>
              </div>
              <div class="form-check col-1" style="margin-left: 4px;">
                <input type="checkbox" id="surplus" class="form-check-input" name="surplus" value="yes">
                <label for="surplus" class="form-check-label">Surplus</label>
              </div>
            </div>
            <input type="submit" class="form-control-inline" name="add-asset" value="Add" id="add-asset">
            <input type="submit" class="form-control-inline" name="add-duplicate-asset" value="Duplicate" id="add-duplicate-asset">
          </form>
        </div>
        <div id="update-asset">
          <form action="process/asset-process.php" method="POST">
            <legend>Old Info</legend>
            <div class="row justify-content-center align-items-center h-100">
              <div class="form-group col-3">
                <label for="old-service-tag">Service Tag</label>
                <input type="text" class="form-control" name="old-service-tag" id="old-service-tag">
              </div>
              <div class="form-group col-3">
                <label for="old-category">Category</label>
                <select id="old-category" class="form-control" name="old-category">
                  <option disabled = "" selected = ""></option>
                  <?php
                  $categories = loadCategories();
                  foreach ($categories as $category)
                  {
                    echo "<option id = '" . $category['CategoryID'] . "'value = '" . $category['CategoryID'] . "'>" . $category['CategoryName'] . "</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group col-3">
                <label for="old-manufacturer">Manufacturer</label>
                <select id="old-manufacturer" class="form-control" name="old-manufacturer">
                  <option disabled="" selected=""></option>
                  <?php
                  $manufacturers = loadManufacturers();
                  foreach ($manufacturers as $manufacturer)
                  {
                    echo "<option id = '" . $manufacturer['ManufacturerID'] . "'value = '" . $manufacturer['ManufacturerID'] . "'>" . $manufacturer['ManufacturerName'] . "</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group col-3">
                <label for="old-model">Model</label>
                <select id="old-model" class="form-control" name="old-model">
                  <option disabled = "" selected = "">Select Model</option>
                </select>
              </div>
            </div>
            <legend>New Info</legend>
            <div class="row justify-content-center align-items-center h-100">
              <div class="form-group col-3">
                <label for="new-service-tag">Service Tag</label>
                <input type="text" class="form-control" name="new-service-tag" id="new-service-tag">
              </div>
              <div class="form-group col-3">
                <label for="new-category">Category</label>
                <select id="new-category" class="form-control" name="new-category">
                  <option disabled = "" selected = ""></option>
                  <?php
                  $categories = loadCategories();
                  foreach ($categories as $category)
                  {
                    echo "<option id = '" . $category['CategoryID'] . "'value = '" . $category['CategoryID'] . "'>" . $category['CategoryName'] . "</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group col-3">
                <label for="new-manufacturer">Manufacturer</label>
                <select id="new-manufacturer" class="form-control" name="new-manufacturer">
                  <option disabled="" selected=""></option>
                  <?php
                  $manufacturers = loadManufacturers();
                  foreach ($manufacturers as $manufacturer)
                  {
                    echo "<option id = '" . $manufacturer['ManufacturerID'] . "'value = '" . $manufacturer['ManufacturerID'] . "'>" . $manufacturer['ManufacturerName'] . "</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group col-3">
                <label for="new-model">Model</label>
                <select id = "new-model" class="form-control" name = "new-model">
                  <option disabled = "" selected = "">Select Model</option>
                </select>
              </div>
            </div>
            <div class="row justify-content-center align-items-center h-100">
              <div class="form-group col-3">
                <label for="new-firstname">First Name</label>
                <input type="text" class="form-control" name="new-firstname">
              </div>
              <div class="form-group col-3">
                <label for="new-lastname">Last Name</label>
                <input type="text" class="form-control" name="new-lastname">
              </div>
              <div class="form-group col-3">
                <label for="new-location">Location</label>
                <input type="text" class="form-control" name="new-location">
              </div>
            </div>
            <div class="row justify-content-center align-items-center h-100">
              <div class="form-group col-3">
                <label for="new-network">Network</label>
                <input type="text" class="form-control" name="new-network">
              </div>
              <div class="form-group col-6">
                <label for="new-notes">Notes</label>
                <textarea type="message" class="form-control" name= "notes" cols="25" rows="1" maxlength="500"></textarea>
              </div>
            </div>
              <input type="submit" class="form-control-inline" name="update-asset" value="Update" id="update-asset">
          </form>
        </div>
        <div id="delete-asset">
          <form action="process/asset-process.php" method ="POST">
            <div class="row justify-content-center align-items-center h-100">
              <div class="form-group col-3">
                <label for="delete-service-tag">Service Tag</label>
                <input type="text" class="form-control" name="delete-service-tag" id="delete-service-tag">
              </div>
              <div class="form-group col-3">
                <label for="del-category">Category</label>
                <select id="del-category" class="form-control" name="del-category">
                  <option disabled = "" selected = ""></option>
                  <?php
                  $categories = loadCategories();
                  foreach ($categories as $category)
                  {
                    echo "<option id = '" . $category['CategoryID'] . "'value = '" . $category['CategoryID'] . "'>" . $category['CategoryName'] . "</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group col-3">
                <label for="del-manufacturer">Manufacturer</label>
                <select id="del-manufacturer" class="form-control" name="del-manufacturer">
                  <option disabled="" selected=""></option>
                  <?php
                  $manufacturers = loadManufacturers();
                  foreach ($manufacturers as $manufacturer)
                  {
                    echo "<option id = '" . $manufacturer['ManufacturerID'] . "'value = '" . $manufacturer['ManufacturerID'] . "'>" . $manufacturer['ManufacturerName'] . "</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group col-3">
                <label for="del-model">Model</label>
                <select id = "del-model" class="form-control" name = "del-model">
                  <option disabled = "" selected = "">Select Model</option>
                </select>
              </div>
            </div>
            <input type="submit" class="form-control-inline" name="delete-asset" value="Delete" id="delete-asset">
          </form>
        </div>
      </div>
      <div id="asset-msg">
        <?php
          if($_SESSION['msg'] == NULL){}
          else print $_SESSION['msg'];
          unset($_SESSION['msg']);
        ?>
      </div>
    </div>
  </div>
  <div class="container text-center">
    <div class="box">
      <legend><h3><span>Items</span></h3></legend>
      <table id="all-items" class="table table-striped table-bordered nowrap">
        <thead>
          <tr>
            <th>Service Tag</th>
            <th>Model Number</th>
            <th>Model Name</th>
            <th>User</th>
            <th>Purchase Date</th>
            <th>Warranty</th>
            <th>Warranty Expire</th>
            <th>Surplus</th>
            <th>Verification Days</th>
            <th>Last Verified</th>
            <th>Future Verify</th>
            <th>Location</th>
            <th>Network</th>
            <th>Manufacturer</th>
            <th>Category</th>
          </tr>
        </thead>
        <tbody>
          <?php
            for($i = 0; $i < sizeof($ST); $i++)
            {
              print '<tr>';
              print '<td>'.$ST[$i].'</td><td>'.$MoNum[$i].
              '</td><td>'.$MoName[$i].'</td><td>'.$User[$i].
              '</td><td>'.$purchaseDate[$i].'</td><td>'.$wrnty[$i].
              '</td><td>'.$wrnty_end[$i].'</td><td>'.($surplus[$i]==1 ? 'Yes' : 'No').
              '</td><td>'.$vdays[$i].'</td><td>'.$lastV[$i].'</td><td>'.$futureV[$i].
              '</td><td>'.$loc[$i].'</td><td>'.$net[$i].'</td><td>'.$manu[$i].
              '</td><td>'.$cat[$i].'</td>';
              print '</tr>';
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
