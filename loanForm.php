<!DOCTYPE html>

<?php
    session_start();
    //require_once "inc/dbconnect.php";
    //require "inc/sessionVerify.php";
    //require_once "dbconnect.php";

    $message = "";
    if(isset($_SESSION['message'])){
      $message = $_SESSION['message'];
      unset($_SESSION['message']);
    }

?>



<html>
<head>
	<title>Asset Manager</title>

	<meta charset="UTF-8">

  <meta name="viewport" content="width=device-width,  initial-scale=1">
  <!-- jsPdf cdn link -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
  <!-- jquery cdn link -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  
  <script src="loanForm.js"></script>

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
						<a href="reports.php">Reports</a>
					</li>
					<li class="selected">
						<a href="asset-manager.php">Asset Manager</a>
					</li>
					<li>
						<a href="">Settings</a>
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
              <li><a href="#check-loan-pdf">Upload PDF</a></li>
            </ul>
          </div>
          <div id="generate-loan-pdf">
            <fieldset>
              <label for="firstname">First Name:</label>
                <input type="text" name="firstname" id="firstname" value="Ahmet Yahya" required>
              <label for="lastname">Last Name:</label>
                <input type="text" name="lastname" id="lastname" value="Cengiz" required>
              <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="ahcengiz@iu.edu"required>
              <label for="purpose">Purpose</label>
                <select name="purpose" id="purpose">
                  <option selected>Faculty use for class.</option>
                  <option>Faculty use for meeting.</option>
                  <option>Staff use for work at home.</option>
                  <option>Staff use for meeting.</option>
                </select>   
              <br><br>
              <label for="service-tag">Service Tag</label>
                <input type="text" name="service-tag" id="service-tag" value="1234ABCD" required>
              <label for="loan-date">Loan Date:</label>
                <input type="date" name="loan-date" id="loan-date"value="2019-11-20" required>
              <label for="return-date">Return Date:</label>
                <input type="date" name="return-date" id="return-date" value="2019-12-20">
            </fieldset>  
            <button type="button" id="submit">Generate Loan PDF</button>
          </div>  
          <div id="upload-loan-pdf">
            <fieldset>
              <form action="uploadPdf.php" method="POST" enctype="multipart/form-data">
                <label for="up-service-tag">Service Tag:</label>
                  <input type="text" name="up-service-tag" id="up-service-tag" value="1234ABCD" required>  
                <input type="file" name="uploaded-pdf">
                <input type="submit" name="submit" value="Upload PDF">
              </form>
            </fieldset>
          </div>
          <div id="check-loan-pdf">
            <fieldset>
              <form action="downloadPdf.php" method="POST" >
                <label for="down-service-tag">Service Tag:</label>
                  <input type="text" name="down-service-tag" id="down-service-tag" value="1234ABCD" required>
                <input type="submit" name="submit" value="Download PDF">
              </form>
          </div>  
        </div>
        <div id="asset-msg">
          <?php echo $message; ?>
        </div>  
      </div>  
