<?php

/** uDuck logout 
 * clears session data to log user out
 * 
 */
session_start();
session_destroy();
echo "logged out<br>";
?>