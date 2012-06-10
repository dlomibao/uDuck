<?php
/**Delete the categories that were selected 
 * 
 */
require_once "./Act.php";
session_start();
if(!act::checkLvl(10)){die();}//check if user level is high enough to delete anything

 $host=DB_HOST;
 $dbuser=DB_USER;
 $dbpass=DB_USERPASS;
 $db=DB_NAME; 
$db = new PDO("mysql:host=$host;dbname=$db", $dbuser, $dbpass);//create connection
$sel=array();
if(isset($_POST['selected'])){$sel=$_POST['selected'];}
$sql="DELETE FROM `Categories` WHERE ID=:sel";
$statement = $db->prepare($sql); 
if(count($sel)<1){echo "nothing selected";die();}else{
	while (list ($key,$val) = @each ($sel)) { 
		$statement->execute(array(':sel'=>$val));
	}
echo $sql;
} 
?>