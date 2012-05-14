<?php 
/**
 * uDuck login
 * authenticates user and creates a php session. might add cookies later
 */
 require_once '../uD_config.php';//load settings
 
 $username		= $_POST['user'];
 $pword			= $_POST['pword'];
 
 $host=DB_HOST;
 $host=DB_HOST;
 $dbuser=DB_USER;
 $dbpass=DB_USERPASS;
 $db=DB_NAME; 
 
 $db = new PDO("mysql:host=$host;dbname=$db", $dbuser, $dbpass);
 $statement = $db->prepare('SELECT * FROM `user` WHERE `Name`=:user');
 $statement->execute(array(':user' => $username));
 if($userdata=$statement->fetch()){
	$hash=$userdata['Hash'];
	$salt=$userdata['Salt'];
	
	$testhash=hash("sha256",$pword.$salt,true);
	if($testhash==$hash){
		session_start();
			$_SESSION['uID']=$userdata['ID'];
			$_SESSION['uLvl']=$userdata['Permissions'];
			$_SESSION['uName']=$userdata['Name'];
			$_SESSION['uCreated']=$userdata['Created'];
			$_SESSION['uEmail']=$userdata['Email'];
			echo "login correct<br>";
			echo "<a href='redirect.php'>go back to original page</a>";
			
	}else{echo "incorrect login<br>";}
	
 }else{
 	echo "User not found<br>";
 }
                                       
 
 
 
 
 ?>