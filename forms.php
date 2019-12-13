<?php
    session_start();
    require_once "inc/dbconnect.php";
    require "inc/sessionVerify.php";
    require 'inc/dynamicDropdown.php';
	  require "inc/util.php";
    require "tables/forms-table.php";
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
  <!-- jQuery UI functionality -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
  <!-- jsPdf cdn link -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
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
      <div class="nav-tabs" id="loan-tabs">
        <ul>
          <li style="float: none; display: inline-block;"><a href="#generate-loan-form">Generate Loan Form</a></li>
          <li style="float: none; display: inline-block;"><a href="#check-out-item">Loan</a></li>
          <li style="float: none; display: inline-block;"><a href="#check-in-item">Return</a></li>
        </ul>
        <div id="generate-loan-form">
          <div class="row justify-content-center align-items-center h-100">
            <div class="form-group col-4">
              <label for="gen-firstname">First Name:</label>
              <select id="gen-firstname" class="form-control" name="gen-firstname">
                <option disabled = "" selected = "">Select First Name</option>
                <?php
                $firstnames = loadFirstNames();
                foreach ($firstnames as $firstname)
                {
                  echo "<option id = '" . $firstname['UserID'] . "'value = '" . $firstname['UserID'] . "'>" . $firstname['FirstName'] . "</option>";
                }
                ?>
              </select>
            </div>
            <div class="form-group col-4">
              <label for="gen-lastname">Last Name:</label>
              <select id="gen-lastname" class="form-control" name="gen-lastname">
                <option disabled = "" selected = "">Select Last Name</option>
                <?php
                $lastnames = loadLastNames();
                foreach ($lastnames as $lastname)
                {
                  echo "<option id = '" . $lastname['UserID'] . "'value = '" . $lastname['UserID'] . "'>" . $lastname['LastName'] . "</option>";
                }
                ?>
              </select>
            </div>
            <div class="form-group col-4">
              <label for="gen-email">Email:</label>
              <select id="gen-email" class="form-control" name="gen-email">
                <option disabled = "" selected = "">Select Email</option>
              </select>
            </div>
          </div>
          <div class="row justify-content-center align-items-center h-100">
            <div class="form-group col-4">
              <label for="gen-purpose">Purpose:</label>
              <select name="gen-purpose" id="gen-purpose" class="form-control">
                <option disabled = "" selected = "">Select Purpose</option>
                <option>Faculty use for class.</option>
                <option>Faculty use for meeting.</option>
                <option>Staff use for work at home.</option>
                <option>Staff use for meeting.</option>
              </select>
            </div>
            <div class="form-group col-4">
              <label for="gen-service-tag">Service Tag:</label>
              <select id="gen-service-tag" class="form-control" name="gen-service-tag">
                <option disabled = "" selected = "">Select Service Tag</option>
                <?php
                $serviceTags = loadServiceTags();
                foreach ($serviceTags as $serviceTag)
                {
                  echo "<option id = '" . $serviceTag['ItemID'] . "'value = '" . $serviceTag['ItemID'] . "'>" . $serviceTag['ServiceTag'] . "</option>";
                }
                ?>
              </select>
            </div>
            <div class="form-group col-4">
              <label for="gen-loan-date">Loan Date:</label>
              <input type="date" name="gen-loan-date" id="gen-loan-date" class="form-control">
            </div>
          </div>
          <button type="button" id="generate">Generate</button>
        </div>
        <div id="check-out-item">
          <form action="process/form-process.php" method="POST" enctype="multipart/form-data">
            <div class="row justify-content-center align-items-center h-100">
              <div class="form-group col-3">
                <label for="out-email">Email:</label>
                <select id="out-email" class="form-control" name="out-email" required>
                  <?php
                  $emails = loadEmails();
                  foreach ($emails as $email)
                  {
                    echo "<option id = '" . $email['UserID'] . "'value = '" . $email['UserID'] . "'>" . $email['email'] . "</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group col-2">
                <label for="out-service-tag">Service Tag:</label>
                <select id="out-service-tag" class="form-control" name="out-service-tag" required>
                  <?php
                  $serviceTags = loadServiceTags();
                  foreach ($serviceTags as $serviceTag)
                  {
                    echo "<option id = '" . $serviceTag['ItemID'] . "'value = '" . $serviceTag['ItemID'] . "'>" . $serviceTag['ServiceTag'] . "</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group col-3">
                <label for="out-loan-date">Loan Date:</label>
                <input type="date" name="out-loan-date" id="out-loan-date" class="form-control" required>
              </div>
              <div class="form-group col-4">
                <label for="out-upload-pdf">Upload Loan From:</label>
                <input type="file" name="out-upload-pdf" style="border: 1px black; background-color: white; width: 250px;" class="form-control">
              </div>
            </div>
            <input type="submit" name="out-submit" id="out-submit" value="Check-out">
          </form>
        </div>
        <div id="check-in-item">
          <form action="process/form-process.php" method="POST" enctype="multipart/form-data">
            <div class="row justify-content-center align-items-center h-100">
              <div class="form-group col-2">
                <label for="in-service-tag">Service Tag:</label>
                <select id="in-service-tag" class="form-control" name="in-service-tag" required>
                  <?php
                  $serviceTags = loadCheckedOutServiceTags();
                  foreach ($serviceTags as $serviceTag)
                  {
                    echo "<option id = '" . $serviceTag['ItemID'] . "'value = '" . $serviceTag['ItemID'] . "'>" . $serviceTag['ServiceTag'] . "</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group col-3">
                <label for="in-email">Email:</label>
                <select id="in-email" class="form-control" name="in-email" required>
                </select>
              </div>
              <div class="form-group col-3">
                <label for="in-return-date">Return Date:</label>
                <input type="date" name="in-return-date" id="in-return-date" class="form-control" required>
              </div>
              <div class="form-group col-4">
                <label for="in-upload-pdf">Upload Loan Form:</label>
                <input type="file" id="in-upload-pdf" name="in-upload-pdf" style="border: 1px black; background-color: white; width: 250px;" class="form-control">
              </div>
            </div>
            <input type="submit" name="in-submit" id="in-submit" value="Check-in">
          </form>
        </div>
      </div>
      <div id="message">
        <?php print $message; ?>
      </div>
    </div>
  </div>
  <div class="container text-center">
    <div class="box">
      <div class="nav-tabs" id="table-tabs">
        <ul>
          <li style="float: none; display: inline-block;"><a href="#current-loans">Current Loans</a></li>
          <li style="float: none; display: inline-block;"><a href="#loan-history">Loan History</a></li>
        </ul>
        <div id="current-loans">
          <table id="current-table" class="table table-striped table-bordered nowrap">
            <thead>
              <tr>
              <th>Service Tag</th>
              <th>User Email</th>
              <th>Loan Date</th>
              <th>Loan Form</th>
              </tr>
            </thead>
            <tbody>
              <?php
                for($i = 0; $i < sizeof($CurST); $i++)
                {
                  print '<tr>';
                  print '<td>'.$CurST[$i].'</td><td>'.
                  $CurEmail[$i].'</td><td>'.$CurLoanDate[$i].
                  '</td><td><a href="process/form-process.php?file='.$CurLoanForm[$i].'" class="btn">Download</a></td>';
                  print '</tr>';
                }
              ?>
            </tbody>
          </table>
        </div>
        <div id="loan-history">
          <table id="history-table" class="table table-striped table-bordered nowrap" style="width: 100%">
            <thead>
              <tr>
              <th>Service Tag</th>
              <th>User Email</th>
              <th>Loan Date</th>
              <th>Return Date</th>
              <th>Loan Form</th>
              </tr>
            </thead>
            <tbody>
              <?php
                for($i = 0; $i < sizeof($HistST); $i++)
                {
                  print '<tr>';
                  print '<td>'.$HistST[$i].'</td><td>'.
                  $HistEmail[$i].'</td><td>'.$HistLoanDate[$i].'</td><td>'.
                  $HistReturnDate[$i].'</td><td><a href="process/form-process.php?file='.$HistLoanForm[$i].'" class="btn">Download</a></td>';
                  print '</tr>';
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
