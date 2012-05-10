<?php 
/** uDuck Setup
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
		<img src="img/uDlogo_alert.png">
		<H1>uDuck Installation</H1>
		<h2>ERROR-PHP not running</h2>
		<p>Your server either doesn't have or isn't currently running PHP. uDuck requires PHP to work.</p>
	</body>
	</html>	
<?php }//makes sure php is running
else{ ?>
	<!DOCTYPE html>
	<html xmlns="http://www.w3.org/1999/xhtml" >
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>uDuck CMS Setup</title>
	</head>
	<body style="background-color:#EEEEFF">
		<img src="img/uDuckLogo.png">
		<H1>uDuck Installation</H1>
		
		<p>Thank you for your interest in the uDuck Content Management System. 
			To install uDuck it is necessary to provide some configuration settings</p>
			
		<form>
			<table style="background-color: #DDDDFF;">
				<colgroup span='2' style="background-color: #ccccFF;"></colgroup>
				<tr><td colspan="2"><h3>Database & Connection Settings</h3></td></tr>
				<tr><td>Database Host:          </td><td><input type='text' value='localhost'></td><td><pre>    Unless your database is on a different server you probably don't need to change this  </pre></td></tr>
				<tr><td>Database Root User:          </td><td><input type='text' value='root'></td><td><pre>    This is the master MySQL account that will let you edit databases                     </pre></td></tr>
				<tr><td>Database Root Password:          </td><td><input type='text' value=''></td><td><pre>    The root user password (this is not stored, only used to install the database)        </pre></td></tr>
				<tr><td>uDuck DB user:            </td><td><input type='text' value='uduser'></td><td><pre>    This is the user account that the uDuck application uses to connect to the DB         </pre></td></tr>
				<tr><td>uDuck DB user Password:       </td><td><input type='text' value='udpass'></td><td><pre>    This password for the uDuck application account. Might want to change for security    </pre></td></tr>
				<tr><td>Database Name:             </td><td><input type='text' value='ud_db'></td><td><pre>    Change this if you want to install more than one instance of uDuck on the server      </pre></td></tr>
				<tr><td colspan="2"><h3>uDuck Administrator Account</h3></td></tr>
				<tr><td>Desired Username:</td><td><input type='text' value='admin'></td><td><pre>    This will be the superuser account that has full privileges for everything in uDuck</pre></td></tr>
				<tr><td>Desired Password: </td><td><input type='password' value=''></td><td><pre>    I won't force a strong password on you but it is recommended</pre></td></tr>
				<tr><td>Verify Password:  </td><td><input type='password' value=''></td><td><pre>    I hope you didn't forget your password already</pre></td></tr>
				<tr><td>Email Address:        </td><td><input type='text' value=''></td><td><pre>    If you do ever forget your password, a link will be sent to your email to replace it</pre></td></tr><!--TODO implement this-->
				<tr><td colspan="2"><h3>uDuck Default Category</h3></td></tr>
				<tr><td>Category Name        </td><td><input type='text' value='Portfolio'></td><td><pre>    Each post is required to hava a category e.g. Blog, Portfolio, etc.</pre></td></tr>
				<tr><td>Category's Group Name</td><td><input type='text' value='Project'></td><td><pre>    Each category can have groups of posts that are related e.g. Category, Project, etc.</pre></td></tr>
			</table>
			<button type='submit' style="width:220px; height:80px;"><h3>Install uDuck</h3></button>
			<button type='reset' style="width:100px; height:70px;"><h3>Reset</h3></button>
		</form>
	</body>
	</html>	
	
<?php }





?>


<?php
/**uDuck Config File
 * this is where the basic configuration goes
 */

//      Setting	Name		Value
 define('DB_HOST'			,'localhost');
 define('DB_ROOT'			,'root');
 define('DB_ROOTPASS'		,'');
 
 define('DB_USER'			,'uduser');
 define('DB_USERPASS'		,'udpass'); 

 define('DB_NAME'			,'ud_db');
 
 define('DEFAULT_USERLVL'	,1);

?>