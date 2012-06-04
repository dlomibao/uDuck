<?php
require_once "uD_config.php";

/**
 * the uDuck admin class
 * this will allow people to get data from the MySQL database
 * 
 */
class uDuck_Admin {
	private $HOST = DB_HOST;
	private $DB   = DB_NAME;
	private $USER = DB_USER_RO;
	private $PASS = DB_USERPASS_RO;
	
	public $con;//the connection object (TODO: make private for production code )
	public $posts;//holds the last accessed group of posts as an array of arrays
	public $apost;//holds the last accessed post as an array
	
	
	/**
	 * @param $USER		STRING	The user to connect to the database
	 * @param $PASS		STRING	user password
	 * @param $CONNECT	BOOL	true if you want to create a PDO connection
	 */
	public function __construct($USER=DB_USER_RO,$PASS=DB_USERPASS_RO,$CONNECT=True) {
		$this->USER = (string)$USER;
		$this->PASS = (string)$PASS;
		
		if($CONNECT){
			$this->connect();
		}
		
	}//end constructor
	/**connects via PDO to database
	 * 
	 */
	public function connect(){
		try{
			
		$db=$this->DB;
		$host=$this->HOST;
		$user=$this->USER;
		$pass=$this->PASS;
		 $this->con = new PDO("mysql:dbname=$db;host=$host",$user,$pass);
		 
		 return 1;
		 
		}catch(PDOException $e){
			die("Database Connection Failed: " . $e->getMessage());
			return 0;
			
		}
	}//end connect
	public function close()//closes connection
	{
		$this->con=null;
	}
	public function getAllPosts(){
		$this->posts  = $this->con->query("SELECT * FROM `post` WHERE Visible=1")->fetchAll();
		return $this->posts;
	}
	/**returns an array of the first post that matches the id
	 * (there shouldn't be any other since ID is a primary key)
	 */
	public function getPostByID($id){
		$prep=$this->con->prepare("SELECT * FROM `post` WHERE Visible=1 and ID=:id");
		$prep->execute(array(':id'=>$id));
		$this->apost = $prep->fetch();
		$prep->closeCursor();
		return $this->apost;
	}
	/**returns an array of the first post that matches the title
	 * (might be usefull for permalinks)
	 */
	public function getPostByTitle($title){
		$prep=$this->con->prepare("SELECT * FROM `post` WHERE Visible=1 and Title=:title");
		$prep->execute(array(':title'=>$title));
		$this->apost = $prep->fetch();
		$prep->closeCursor();
		return $this->apost;
	}
	public function getAllPostsByAuthor($auth){
		$prep=$this->con->prepare("SELECT * FROM `post` WHERE Visible=1 and Author=:auth");
		$prep->execute(array(':auth'=>$auth));
		$this->posts = $prep->fetchAll();
		
		return $this->posts;
		
	}
	public function getAllPostsByCatID($cat){
		$prep=$this->con->prepare("SELECT * FROM `post` WHERE Visible=1 and CatID=:cat");
		$prep->execute(array(':cat'=>$cat));
		$this->posts = $prep->fetchAll();
		
		return $this->posts;
		
	}
	public function getAllPostsByGroupID($group){
		$prep=$this->con->prepare("SELECT * FROM `Post` WHERE Visible=1 and GroupID=:group");
		$prep->execute(array(':group'=>$group));
		$this->posts = $prep->fetchAll();
		
		return $this->apost;
		
	}
	
	//--User Accessors--///////////////////////////////////
	public function getAllUsers(){
		return $this->con->query("SELECT * FROM `User`")->fetchAll();
	}
	public function getUserByID($id){
		$prep=$this->con->prepare("SELECT * FROM `User` WHERE ID=:id");
		$prep->execute(array(':id'=>$id));
		return $prep->fetch();
		
	}
	public function getUserByName($name){
		$prep=$this->con->prepare("SELECT * FROM `User` WHERE Name=:name");
		$prep->execute(array(':name'=>$name));
		return $prep->fetch();
		
	}
	
	//--Category Accessors--///////////////////////////////////////////////////
	public function getAllCategories(){
		return $this->con->query("SELECT * FROM `Categories`")->fetchAll();
	}
	public function getCategoryByID($id){
		$prep=$this->con->prepare("SELECT * FROM `Categories` WHERE ID=:id");
		$prep->execute(array(':id'=>$id));
		return $prep->fetch();
	}
	
	//--Group Accessors--//////////////////////////////////////////////////////
	public function getAllGroups(){
		return $this->con->query("SELECT * FROM `Group`")->fetchAll();
	}
	public function getGroupsByCatID($id){
		$prep=$this->con->prepare("SELECT * FROM `Group` WHERE CatID=:id");
		$prep->execute(array(':id'=>$id));
		return $prep->fetchAll();
	}

	public function getGroupByID($id){
		$prep=$this->con->prepare("SELECT * FROM `Group` WHERE ID=:id");
		$prep->execute(array(':id'=>$id));
		return $prep->fetch();
	}
	//--uDuck drop menu-//////////////////////
	public function dropMenuUser($name="UserID",$print=TRUE){
		$html="<select name=$name style='min-width:11.7em;'>";
		$users=$this->getAllUsers();
		foreach($users as $u){
			$id=$u['ID'];
			$name=$u['Name'];
			$html .= "<option value='$id'>$name</option>";
		}
		$html .= "</select>";
		if($print){echo $html;}
		return $html;
	}
	public function dropMenuCat($name="CatID",$print=TRUE){
		$html="<select name=$name style='min-width:11.7em;'>";
		$cats=$this->getAllCategories();
		foreach($cats as $c){
			$id=$c['ID'];
			$name=$c['Cat'];
			$html .= "<option value='$id'>$name</option>";
		}
		$html .= "</select>";
		if($print){echo $html;}
		return $html;
	}
	public function dropMenuGroup($name="GroupID",$print=TRUE){
		$html="<select name=$name style='min-width:11.7em;'><option value=''></option>";
		$groups=$this->getAllGroups();
		foreach($groups as $g){
			$id=$g['ID'];
			$name=$g['Name'];
			$html .= "<option value='$id'>$name</option>";
		}
		$html .= "</select>";
		if($print){echo $html;}
		return $html;
	}
	
	
}

?>