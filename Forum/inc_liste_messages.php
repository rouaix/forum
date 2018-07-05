<?php        

    if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");}

    $requete = "select * from message where categorie_id = '".$_SESSION["categorie"]."' and sujet_id = '".$_SESSION["sujet"]."' and pere_id = '0' order by message_id desc";

    echo "<div class='listemessage'>";
    if ($resultat = $mysqli->query($requete)){
        reset($resultat);
        while  ($ligne = $resultat->fetch_assoc())
        {
            if($ligne["destinataire_id"]==0 ||$ligne["destinataire_id"]==$_SESSION["user"]["id"]){
            echo "<div class='message juste'>";
            if($ligne["destinataire_id"]== $_SESSION["user"]["id"]){
                echo "<div class='message juste fc1'>";
                echo "<p class='gauche fc1'>Message privé de ".qui($ligne["user_id"])."</p><hr />";
            }
            echo decode_bdd($ligne["contenu"]);
            echo "<br />";
            $requeteB = "select * from user where user_id = '".$ligne["user_id"]."' limit 1";
            if ($resultatB = $mysqli->query($requeteB)){
                reset($resultatB);
                $ligneB = $resultatB->fetch_assoc();
                echo "<div class='droite tc2'>";
                echo "".ucfirst($ligneB["pseudo"])." (".ucfirst($ligneB["prenom"])." ".strtoupper($ligneB["nom"]).")";
                if(administrateur($_SESSION["user"]["id"]) || moderateur($_SESSION["user"]["id"]) || ($ligne["user_id"]== $_SESSION["user"]["id"])){
                        echo "<div class='gauche fc2'>";
                    
                        echo "<a href='forum.php?reponse=".$ligne["message_id"]."'>";
                        echo "<img src='img/026.png' width='24' height='24' alt='Répondre' title='Répondre' />";
                        echo "</a>";
                    
                        echo "<a href='sup_message_bdd.php?message_id=".$ligne["message_id"]."&user_id= ".$_SESSION["user"]["id"]."&page=forum ' title='Supprimer'>";
                        echo "<img src='img/ko.png' width='24' height='24' alt='' />";
                        echo "</a>";
                        echo "</div>";
                    }
                echo "</div>";
            }
            echo "</div>";
            
            //--reponse
                $requeteC = "select * from message where pere_id = '".$ligne["message_id"]."' and pere_id != 0 order by message_id desc";
                if ($resultatC = $mysqli->query($requeteC)){
                    reset($resultatC);
                    while  ($ligneC = $resultatC->fetch_assoc()){
                        echo "<div class='message juste reponse'>";
                        echo decode_bdd($ligneC["contenu"]);
                        echo "<br />";
                        
                        $requeteB = "select * from user where user_id = '".$ligneC["user_id"]."' limit 1";
                        if ($resultatB = $mysqli->query($requeteB)){
                            reset($resultatB);
                            $ligneB = $resultatB->fetch_assoc();

                            echo "<div class='droite tc4'>";
                            echo "".ucfirst($ligneB["pseudo"])." (".ucfirst($ligneB["prenom"])." ".strtoupper($ligneB["nom"]).")";
                            if(administrateur($_SESSION["user"]["id"]) || moderateur($_SESSION["user"]["id"]) || ($ligneC["user_id"]== $_SESSION["user"]["id"])){

                                    echo "<div class='droite fc4'>";
                                    echo "<a href='forum.php?reponse=".$ligne["message_id"]."'>";
                                    echo "<img src='img/026.png' width='24' height='24' alt='Répondre' title='Répondre' />";
                                    echo "</a>";                                
                                
                                    echo "<a href='sup_message_bdd.php?message_id=".$ligneC["message_id"]."&user_id= ".$_SESSION["user"]["id"]."&page=forum '>";
                                    echo "<img src='img/ko.png' width='24' height='24' alt='' />";
                                    echo "</a>";
                                    echo "</div>";
                                }
                            echo "</div>";
                        }                        
                        echo "</div>";
                    }
                }
            }
        }

    }
    echo "</div>";
    mysqli_close($mysqli); 

?>