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
<?php }//makes sure php is running

require_once 'uD_config.php';//loads config

	$host=DB_HOST;
	$root=DB_ROOT; 
	$root_password=DB_ROOTPASS; 

	$user=DB_USER;
	$pass=DB_USERPASS;
	$db=DB_NAME; 

    try {
        $dbh = new PDO("mysql:host=$host", $root, $root_password);
		 
		 //query if database exists
		 $e=$dbh->query("SELECT 1 FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$db';")->fetchAll();
		 	$db_exists=$e[0];

		
		
		if( !$db_exists)
		{
			echo "Creating Database $db";
			$dbh->exec("CREATE DATABASE $db ;
	        		    FLUSH PRIVILEGES;")
						or  trigger_error('Creating Database Failed: ' . mysql_error(), E_USER_ERROR);
		}else{echo "database exists already<br>";}
		
		//query if default user exists
		 $e=$dbh->query("SELECT 1 FROM mysql.user WHERE USER = '$user';")->fetchAll();
		 	$user_exists=$e[0][1];
		
		if(!$user_exists)
		{
			echo "Creating User";
			$dbh->exec("CREATE USER `$user`@`$host`;
	               		GRANT ALL ON `$db`.* TO `$user`@`$host`;
	               		SET PASSWORD FOR `$user`@`$host` = PASSWORD(`$pass`);
	        		    FLUSH PRIVILEGES;");
						
			
		}else{echo "user already exists<br>";}
		 
		//add tables
		echo "adding tables<br>";
		$dbh->exec("SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
					SET time_zone = '+00:00';
					
						--
						-- Table structure for table `Categories`
						--
						
						CREATE TABLE IF NOT EXISTS `Categories` (
						  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
						  `Cat` varchar(255) NOT NULL,
						  `GroupName` varchar(126) NOT NULL COMMENT 'this is what groups are called in this category',
						  PRIMARY KEY (`ID`)
						) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;
						
							--
							-- Dumping data for table `Categories`
							--
							INSERT INTO `Categories` (`ID`, `Cat`, `GroupName`) VALUES
							(1, 'Blog', 'Category');
						
						--
						-- Table structure for table `Group`
						--
						
						CREATE TABLE IF NOT EXISTS `Group` (
						  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
						  `Name` varchar(255) NOT NULL,
						  `Caption` varchar(1024) NOT NULL,
						  `Thumb` varchar(4000) NOT NULL,
						  `CatID` smallint(5) unsigned NOT NULL,
						  PRIMARY KEY (`ID`),
						  KEY `CatID` (`CatID`)
						) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
						
						--
						-- Table structure for table `Post`
						--
						
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
						
						--
						-- Table structure for table `User`
						--
						
						CREATE TABLE IF NOT EXISTS `User` (
						  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
						  `Name` varchar(128) NOT NULL,
						  `Email` varchar(255) NOT NULL,
						  `Hash` binary(32) NOT NULL,
						  `Salt` char(16) NOT NULL,
						  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
						  `Permissions` varchar(64) NOT NULL,
						  PRIMARY KEY (`ID`),
						  UNIQUE KEY `Name` (`Name`),
						  UNIQUE KEY `Email` (`Email`)
						) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
						
						
						--
						-- Constraints for table `Group`
						--
						ALTER TABLE `Group`
						  ADD CONSTRAINT `Group_ibfk_1` FOREIGN KEY (`CatID`) REFERENCES `Categories` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
						
						--
						-- Constraints for table `Post`
						--
						ALTER TABLE `Post`
						  ADD CONSTRAINT `Post_ibfk_1` FOREIGN KEY (`Author`) REFERENCES `User` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
						  ADD CONSTRAINT `Post_ibfk_3` FOREIGN KEY (`GroupID`) REFERENCES `Group` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
						  ADD CONSTRAINT `Post_ibfk_4` FOREIGN KEY (`CatID`) REFERENCES `Categories` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
					
					"
				  )
				  or trigger_error('Adding Tables Failed: ' . mysql_error(), E_USER_ERROR);
		
		
		
		
		
		
		
    } catch (PDOException $e) {
        die("DB ERROR: ". $e->getMessage());
    }
 
	
	




 

 
  
?>