<?php
/** 
 *  the Act class has a variety of methods to be used by the actions group
 */
 chdir(dirname(__FILE__));//when included or required in other directories
 require_once "../uD_config.php";
 class Act{
 	/** checks to make sure user is of valid permission level
	 *  requires sesssion_start()
	 * @param minimum level 		integer up to 255
	 * @return valid 				true/false
	 */
 	public static function checkLvl($min=1){
 		if(isset($_SESSION['uLvl'])){
	 		if($_SESSION['uLvl']<$min){
	 			echo "account does not have permission for this action<br>";	
	 			return FALSE;
	 		}
	 	}else{
	 		echo "not logged into an account<br>";
	 		return FALSE;
		}//end else
		return TRUE;
	 }//end checkLvl
	 
	/** creates a random string of given length
	 *  used for creating salts
	 *  TODO: make cryptographically secure compared to mt_rand()
	 * @param len		integer of required string length
	 * @return string	string of required length randomized
	 */
	public static function randString($len= 16) {
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#%^&*_+|~-=';
    $string = '';

    for ($i = 0; $i < $len; $i++) {
        $string .= $chars[mt_rand(0, strlen($chars) - 1)];
    }

    return $string;
	}
	/**shows the user data from the session
	 * (Depreciated)
	 */
	public static function showSessionData(){
		 	$a=$_SESSION['uID'];
			$b=$_SESSION['uLvl'];
			$c=$_SESSION['uName'];
			$d=$_SESSION['uCreated'];
			$e=$_SESSION['uEmail'];
			$br=" || ";
 		echo $a.$br.$b.$br.$c.$br.$d.$br.$e.'<br';
	}
	
	/**
	 * 
	 */
	public static function listFromTable($tableName='Post',$showArray=array('ID','Title','Author'),$start=0,$end=30){
		$html='';
		$host=DB_HOST;
		$dbuser=DB_USER;
		$dbpass=DB_USERPASS;
		$db=DB_NAME; 
		
		$db = new PDO("mysql:host=$host;dbname=$db", $dbuser, $dbpass);
		$statement = $db->prepare("SELECT * FROM $tableName LIMIT $start , $end");
								   //
		$statement->execute();
		$data=$statement->fetchAll(); 
	
		
		
		$html .= '<table><tr>';
		foreach($showArray as $e){
			$html .= '<td>'. $e .'</td>';
		}
		$html .= '</tr>';
		
		foreach($data as $row){
			$html .= '<tr>';
			foreach($showArray as $f){
				$html .= '<td>'. $row[$f] .'</td>';
			}
			$html .= '</tr>';
		}
		$html .= '</table>';
		return $html;
	}

 } 
 ?>
