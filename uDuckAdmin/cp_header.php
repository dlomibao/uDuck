<?php
	//require_once "uD_config.php";


	session_start();
	//require_once "uD_config.php";
	require_once "adminAct.php";
	$usehttps=USEHTTPS;
	if($usehttps && isset($_SERVER["HTTPS"])){
		header('Strict-Transport-Security: max-age=500');
	} elseif ($usehttps && !isset($_SERVER['HTTPS'])){//make sure to page uses https
	   header("HTTP/1.1 301 Moved Permanently");
	   header("Location: https://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
	   exit();
	}

	
	if(!isset($_SESSION['uID'])){//if you aren't logged in go to login page
		$_SESSION['origin']=$_SERVER['SCRIPT_NAME'];// store current page for redirect back later
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
		<div id="headeruserbox" class='sans fright'>
			<span >Hello, <?php echo $_SESSION['uName']; ?></span><br>
			<a href="actions/logout.php" id="headerlogout" >logout</a>
		</div>
	</div><!--end header div-->
	<div id=sidebardiv>
		<ul  class='sans'>
			<li><a href="test.php">Post</a>
				<ul><li>add new post</li>
					<li>edit/delete post</li>
				</ul>
			</li>
			<li><a href="test.php">Group</a>
				<ul><li>add new group</li>
					<li>edit/delete group</li>
				</ul>
			</li>
			<li><a href="test.php">Category</a>
				<ul><li>add new category</li>
					<li>edit/delete category</li>
				</ul>
			</li>
		</ul>
	</div>
	
