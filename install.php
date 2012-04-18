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
		 
		 $e=$dbh->query("SELECT 1 FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$db';")->fetchAll();
		 	$db_exists=$e[0];

		
		
		if( !$db_exists)
		{
			echo "Creating Database $db";
			$dbh->exec("CREATE DATABASE $db ;
	        		    FLUSH PRIVILEGES;")
						or  trigger_error('Creating Database Failed: ' . mysql_error(), E_USER_ERROR);
		}else{echo "database exists already";}
		
		 $e=$dbh->query("SELECT 1 FROM mysql.user WHERE USER = '$user';")->fetchAll();
		 	$user_exists=$e[0][1];
		
		if(!$user_exists)
		{
			echo "Creating User";
			$dbh->exec("CREATE USER `$user`@`$host`;
	               		GRANT ALL ON `$db`.* TO `$user`@`$host`;
	               		SET PASSWORD FOR `$user`@`$host` = PASSWORD(`$pass`);
	        		    FLUSH PRIVILEGES;");
						
			
		}else{echo "user already exists";}
		 
		
		
		
		
    } catch (PDOException $e) {
        die("DB ERROR: ". $e->getMessage());
    }
 
	
	




 

 
  
?>