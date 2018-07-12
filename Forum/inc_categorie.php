<?php
if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");}
$requete = "
select 
categorie.categorie_id as cid, categorie.designation as cd, sujet.sujet_id as sid, sujet.designation as sd
from categorie
inner join sujet
on categorie.categorie_id = sujet.categorie_id
order by categorie.categorie_id, sujet.designation
";  

echo "<div class='padding bg1 nmenu'>";
?>
<p class="cblanc centre">Nouveau sujet dans ["<?php echo nomCategorie($_SESSION["categorie"]); ?>"]</p>
<form action="add_sujet.php" method="GET" name="sujetform" enctype="text/plain">
    <input class="nmenu bgblanc c1 inpcat" type="text" name="newsujet" required />
    <input type="submit" name="submit" value="" class="btcat" title="Ajouter ce sujet dans <?php echo nomCategorie($_SESSION["categorie"]); ?>"/>
</form>
<?php
echo "</div>";

if ($resultat = $mysqli->query($requete)){
    reset($resultat);
    while  ($ligne = $resultat->fetch_assoc()){
        if($_SESSION["categorie"] == $ligne["cid"] && $_SESSION["sujet"] == $ligne["sid"]){$cl ="bg2";}else{$cl ="bg3";}
        echo "<a href='forum.php?categorie=".$ligne["cid"]."&sujet=".$ligne["sid"]."' title=''>";
        echo "<div class='nmenu ".$cl." cblanc'>";
        echo ucfirst(decode_bdd($ligne["cd"]))."<br />&nbsp;=> ".ucfirst(decode_bdd($ligne["sd"]))."</div></a>";
    }
}
?> 

<div class="padding bg1 nmenu">
<p class="cblanc centre">Nouvelle catégorie</p>
<form action="add_categorie.php" method="GET" name="categorieform" enctype="text/plain">
    <input class="nmenu bgblanc c1 inpcat" type="text" name="newcategorie" required />
    <input type="submit" name="submit" value="" class="btcat" title="Ajouter ce sujet dans <?php echo nomCategorie($_SESSION["categorie"]); ?>"/>
</form>
</div