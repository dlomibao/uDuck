<?php
session_start();
//for($i=0;$i<12;$i++){
//	$_SESSION['install']['$i']=$_POST['data']['$i'];
//}

foreach($_POST as $key => $val){
	$_SESSION[$key]=$val;
}
print_r($_SESSION);
session_destroy();

?>