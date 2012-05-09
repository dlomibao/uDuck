<?php 
/**
 * uDuck addGroup
 * adds a group to the group table
 */
 session_start();
 require_once "./Act.php";
 if(!act::checkLvl(10)){die();}//figure out what it should really be
 $name    = $_POST['name'];
 $caption = $_POST['caption'];
 $thumb	  = $_POST['thumb'];
 $cid	  = $_POST['cid'];
 
$host=DB_HOST;
$dbuser=DB_USER;
$dbpass=DB_USERPASS;
$db=DB_NAME; 

$db = new PDO("mysql:host=$host;dbname=$db", $dbuser, $dbpass);
$statement = $db->prepare('INSERT INTO `group` (Name, Caption, Thumb, CatID)
                                        VALUES (:name,:caption,:thumb,:cid)');
$statement->execute(array(':name' => $name, ':caption' => $caption,':thumb' => $thumb, ':cid' => $cid));

 
 echo "group added<br>";
 ?>