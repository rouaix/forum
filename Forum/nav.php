<?php
if(!isset($_SESSION)){session_start();}

if(isset($_SESSION["user"]["id"])){
    if (utilisateur($_SESSION["user"]["id"]) || administrateur($_SESSION["user"]["id"]) || moderateur($_SESSION["user"]["id"])){
        echo "<div class='nmenu bg2'><a href='index.php' title='Accueil'>Accueil</a></div>";
        echo "<div class='nmenu bg2'><a href='forum.php' title='Forum'>Forum</a></div>";
        echo "<div class='nmenu bg2'><a href='profil.php' title='Profil'>Profil</a></div>";
        if (administrateur($_SESSION["user"]["id"])){
            echo "<div class='nmenu bg2' title='Administration'><a href='admin.php' title='Administration'>Administration</a></div>";    
        }
        echo "<div class='nmenu bg2'><a href='logout.php' title='Déconnexion'>Déconnexion</a></div>";
    }
}
?>