<?php 
	session_start();
	require_once "inc/dbconnect.php";
	$tag = $_POST['tag'];	
	$curDate = $_POST['curDate'];
	$stmt = $con->prepare("call GetVerifyDays('$tag');");
	$stmt->execute();
	$verdays = $stmt->fetch(PDO::FETCH_OBJ);
	$days = $verdays->VerificationDays;
	$future = date("Y-m-d", strtotime($_POST['curDate'] . "+" . $days . " days"));
	$stmt = null;
 
	//Set stmt to null before next statement
	$stmt = $con->prepare("call Set_FutureVerify('$tag', '$curDate', '$future');");
	$stmt->execute();
	
?>