<?php
 /**included at the beginning of each action to make sure it is valid
  * set $MIN_LVL before call
  */
 session_start();
 if(isset($_SESSION['uLvl'])){
 	if($_SESSION['uLvl']<$MIN_LVL){
 		echo "account does not have permission for this action<br>";	
 		die();
 	}
 }else{
 	echo "not logged into an account<br>";
 	die();}
echo "valid";
?>