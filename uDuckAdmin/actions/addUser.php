<?php 
/**
 * uDuck addUser
 * adds a user to the user table
 * 
 * TODO:
 * add checks for duplicate usernames/emails
 */
 session_start();
 require_once "../uD_config.php";//load settings
 require_once "../uD_admin.php";
 require_once "./Act.php";
 $currpword     = (isset($_POST['pwordcurr']))?$_POST['pwordcurr']:NULL;
 $username		= $_POST['user'];
 $pword			= $_POST['pword'];
 $pwordverify	= $_POST['pwordv'];//comes from the verify password field (should be checked before sending it here but just to be safe)
 $email			= $_POST['email'];
 $lvl			= $_POST['lvl'];
 if(isset($_POST['id']) && $_POST['id']!=''){
 	$id=$_POST['id'];
	$sql='UPDATE `User` SET Name= :name, Email= :email, Permissions= :lvl WHERE  ID=:id';//use if password unchanged
	if(isset($currpword)){
		$admin= new uDuck_Admin();
		$u=$admin->getUserByID($id);
		$checksalt=$u['Salt'];
		$checkhash=$u['Hash'];
		$testhash=hash("sha256",$currpword.$checksalt,true);//pword+salt hashed vs hash
		//query db for hash and salt and check against currpword
		if($testhash==$checkhash){
			//verify pword and pwordverify ==
			if($pword!=$pwordverify){echo "passwords don't match"; die();}//check for password match
			
			$sql='UPDATE `User` SET Name= :name, Email= :email,Hash= :hash,Salt=:salt, Permissions= :lvl WHERE  ID=:id';//use if password is changed
			$execArray=array(':name'=>$username,':email'=>$email,':hash',);
		}
	}
 }else{
 	$id='';
 	$sql='INSERT INTO `User` (ID,Name, Email, Hash,Salt,Created, Permissions) 
 	      VALUES (:id,:name,:email,:hash,:salt,NOW(),:lvl)';
 }
 
if(!isset($_POST['lvl'])){//if not set default to config (refactor this)
	 $permissions=DEFAULT_USERLVL;
}else{$permissions=$_POST['lvl'];}

if($pword != $pwordverify) {echo "passwords not equal"; die();}

//create salt
$salt=act::randString(16);
//hash
$hash=hash("sha256",$pword.$salt,true);
//send
echo $username.'<br>';
echo $salt.'<br>';
echo $hash.'<br>';

$host=DB_HOST;
$dbuser=DB_USER;
$dbpass=DB_USERPASS;
$db=DB_NAME; 

$db = new PDO("mysql:host=$host;dbname=$db", $dbuser, $dbpass);
$statement = $db->prepare('INSERT INTO `User` (Name, Email, Hash, Salt, Permissions)
                                       VALUES (:name, :email, :hash, :salt, :permissions)');
$statement->execute(array(':name' => $username, ':email' => $email, ':hash' => $hash, ':salt' => $salt, ':permissions' => $permissions));

echo "user added<br>";
?>