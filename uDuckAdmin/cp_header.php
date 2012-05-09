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
	<link  rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
<div id=wrapper>
	<div id=headerdiv >
		<img src="img/uDuckLogo.png" alt="a" height="100" width="100" id="headerlogo" />
		<span>It may be ugly, but its work is beautiful.</span><br>
		<H1 id="headertitle">uDuck Content Management System<br></H1>
		<a href="actions/logout.php" id="headerlogout">logout</a>
		
	</div><!--end header div-->
	<div id=sidebardiv>
		
	</div>
	
