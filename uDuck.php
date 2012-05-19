<?php
require_once "uDuckAdmin/uD_config.php";

/**
 * the uDuck accessor class
 * this will allow people to get data from the MySQL database
 * 
 */
class UDuck {
	private $HOST = DB_HOST;
	private $DB   = DB_NAME;
	private $USER = DB_USER_RO;
	private $PASS = DB_USERPASS_RO;
	
	public $con;
	public  $posts;
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
		/*foreach($result as $row){
			$this->val[]=$row;
		}*/
	}
	public function getPostByID($id){
		$this->posts  = $this->con->query("SELECT * FROM `post` WHERE Visible=1 and ID=$id");
		return $this->posts;
		
	}
	public function getPostByTitle(){
		
	}
	public function getPostByAuthor(){
		
	}
	public function getPost($by){}
	

}

?>