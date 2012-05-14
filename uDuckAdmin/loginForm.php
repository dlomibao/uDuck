<?php
	
	if($_SERVER["HTTPS"] != "on") {//make sure to page uses https
	   header("HTTP/1.1 301 Moved Permanently");
	   header("Location: https://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
	   exit();
	}
	session_start();
	echo $_SESSION['origin'];
	
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
	<title>uDuck Login</title>
</head>
<body style="background-color:#EEEEFF; ">
	<div id=logincontainer style=" height:500px; margin-left: auto; margin-right: auto; width: 300px;">
	<center>
		<form action='actions/login.php' method='post' style="background-color: #DDDDFF;margin: 10px;">
			<img src="img/uDuckLogo.png"></img><br>
		Username: <input type="text" name="user" /><br>
		Password: <input type="password" name="pword" /><br>
		<button type='submit'>Send</button>
		<button type='reset'>Reset</button>
		</form>
		<br>
		uDuck CMS uses https to send data which is encrypted.
		Use a ssl certificate to make sure it is a secure connection.
		If you don't have one, get a free one. 
		<a href="http://lmgtfy.com/?q=free+ssl+certificates">look it up.</a>
	</center>
	</div>
			
</body>
</html>	
