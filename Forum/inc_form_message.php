<?php
//-- A commenter
?>
    <?php 

        echo "<div class='cblanc marge droite padding'>";
            echo "<a href='forum.php?editeur=0' title='Fermer'>";
            echo "<img src='img/Close-128.png' width='24' height='24' alt='Message' title='Fermer' />";
            echo "</a>"; 
        echo "</div>";

    if ($_SESSION["reponse"]!=0){ 
        echo "<div class='cblanc marge'>";
            echo "<a href='forum.php?reponse=0' title='Annuler et ne pas répondre'>";
            echo "<img src='img/Close-128.png' width='24' height='24' alt='Message' title='Annuler et ne pas répondre' />";
            echo "</a> Répondre au message (N°".$_SESSION["reponse"].")"; 
            echo affiche_message($_SESSION["reponse"]);
        echo "</div>";
    } 
    ?>  
<form id="ecrire" action="forum.php" method="GET" name="forumform" enctype="text/plain" class="marge">
  
    <?php if ($_SESSION["reponse"]==0){ ?> 
    <div class="marge">
    <label for="destinataire_id" class="cblanc marge">Destinataire</label>
    <select name="destinataire_id" class="marge padding">
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
    <?php }else{
        echo "<input type='hidden' name='destinataire_id' value='0'>";
    }?>
        <textarea name="contenu" id="lemessage" class="marge" style="width:99%;"></textarea>
    
    <div class="marge padding">
        <input type="submit" name="submit" value="Envoyer" class="bg1 large marge" style="width:50%;margin-bottom:20px;">
    </div>
    
    <input type="hidden" name="editeur" value="0">
    <input type="hidden" name="form_message" value="ecrire">
    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id']; ?>">
    <input type="hidden" name="categorie_id" value="<?php echo $_SESSION['categorie']; ?>">
    <input type="hidden" name="sujet_id" value="<?php echo $_SESSION['sujet']; ?>">
    <input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>">
    <input type="hidden" name="pere_id" value="<?php echo $_SESSION['reponse']; ?>">
</form>