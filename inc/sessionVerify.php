<?php

if (!isset($_SESSION['uname'])) Header ("Location:login.php") ;

//session time out 1 minutes after login. The timeout variable is set in the login page
//keep refreshing the process.php page to see the behavior
if(!isset($_SESSION['timeout']))  Header ("Location:login.php") ;
	else
	if ($_SESSION['timeout'] + 1 * 600 < time())
			 Header ("Location:login.php") ;
	else 	$_SESSION['timeout'] = time();
?>
