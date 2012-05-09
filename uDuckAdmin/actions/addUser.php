<?php 
/**
 * uDuck addUser
 * adds a user to the user table
 * 
 * TODO:
 * add checks for duplicate usernames/emails
 */

 require_once "../uD_config.php";//load settings
 require_once "./Act.php";
 $username		= $_POST['user'];
 $pword			= $_POST['pword'];
 $pwordverify	= $_POST['pwordv'];//comes from the verify password field (should be checked before sending it here but just to be safe)
 $email			= $_POST['email'];
 $lvl			= $_POST['lvl'];

if(!isset($_POST['lvl'])){//if not set default to config
	 $permissions=DEFAULT_USERLVL;
}else{$permissions=$_POST['lvl'];}

if($pword != $pwordverify) {echo "passwords not equal"; die();}

//create salt
$salt=act::randString(16);
//hash
$hash=hash("sha256",$pword.$salt,true);
//send
echo $username.'<br>';
echo $salt.'<br>';
echo $hash.'<br>';

$host=DB_HOST;
$dbuser=DB_USER;
$dbpass=DB_USERPASS;
$db=DB_NAME; 

$db = new PDO("mysql:host=$host;dbname=$db", $dbuser, $dbpass);
$statement = $db->prepare('INSERT INTO `user` (Name, Email, Hash, Salt, Permissions)
                                       VALUES (:name, :email, :hash, :salt, :permissions)');
$statement->execute(array(':name' => $username, ':email' => $email, ':hash' => $hash, ':salt' => $salt, ':permissions' => $permissions));

echo "user added<br>";
?>