<?php
/**redirects the browser to the page it came from
 * (used to return back to intended page after login)
 */
session_start();
$redirect=$_SESSION['origin'];
header("Location: $redirect");
exit;	
?>