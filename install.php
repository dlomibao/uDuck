<?php 
/** uDuck installation
 * 
 * requires php5.3
 * requires MySQL 5.1
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
<?php }//makes sure php is running

require_once 'uD_config.php';//loads configuration

	$host=DB_HOST;
	$root=DB_ROOT; 
	$root_password=DB_ROOTPASS; 

	$user=DB_USER;
	$pass=DB_USERPASS;
	$db=DB_NAME; 

    try {
	        $dbh = new PDO("mysql:host=$host", $root, $root_password);
			
			 echo "host: $host <br>";
			 //query if database exists
			 $check=$dbh->query("SELECT 1 FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$db';")->fetchAll();
			 $db_exists=$check[0];
	
			if( !$db_exists)
			{
				$dbh=NULL;
				$dbh=new PDO("mysql:host=$host", $root, $root_password);
				
				echo "Creating Database $db <br>";
				
				$dbh->exec("CREATE DATABASE $db ;
		        		    FLUSH PRIVILEGES;");
							
				
			}else{echo "database exists already<br>";}
			
			echo "Creating User <br>";
			$dbh=NULL;
			$dbh=new PDO("mysql:host=$host", $root, $root_password);
			$dbh->exec("CREATE USER `$user`@`$host` IDENTIFIED BY '$pass';
							GRANT ALL ON $db.* TO `$user`@`$host` WITH GRANT OPTION;
							FLUSH PRIVILEGES;") ;
			$dbh=null;//close connection
		}
	 catch (PDOException $e){
        die(" Problem Creating Database and User: ". $e->getMessage());
     }
     
     try{
		$dbh = new PDO("mysql:host=$host;dbname=$db", $user, $pass);//use created db and user from now on 
		//add tables
		echo "adding tables<br>";
		
		$dbh->exec("	SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
						SET time_zone = '+00:00';
		
						CREATE TABLE IF NOT EXISTS `Categories` (
						  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
						  `Cat` varchar(255) NOT NULL,
						  `GroupName` varchar(126) NOT NULL COMMENT 'this is what groups are called in this category',
						  PRIMARY KEY (`ID`)
						) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

						
						CREATE TABLE IF NOT EXISTS `Group` (
						  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
						  `Name` varchar(255) NOT NULL,
						  `Caption` varchar(1024) NOT NULL,
						  `Thumb` varchar(4000) NOT NULL,
						  `CatID` smallint(5) unsigned NOT NULL,
						  PRIMARY KEY (`ID`),
						  KEY `CatID` (`CatID`)
						  
						) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
						

						
						CREATE TABLE IF NOT EXISTS `Post` (
						  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
						  `Title` varchar(512) NOT NULL,
						  `Author` smallint(5) unsigned DEFAULT NULL,
						  `Body` text NOT NULL,
						  `Caption` varchar(1024) NOT NULL,
						  `Thumb` varchar(4000) NOT NULL,
						  `GroupID` smallint(5) unsigned DEFAULT NULL,
						  `CatID` smallint(5) unsigned NOT NULL,
						  `Tags` varchar(512) NOT NULL,
						  `Created` timestamp NULL DEFAULT NULL,
						  `Modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
						  `Visible` tinyint(1) NOT NULL DEFAULT '1',
						  PRIMARY KEY (`ID`),
						  KEY `Author` (`Author`),
						  KEY `GroupID` (`GroupID`),
						  KEY `CatID` (`CatID`)
						) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
						

						
						CREATE TABLE IF NOT EXISTS `User` (
						  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
						  `Name` varchar(128) NOT NULL,
						  `Email` varchar(255) NOT NULL,
						  `Hash` binary(32) NOT NULL,
						  `Salt` char(16) NOT NULL,
						  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
						  `Permissions` tinyint(1) NOT NULL DEFAULT '1',
						  PRIMARY KEY (`ID`),
						  UNIQUE KEY `Name` (`Name`),
						  UNIQUE KEY `Email` (`Email`)
						) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
						

						");
			$dbh=null;
			$dbh = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
			$dbh->exec("ALTER TABLE  `post` ADD FOREIGN KEY (  `Author` ) REFERENCES  `ud_db`.`user` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE ;
						ALTER TABLE  `post` ADD FOREIGN KEY (  `GroupID` ) REFERENCES  `ud_db`.`group` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE ;
						ALTER TABLE  `post` ADD FOREIGN KEY (  `CatID` ) REFERENCES  `ud_db`.`categories` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE ;
						
						ALTER TABLE  `group` ADD FOREIGN KEY (  `CatID` ) REFERENCES  `ud_db`.`categories` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE ;
						");
			$dbh=null;
		
    } catch (PDOException $e) {
        die("Error Adding Tables: ". $e->getMessage());
    }
 
	
	




 

 
  
?>