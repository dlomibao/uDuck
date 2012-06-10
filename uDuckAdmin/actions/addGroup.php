<?php 
/**
 * uDuck addGroup
 * adds a group to the group table
 */
 session_start();
 require_once "./Act.php";
 if(!act::checkLvl(10)){die();}//figure out what it should really be
 //load $_POST data
 $name    = $_POST['name'];
 $caption = $_POST['caption'];
 $thumb	  = $_POST['thumb'];
 $cid	  = $_POST['cid'];
 
$host=DB_HOST;
$dbuser=DB_USER;
$dbpass=DB_USERPASS;
$db=DB_NAME; 

 //set sql statement. update if id is there. insert into if it isn't
 if(isset($_POST['id']) && $_POST['id']!=''){
 	$id=$_POST['id'];
	$sql='UPDATE `Group` SET Name= :name, Caption= :capt, Thumb= :thumb,CatID= :cid WHERE  ID=:id';
 }else{
 	$id='';
 	$sql='INSERT INTO `Group` (ID,Name, Caption, Thumb, CatID) 
 	      VALUES (:id,:name,:capt,:thumb,:cid)';
 }

$db = new PDO("mysql:host=$host;dbname=$db", $dbuser, $dbpass);
//$statement = $db->prepare('INSERT INTO `Group` (Name, Caption, Thumb, CatID)
//                                        VALUES (:name,:caption,:thumb,:cid)');
$statement=$db->prepare($sql);
$statement->execute(array(':id'=>$id,':name' => $name, ':capt' => $caption,':thumb' => $thumb, ':cid' => $cid));

 
 echo "group added<br>";
 ?>