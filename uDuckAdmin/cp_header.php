<?php
	session_start();
	require_once "uD_config.php";
	if(!isset($_SESSION['uID'])){//if you aren't logged in go to login page
		/* Redirect browser */
		header("Location: ./loginForm.php");
		exit;	
	}
	
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
	<title>uDuck Control Panel</title>
</head>
<body>
	<!--check if logged in-->
