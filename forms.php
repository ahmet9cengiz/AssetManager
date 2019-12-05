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
	<title>Asset Manager</title>

	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width,  initial-scale=1">

	<!-- CSS to define theme colors -->
	<link href="jquery/overcast/jquery-ui.css" rel="stylesheet">
	<link href="css/style.css" type="text/css" rel="stylesheet">
  <link href="DataTables/datatables.css" type="text/css" rel="stylesheet">
  <link href="DataTables/DataTables-1.10.18/css/dataTables.jqueryui.css" type="text/css" rel="stylesheet">
  <link href="DataTables/DataTables-1.10.18/css/jquery.dataTables.css" type="text/css" rel="stylesheet">

  <!-- jsPdf cdn link -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
  <!-- jquery cdn link -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!--hosted jQuery library second-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- jQuery Validation -->
	<script src="validation/dist/jquery.validate.js"></script>
	<script src="validation/dist/additional-methods.js"></script>

  <!-- DataTables JS functionality-->
  <script src="DataTables/datatables.js"></script>
  <script scr="DataTables/DataTables-1.10.18/js/dataTables.jqueryui.js"></script>

  <!-- jQuery UI functionality -->
  <script src="jquery/jquery-ui.js"></script>
	<!-- Main JS -->
  <script src="js/loanForm.js"></script>
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
          <li class="selected">
            <a href="">Forms</a>
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
            <div class="tabs" id="tabs">
              <ul>
                <li><a href="#generate-loan-pdf">Generate PDF</a></li>
                <li><a href="#upload-loan-pdf">Upload PDF</a></li>
                <li><a href="#check-loan-pdf">Check Loan PDF</a></li>
                <li><a href="#delete-loan-pdf">Delete Loan PDF</a></li>
              </ul>
            <div id="generate-loan-pdf">
              <fieldset>
                <label for="firstname">First Name:</label>
                  <input type="text" name="firstname" id="firstname" required>
                <label for="lastname">Last Name:</label>
                  <input type="text" name="lastname" id="lastname" required>
                <label for="email">Email:</label>
                  <input type="email" name="email" id="email" required>
                <label for="purpose">Purpose:</label>
                  <select name="purpose" id="purpose">
                    <option selected>Faculty use for class.</option>
                    <option>Faculty use for meeting.</option>
                    <option>Staff use for work at home.</option>
                    <option>Staff use for meeting.</option>
                  </select>
                <br><br>
                <label for="service-tag">Service Tag:</label>
                  <input type="text" name="service-tag" id="service-tag" required>
                <label for="loan-date">Loan Date:</label>
                  <input type="date" name="loan-date" id="loan-date" required>
                <label for="return-date">Return Date:</label>
                  <input type="date" name="return-date" id="return-date">
                  <br></br>
                <button type="button" id="submit">Generate Loan PDF</button>
                <div>
                  <?php echo $message;  ?>
                </div>
              </fieldset>
            </div>
            <div id="upload-loan-pdf">
              <fieldset>
                <form action="uploadPdf.php" method="POST" enctype="multipart/form-data">
                  <label for="up-service-tag">Service Tag:</label>
                    <input type="text" name="up-service-tag" id="up-service-tag" required>
                  <input type="file" name="uploaded-pdf" style="border: 1px black; background-color: white; width: 250px;">
                  <br></br>
                  <input type="submit" name="submit" value="Upload PDF">
                </form>
                <div>
                  <?php echo $message;  ?>
                </div>
              </fieldset>
            </div>
            <div id="check-loan-pdf">
              <fieldset>
                <form action="downloadPdf.php" method="POST" >
                  <label for="down-service-tag">Service Tag:</label>
                    <input type="text" name="down-service-tag" id="down-service-tag" required>
                    <br></br>
                  <input type="submit" name="submit" value="Download PDF">
                </form>
                <div>
                  <?php echo $message;  ?>
                </div>
              </fieldset>
            </div>
            <div id="delete-loan-pdf">
              <fieldset>
                <form action="deletePdf.php" method="POST">
                  <label for="del-service-tag">Service Tag:</label>
                    <input type="text" name="del-service-tag" id="del-service-tag" required>
                    <br></br>
                  <input type="submit" name="submit" value="Delete PDF">
                </form>
                <div>
                <?php echo $message;  ?>
                </div>
              </fieldset>
            </div>
         </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
