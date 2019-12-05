<?php
  session_start();
	$_SESSION['timeout'] = time(); //record the time at the user login
	//require_once "inc/util.php";
	require_once "inc/dbconnect.php";

	$msg = "";
	$uname = "";
	$pwd = "";
  if (isset($_POST['submit']))
	{

		//take the information submitted and verify inputs
		$uname =  trim($_POST['username']);
		$pwd = trim($_POST['password']);
		//now veriy the username and password


		//security measure 2: use stored procedures
		$sql = "Call Authenticate('".$uname."', '".$pwd."');";

		$stmt = $con->query($sql);
		if (!$stmt) {
			$msg = "Username or password incorrect";
		}
		else {
			$row = $stmt->fetch(PDO::FETCH_OBJ);

			$count = $row->C;

			//check if we have the user in the database
			if ($count == 1){
				$sql = "Call Valid(?, ?);";
				$stmt2 = $con->prepare($sql);
				$stmt2->execute(array($uname, $pwd));
				$row = $stmt->fetch(PDO::FETCH_OBJ);

					$uid = $row->uid;
					$_SESSION['uid'] = $uid;
					$_SESSION['uname'] = $uname;

				print " User authenticated";
				Header ("Location:home.php");

			}
			else $msg = "The information entered does not match with the records in our database.";

		}

	}

?>
<!DOCTYPE html>
<html lang="en-US">
<head>
	<META http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type"/>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	
	<!--- Css Links -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/login.css">
	

	<!--  Js Links-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

	<title>Asset Login Portal</title>

</head>
<br>
<body>
	<div class="login-form">
		<form action="login.php" method="POST" id="fm1">
			<h2 class="text-center">Login</h2>
			<div class="form-group">
				<input type="text" id="username" class="form-control" name="username" placeholder="Username" max-length="8" required/>
			</div>
			<div class="form-group">
				<input type="password" id="password" class="form-control" name="password" placeholder="Password" max-length="16" required/>
			</div>
			<div class="form-group">
				<button type="submit" id="login-button" class="btn btn-primary btn-block" name="submit">Login</button>
			</div>
			<?php  echo $msg; ?>
		</form>
	</div>	
</body>
</html>
