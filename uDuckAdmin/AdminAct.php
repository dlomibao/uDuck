<?php
/**adminAct
 * AdminAct class provides a variety of methods to be used within the dash board/control panel
 */
 chdir(dirname(__FILE__));//when included or required in other directories
 require_once "./uD_config.php";
 class AdminAct{
 	public static function listActions(){
 		//stub
 		//create an html list of links of dashboard actions that are available to user
 		$html='';
		$html .='<ul>';
		
		$html .='<li><a href=$link >$linkname</a><</li>';
		 
		$html .='</ul>';
		echo $html;
 	}
	public static function dropMenuUser(){
		$html="";
	}
	public static function dropMenuCat(){
		$html="";
	}
	public static function dropMenuGroup($cat=-1){
		$html="";
	}
	
	
 }
 
?>