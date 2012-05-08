<?php 
/**
 * uDuck addPost
 * updates a post if it exists, adds it if it doesn't
 */
 //require_once "../uD_config.php";//load settings		safe to remove since act is required;
 require_once "./act.php";
 session_start();
 if(!act::checkLvl(1)){die();}//check if user level is high enough to post anything

 //$id		=$_POST['ID']; //don't need in add post because AutoIncrement
 $title	=$_POST['Title'];
 $auth	=$_POST['Author'];//uID
 $body	=$_POST['Body'];
 $capt	=$_POST['Caption'];
 $thumb	=$_POST['Thumb'];
 $gid	=$_POST['GroupID'];
 $cid	=$_POST['CatID'];
 $tags	=$_POST['Tags'];
 $vis	=$_POST['Visible'];
  //$_POST['Modified'];
  
  //individual level checks
  if(!act::checkLvl(15)){//check for setting Authors of different id than logged in
  	$auth=$_SESSION['uID'];
  }
  if(!act::checkLvl(2)){//only higher level users can publish
  	$vis=0;//visible = false
  }
 
 
 //prepare and execute
 $host=DB_HOST;
 $dbuser=DB_USER;
 $dbpass=DB_USERPASS;
 $db=DB_NAME; 

 $db = new PDO("mysql:host=$host;dbname=$db", $dbuser, $dbpass);
 $statement = $db->prepare('INSERT INTO `post` (Title, Author, Body,Caption,Thumb,GroupID,CatID,Tags,Created,Modified,Visible)
                                       VALUES (:title, :auth,:body,:capt,:thumb,:gid,:cid,:tags,NOW(),NOW(),:vis)');
 $statement->execute(
 				array(':title'=>$title,':auth'=>$auth,':body'=>$body,':capt'=>$capt,
 				      ':thumb'=>$thumb,':gid'=>$gid  ,':cid'=>$cid  ,':tags'=>$tags,':vis'=>$vis)
					);


 ?>