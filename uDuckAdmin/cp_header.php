<?php
	if($_SERVER["HTTPS"] != "on") {//make sure to page uses https
	   header("HTTP/1.1 301 Moved Permanently");
	   header("Location: https://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
	   exit();
	}

	session_start();
	//require_once "uD_config.php";
	require_once "adminAct.php";
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
		<span>It may be ugly, but if it works...</span><br>
		<H1 id="headertitle">uDuck Content Management System<br></H1>
		<a href="actions/logout.php" id="headerlogout" class="sans">logout</a>
		
	</div><!--end header div-->
	<div id=sidebardiv>
		<ul style="list-style-type: none; padding: 10px;">
			<li class="sans"><a href="test.php">Create Post</a></li>
			<li class="sans"><a href="test.php">Create Category</a></li>
			<li class="sans"><a href="test.php">Create Group</a></li>
		</ul>
	</div>
	
