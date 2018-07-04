<?php
if(!isset($_SESSION)){session_start();}
if(!isset($_SESSION["alerte"])){$_SESSION["alerte"] = "";}


switch (@$_SESSION["action"]) {
  default :
  break;

   case "logout":
      if(file_exists("func/func.user.logout.php")){include_once("func/func.user.logout.php");}
   break;
        
   case "inscription":
     if(file_exists("func/func.user.inscription.php")){include_once("func/func.user.inscription.php");}
   break;

   case "":
   break;
 
}

unset($_SESSION["action"]);
?>

