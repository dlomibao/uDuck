<?php 
/**
 * uDuck addCat
 * adds a category to the category table
 */
 session_start();
 //require_once "../uD_config.php";//load settings
 require_once "./act.php";
 if(!act::checkLvl(10)){die();}//figure out what it should really be
 $cat   = $_POST['cat'];
 $gname = $_POST['gname'];
 
$host=DB_HOST;
$dbuser=DB_USER;
$dbpass=DB_USERPASS;
$db=DB_NAME; 

$db = new PDO("mysql:host=$host;dbname=$db", $dbuser, $dbpass);
$statement = $db->prepare('INSERT INTO `categories` (Cat, GroupName)
                                       VALUES (:cat, :gname)');
$statement->execute(array(':cat' => $cat, ':gname' => $gname));
echo "category added<br>";

 

?>