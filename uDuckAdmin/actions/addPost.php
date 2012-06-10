<?php 
/**
 * uDuck addPost
 * updates a post if it exists, adds it if it doesn't
 */
 require_once "./Act.php";
 session_start();
 if(!act::checkLvl(1)){die();}//check if user level is high enough to post anything
 $sql='';
 //load in $_POST data
 $title	=$_POST['Title'];
 $auth	=$_POST['Author'];//uID
 $body	=$_POST['Body'];
 $capt	=$_POST['Caption'];
 $thumb	=$_POST['Thumb'];
 $gid	=$_POST['GroupID'];
 $cid	=$_POST['CatID'];
 $tags	=$_POST['Tags'];
 $vis   =(isset($_POST['Visible']))?1:0;//if(isset($_POST['Visible'])){$vis=1;}else{$vis=0;}
 
 if($gid==''){$gid=NULL;}
 
 //individual level checks
 if(!act::checkLvl(15)){$auth=$_SESSION['uID'];}//check for setting Authors of different id than logged in
 if(!act::checkLvl(2)){$vis=0;}//only higher level users can publish (visible=false)
  
 //prepare and execute
 $host  =DB_HOST;
 $dbuser=DB_USER;
 $dbpass=DB_USERPASS;
 $db    =DB_NAME; 

 //set sql statement. update if id is there. insert into if it isn't
 if(isset($_POST['id']) && $_POST['id']!=''){
 	$id=$_POST['id'];
	$sql='UPDATE `Post` SET Title= :title, Author= :auth, Body= :body,Caption= :capt,Thumb= :thumb,GroupID= :gid,CatID= :cid,Tags= :tags,Modified=NOW(),Visible=:vis WHERE  ID=:id';
 }else{
 	$id='';
 	$sql='INSERT INTO `Post` (ID,Title, Author, Body,Caption,Thumb,GroupID,CatID,Tags,Created,Modified,Visible) 
 	      VALUES (:id,:title, :auth,:body,:capt,:thumb,:gid,:cid,:tags,NOW(),NOW(),:vis)';
 }

 $db = new PDO("mysql:host=$host;dbname=$db", $dbuser, $dbpass);

 $statement = $db->prepare($sql);                                      
 if(!$statement->execute(array(':id'=>$id,':title'=>$title,':auth'=>$auth,':body'=>$body,':capt'=>$capt,':thumb'=>$thumb,':gid'=>$gid  ,':cid'=>$cid  ,':tags'=>$tags,':vis'=>$vis))){print "error code: ".$statement->errorCode()." ";
					   print_r($statement->errorInfo());}

 echo "post added<br>";
?>