<?php        

    if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");}

    $requete = "select * from message where categorie_id = '".$_SESSION["categorie"]."' and sujet_id = '".$_SESSION["sujet"]."' and pere_id = '0' order by message_id desc";

    echo "<div class=''>";
    if ($resultat = $mysqli->query($requete)){
        reset($resultat);
        while  ($ligne = $resultat->fetch_assoc()){
            if($ligne["destinataire_id"]==0 ||$ligne["destinataire_id"]==$_SESSION["user"]["id"]){               
                echo "<div class='nmenu bgblanc'>";                
                    if($ligne["destinataire_id"]== $_SESSION["user"]["id"]){
                        echo "<p class='gauche bg2 c4 padding'>Message privé de ".qui($ligne["user_id"])."</p>";
                    }
                    echo "<p class='padding juste'>".decode_bdd($ligne["contenu"])."</p>";
                    echo auteur($ligne["user_id"]);
                    echo icones_messages($ligne["user_id"],$ligne["message_id"],"droite","marge");            
                echo "</div>";
            
                echo reponse($ligne["message_id"]);
            }
        }

    }
    echo "</div>";
    mysqli_close($mysqli); 

?>
