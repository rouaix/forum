<?php
//date_default_timezone_set(‘Europe/Paris’); 

switch ($_SESSION["page"]) {
   case "accueil":?>
    <title>[MAD - Forum] Accueil</title>
    <?php
   break;
        
   case "forum":?>
        <title>[MAD - Forum] Forum</title>
        <?php             
   break;

   case "profil": ?>
        <?php         
   break;

   case "administration": ?>
        <?php         
   break;
        
    default : ?>
        <?php        
    break;
 
}

?>
        <link rel="stylesheet" href="./css/animate.css" />
        <link rel="stylesheet" href="./css/style.css" />
        <link rel="stylesheet" href="./css/classe.css" />
