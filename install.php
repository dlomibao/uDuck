<?php 
/** uDuck installation
 * 
 * requires php5.3
 */
if(false){?>
	<!DOCTYPE html>
	<html xmlns="http://www.w3.org/1999/xhtml" >
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>PHP not running</title>
	</head>
	<body>
		<H1>uDuck Installation</H1>
		<h2>ERROR-PHP not running</h2>
		<p>Your server either doesn't have or isn't currently running PHP. uDuck requires PHP to work.</p>
	</body>
	</html>	
<?php }

require_once 'uD_config.php';

	$host=DB_HOST;
	$root=DB_ROOT; 
	$root_password=DB_ROOTPASS; 

	$user=DB_USER;
	$pass=DB_USERPASS;
	$db=DB_NAME; 

    try {
        $dbh = new PDO("mysql:host=$host", $root, $root_password);
		
		echo "creating database $db";
        $dbh->exec("CREATE DATABASE IF NOT EXIST `$db`;") 
        or  trigger_error('Creating Database Failed: ' . mysql_error($db), E_USER_ERROR); 
        
		echo "creating user $user";
		$dbh->exec("
                CREATE USER '$user'@'$host' IDENTIFIED BY '$pass';
                GRANT ALL ON `$db`.* TO '$user'@'$host';
                FLUSH PRIVILEGES;") 
        or  trigger_error('Creating User Failed: ' . mysql_error($db), E_USER_ERROR); 
      
		
		
		
	




    } catch (PDOException $e) {
        die("DB ERROR: ". $e->getMessage());
    }
 
	
	




 

 
  
?>