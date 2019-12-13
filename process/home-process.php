<?php
	require_once "../inc/dbconnect.php";
	$tag = $_POST['tag'];	
	$ldate = date("Y-m-d");
	$stmt = $con->prepare("call GetVerifyDays('$tag');");
	$stmt->execute();
	$days = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$ver =  $days[0]['VerificationDays'];;
	$future = date("Y-m-d", strtotime($ldate . "+" . $ver . " days"));
	echo $tag;
	echo gettype($tag), "\n";
	echo $ldate;
	echo gettype($ldate), "\n";

	echo $future;
	echo gettype($future), "\n";
	$stmt = $con->prepare("call Set_FutureVerify('$tag, $ldate, $future');");
	$stmt->execute();
	if($stmt)
	{
		echo "Got it";
	}
	else
	{
		echo "No go";
	}
	
?>