<?php
    session_start();
    require_once "inc/dbconnect.php";
    require "inc/sessionVerify.php";
    require 'inc/dynamicDropdown.php';
	  require "inc/util.php";
    // require "tables/asset-manager-table.php";

    $message = "";
    if(isset($_SESSION['message'])){
      $message = $_SESSION['message'];
      unset($_SESSION['message']);
    }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Forms</title>
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

	<!-- Main JS -->
  <script src="js/loanForm.js"></script>
  
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
          <li class="nav-item active">
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
      <div class="nav-tabs" id="tabs">
        <ul>
          <li style="float: none; display: inline-block;"><a href="#generate-loan-pdf">Generate PDF</a></li>
          <li style="float: none; display: inline-block;"><a href="#upload-loan-pdf">Upload PDF</a></li>
          <li style="float: none; display: inline-block;"><a href="#check-loan-pdf">Check Loan PDF</a></li>
          <li style="float: none; display: inline-block;"><a href="#delete-loan-pdf">Delete Loan PDF</a></li>
        </ul>
        <div id="generate-loan-pdf">
          <div class="row justify-content-center align-items-center h-100">
            <div class="form-group col-2">
              <label for="firstname">First Name:</label>
              <input type="text" name="firstname" id="firstname" class="form-control" required>
            </div>
            <div class="form-group col-2">
              <label for="lastname">Last Name:</label>
              <input type="text" name="lastname" id="lastname" class="form-control" required>
            </div>
            <div class="form-group col-2">
              <label for="email">Email:</label>
              <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group col-3">
              <label for="purpose">Purpose:</label>
              <select name="purpose" id="purpose" class="form-control">
                <option selected>Faculty use for class.</option>
                <option>Faculty use for meeting.</option>
                <option>Staff use for work at home.</option>
                <option>Staff use for meeting.</option>
              </select>
            </div>
          </div>
          <div class="row justify-content-center align-items-center h-100">
            <div class="form-group col-2">
              <label for="service-tag">Service Tag:</label>
              <input type="text" name="service-tag" id="service-tag" class="form-control" required>
            </div>
            <div class="form-group col-2">
              <label for="loan-date">Loan Date:</label>
              <input type="date" name="loan-date" id="loan-date" class="form-control" required>
            </div>
            <div class="form-group col-2">
              <label for="return-date">Return Date:</label>
              <input type="date" name="return-date" id="return-date" class="form-control">
            </div>
          </div>
          <button type="button" id="submit">Generate Loan PDF</button>
          <?php echo $message;  ?>
        </div>
        <div id="upload-loan-pdf">
          <form action="uploadPdf.php" method="POST" enctype="multipart/form-data">
            <div class="row justify-content-center align-items-center h-100">
              <div class="form-group col-3">
                <label for="up-service-tag">Service Tag:</label>
                <input type="text" name="up-service-tag" id="up-service-tag" class="form-control" required>
              </div>
              <div class="form-group col-3">
                <label for="uploaded-pdf"></label>
                <input type="file" name="uploaded-pdf" style="border: 1px black; background-color: white; width: 250px;" class="form-control">
              </div>
            </div>
            <input type="submit" name="submit" value="Upload PDF">
          </form>
          <div>
            <?php echo $message;  ?>
          </div>
       </div>
      <div id="check-loan-pdf">
        <form action="downloadPdf.php" method="POST" >
          <div class="row justify-content-center align-items-center h-100">
            <div class="form-group col-2">
              <label for="down-service-tag">Service Tag:</label>
              <input type="text" name="down-service-tag" id="down-service-tag" class="form-control" required>
            </div>
            <input type="submit" name="submit" value="Download PDF">
          </div>
        </form>
        <div>
          <?php echo $message;  ?>
        </div>
      </div>
      <div id="delete-loan-pdf">
        <form action="deletePdf.php" method="POST">
          <div class="row justify-content-center align-items-center h-100">
            <div class="form-group col-2">
              <label for="del-service-tag">Service Tag:</label>
              <input type="text" name="del-service-tag" id="del-service-tag" class="form-control" required>
            </div>
            <input type="submit" name="submit" value="Delete PDF">
          </div>
        </form>
        <div>
          <?php echo $message;  ?>
        </div>
     </div>
   </div>
  </div>
</div>
</body>
</html>
