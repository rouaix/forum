<?php
//-- A commenter
?>
<form action="forum.php" method="GET" name="forumform" enctype="text/plain">
   <?php 
    if ($_SESSION["reponse"]!=0){ 
        echo "<div style='display:inline-block;float:left;'>";
        echo "<a href='forum.php?reponse=0' title='Annuler et ne pas répondre'>";
        echo "<img src='img/ko.png' width='24' height='24' alt='Message' title='Annuler et ne pas répondre' />";
        echo "</a> Répondre au message (N°".$_SESSION["reponse"].")";   
        echo "</div>";
    } 
    ?>
    <div class="block droite" style="margin-bottom:5px;">
        <label for="destinataire_id" class="gauche">Destinataire</label>
        <select name="destinataire_id">
            <option value="0" selected>Forum</option>
            <?php
            if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");}
            $requete = "select user_id, pseudo, prenom, nom,role_id from user order by pseudo";        
            if ($resultat = $mysqli->query($requete)){
                reset($resultat);
                while  ($ligne = $resultat->fetch_assoc()){
                    echo "<option value='".$ligne["user_id"]."'>".ucfirst($ligne["pseudo"])." (".ucfirst($ligne["prenom"])." ".strtoupper($ligne["nom"]).")</option>";
                }
            }
            ?>
        </select>        
    </div>
    <textarea name="contenu" id="lemessage"></textarea>
    <div class="block droite">
    <input type="submit" name="submit" value="Envoyer">
    </div>
    <input type="hidden" name="form_message" value="ecrire">
    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id']; ?>">
    <input type="hidden" name="categorie_id" value="<?php echo $_SESSION['categorie']; ?>">
    <input type="hidden" name="sujet_id" value="<?php echo $_SESSION['sujet']; ?>">
    <input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>">
    <input type="hidden" name="pere_id" value="<?php echo $_SESSION['reponse']; ?>">
</form>