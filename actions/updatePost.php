<?php 
/**
 * uDuck updatePost
 * updates a post if it exists, adds it if it doesn't
 */
 require_once "../uD_config.php";//load settings
 require_once "./act.php";
 session_start();
 if(!act::checkLvl(3)){die();}

 
 
 
 /*
 $_POST['ID'];
 $_POST['Title'];
 //$_POST['Author'];
 $_POST['Body'];
 $_POST['Caption'];
 $_POST['Thumb'];
 $_POST['GroupID'];
 $_POST['CatID'];
 $_POST['Tags'];
 $_POST['Modified'];
 $_POST['Visible'];*/
 
 //check to make sure author ID is valid based on permissions
 
 ?>