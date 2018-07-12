<?php
if(!isset($_SESSION)){session_start();}
if(!isset($_SESSION["page"])){$_SESSION["page"]="accueil";}

?><header class="bg3"><?php
    
switch ($_SESSION["page"]) {
   case "accueil": ?>
       <img src="./img/logo_c1.png" width="320" height="100" alt="" class="animated bounce" />
       <?php
   break;
        
   case "forum": ?>
       <img src="./img/logo_c1.png" width="320" height="100" alt="" class="animated bounce" />
        <?php        
   break;

   case "profil":
   break;

   case "admin":
   break;
        
    default :       
    break;
 
}
?>
<nav class="block"><?php if(file_exists("nav.php")){include("nav.php");}?></nav>
</header>