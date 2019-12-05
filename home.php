<?php
    session_start();
    require_once "inc/dbconnect.php";
    require "inc/sessionVerify.php";
    require "inc/count_and_verify.php";
    require "inc/util.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

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

  <script>
    var AL = <?php echo $AL ?>;
    var SL = <?php echo $SL ?>;
    var AT = <?php echo $AT ?>;
    var ST = <?php echo $ST ?>;
    var AD = <?php echo $AD ?>;
    var SD = <?php echo $SD ?>;
    var AVC = <?php echo $AVC ?>;
    var SVC = <?php echo $SVC ?>;
    var AP = <?php echo $AP ?>;
    var SP = <?php echo $SP ?>;
  </script>

  <!-- Main JS -->
  <script src="js/home.js"></script>

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
          <li class="nav-item active">
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
      <legend><h3><span>Current Count</span></h3></legend>
      <div class="row">
        <div class="col-4">
          <label for="tablets">Tablets</label>
          <canvas id="tablets"></canvas>
        </div>
        <div class="col-4">
          <label for="video-conferencing">Video Conferencing</label>
          <canvas id="video-conferencing"></canvas>
        </div>
        <div class="col-4">
          <label for="printers">Printers</label>
          <canvas id="printers"></canvas>
        </div>
      </div>
      <br />
      <div class="row">
        <div class="col-6">
          <label for="laptops">Laptops</label>
          <canvas id="laptops"></canvas>
        </div>
        <div class="col-6">
          <label for="desktops">Desktops</label>
          <canvas id="desktops"></canvas>
        </div>
      </div>
    </div>
    <div class="box">
      <legend><h3><span>Verify Assets</span></h3></legend>
      <table id="verify-table" class="table table-striped table-bordered nowrap">
        <thead>
          <tr>
            <th>Service Tag</th>
            <th>Model No.</th>
            <th>Network Name</th>
            <th>Location</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Verify</th>
          </tr>
        </thead>
        <tbody>
          <?php
            for($i = 0; $i < sizeof($VST); $i++)
            {
              print '<tr>';
              print '<td>'.$VST[$i].'</td><td>'.$VMN[$i].'</td><td>'.$VNN[$i].'</td><td>'.$VLoc[$i].'</td><td>'.$VFN[$i].'</td><td>'.$VLN[$i].'</td><td></td>';
              print '</tr>';
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
