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
	
	//requires an initial call to fill, after grab from db it will be held in memory 
	public $u;//holds user table as array(reduces need to query the user table)
	public $c;//holds cat table as array(reduces need to query category table)
	public $g;//holds group table as array (reduces need to query db)
	
	
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
		$this->posts  = $this->con->query("SELECT * FROM `post`")->fetchAll();
		return $this->posts;
	}
	/**gets all posts offset by the start with a limit of the count
	 * starts at 0
	 * not to be confused with id numbers, just the raw rows
	 * @return posts
	 * */
	public function getPostRange($start=0,$count=20){
		$this->posts = $this->con->query("SELECT * FROM `post` LIMIT $count OFFSET $start");
		return $this->posts;
	}
	/**returns an array of the first post that matches the id
	 * (there shouldn't be any other since ID is a primary key)
	 */
	public function getPostByID($id){
		$prep=$this->con->prepare("SELECT * FROM `post` WHERE ID=:id");
		$prep->execute(array(':id'=>$id));
		$this->apost = $prep->fetch();
		$prep->closeCursor();
		return $this->apost;
	}
	/**returns an array of the first post that matches the title
	 * (might be usefull for permalinks)
	 */
	public function getPostByTitle($title){
		$prep=$this->con->prepare("SELECT * FROM `Post` WHERE Title=:title");
		$prep->execute(array(':title'=>$title));
		$this->apost = $prep->fetch();
		$prep->closeCursor();
		return $this->apost;
	}
	public function getAllPostsByAuthor($auth){
		$prep=$this->con->prepare("SELECT * FROM `Post` WHERE Author=:auth");
		$prep->execute(array(':auth'=>$auth));
		$this->posts = $prep->fetchAll();
		
		return $this->posts;
		
	}
	public function getAllPostsByCatID($cat){
		$prep=$this->con->prepare("SELECT * FROM `Post` WHERE CatID=:cat");
		$prep->execute(array(':cat'=>$cat));
		$this->posts = $prep->fetchAll();
		
		return $this->posts;
		
	}
	public function getAllPostsByGroupID($group){
		$prep=$this->con->prepare("SELECT * FROM `Post` WHERE GroupID=:group");
		$prep->execute(array(':group'=>$group));
		$this->posts = $prep->fetchAll();
		
		return $this->apost;
		
	}
	
	//--User Accessors--///////////////////////////////////
	public function getAllUsers(){
		$this->u=$this->con->query("SELECT * FROM `User`")->fetchAll();
		return $this->u;
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
		$this->c=$this->con->query("SELECT * FROM `Categories`")->fetchAll();
		return $this->c;
	}
	public function getCategoryByID($id){
		$prep=$this->con->prepare("SELECT * FROM `Categories` WHERE ID=:id");
		$prep->execute(array(':id'=>$id));
		return $prep->fetch();
	}
		public function getCategoriesRange($start=0,$count=20){
		$this->c = $this->con->query("SELECT * FROM `Categories` LIMIT $count OFFSET $start");
		return $this->c;
	}
	
	//--Group Accessors--//////////////////////////////////////////////////////
	public function getAllGroups(){
		$this->g=$this->con->query("SELECT * FROM `Group`")->fetchAll();
		return $this->g;
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
	public function getGroupRange($start=0,$count=20){
		$this->g = $this->con->query("SELECT * FROM `Group` LIMIT $count OFFSET $start");
		return $this->g;
	}
	//--uDuck drop menu-//////////////////////
	public function dropMenuUser($name="UserID",$default=0,$print=TRUE){
		$html="<select name=$name style='min-width:11.7em;'>";
		$users=$this->getAllUsers();
		foreach($users as $u){
			$id=$u['ID'];
			$name=$u['Name'];
			$html .= "<option value='$id'";
			if($default==$id){$html .= " selected='selected' ";}
			$html .=">$name</option>";
		}
		$html .= "</select>";
		if($print){echo $html;}
		return $html;
	}
	public function dropMenuCat($name="CatID",$default=0,$print=TRUE){
		$html="<select name=$name style='min-width:11.7em;'>";
		$cats=$this->getAllCategories();
		foreach($cats as $c){
			$id=$c['ID'];
			$name=$c['Cat'];
			$html .= "<option value='$id'";
			if($default==$id){$html .= " selected='selected' ";}
			$html .=">$name</option>";
		}
		$html .= "</select>";
		if($print){echo $html;}
		return $html;
	}
	public function dropMenuGroup($name="GroupID",$default=0,$print=TRUE){
		$html="<select name=$name style='min-width:11.7em;'><option value=''></option>";
		$groups=$this->getAllGroups();
		foreach($groups as $g){
			$id=$g['ID'];
			$name=$g['Name'];
			$html .= "<option value='$id'";
			if($default==$id){$html .= " selected='selected' ";}
			$html .=">$name</option>";
		}
		$html .= "</select>";
		if($print){echo $html;}
		return $html;
	}
	//--other tools--//////////////////////////////////////
	public function returnRow($id, $array){
		foreach($array as $row){
			if($row['ID']==$id){
				return $row;
			}	
		}
		return FALSE;
	}
	public function returnRowItem($id,$array,$item){
		$row=$this->returnRow($id,$array);
		return $row[$item];
	}
	
}

?>