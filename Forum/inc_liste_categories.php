<?php

    if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");}
    $requete = "select * from categorie order by designation";
    //--------------------------------
    
    echo "<h6>Les catégories et sujets</h6>";
    echo "<ul>";
    if ($resultat = $mysqli->query($requete)){
        reset($resultat);
    
        while  ($ligne = $resultat->fetch_assoc())
        {
            echo "<li>".$ligne["designation"]."</li>";
            echo "<div style ='display:block;'><p>";
            $requeteB = "select * from sujet where categorie_id = '".$ligne["categorie_id"]."' order by designation";
            if ($resultatB = $mysqli->query($requeteB)){
                reset($resultatB);
                while  ($ligneB = $resultatB->fetch_assoc())
                {
                    echo "=> ".$ligneB["designation"]."<br />";
                }
                echo "</p></div>";
            }
        }
        
    }else{
        echo "<li>Désolé, cette liste est vide.</li>";
    }
    echo "</ul>";
    //-------------------------------- 

    mysqli_close($mysqli); 

?>