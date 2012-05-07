<?php

/** uDuck logout 
 * clears session data to log you out
 * 
 */
session_start();
session_destroy();
?>