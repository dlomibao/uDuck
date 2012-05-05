<?php 
/**
 * uDuck addUser
 * adds a user to the user table
 */

 require_once "../uD_config.php";//load settings
 
 $username		= $_POST['user'];
 $pword			= $_POST['pword'];
 $pwordverify	= $_POST['pwordv'];//comes from the verify password field (should be checked before sending it here but just to be safe)

if(!isset($_POST['permissions'])){//if not set default to config
	 $permissions=DEFAULT_USERLVL;
}else{$permissions=$_POST['lvl'];}

if($pword != $pwordverify) {die();}

 

?>