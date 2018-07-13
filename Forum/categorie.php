<?php
if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");}
$requete = "
select 
categorie.categorie_id as cid, categorie.designation as cd, sujet.sujet_id as sid, sujet.designation as sd
from categorie
inner join sujet
on categorie.categorie_id = sujet.categorie_id
";  

if($_SESSION["categorie"] == 1 && $_SESSION["sujet"] == 1){$cl ="bg2";}else{$cl ="bg3";}    
echo "<a href='forum.php?categorie=1&sujet=1' title=''><div class='nmenu ".$cl." cblanc'>Forum => Général</div></a>";

if ($resultat = $mysqli->query($requete)){
    reset($resultat);
    while  ($ligne = $resultat->fetch_assoc()){
        if($_SESSION["categorie"] == $ligne["cid"] && $_SESSION["sujet"] == $ligne["sid"]){$cl ="bg2";}else{$cl ="bg3";}
        echo "<a href='forum.php?categorie=".$ligne["cid"]."&sujet=".$ligne["sid"]."' title=''><div class='nmenu ".$cl." cblanc'>".$ligne["cd"]." => ".$ligne["sd"]."</div></a>";
    }
}
?> 