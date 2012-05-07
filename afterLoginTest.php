<?php 
/**
 * uDuck afterloginTest
 * checks to make sure session is working
 * will probably delete later
 */

 session_start();
 			$a=$_SESSION['uID'];
			$b=$_SESSION['uLvl'];
			$c=$_SESSION['uName'];
			$d=$_SESSION['uCreated'];
			$e=$_SESSION['uEmail'];
			$br=" || ";
 echo $a.$br.$b.$br.$c.$br.$d.$br.$e;
 session_destroy();
 ?>
