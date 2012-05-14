<?php

/** uDuck logout 
 * clears session data to log user out
 * 
 */
session_start();
if(session_destroy()){
	echo "logged out<br>";
}else{
	echo "error logging out";
}
?>