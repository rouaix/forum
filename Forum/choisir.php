<?php
    if(!isset($_SESSION)){session_start();}

    if(file_exists("sys.php")){include("sys.php");}
    if(file_exists("action.php")){include("action.php");}

?>
    <!DOCTYPE html>
    <html>

    <head>
        <?php if(file_exists("head.php")){include("head.php");}?>
    </head>

    <body class="bg3" onload="">
        <?php if(file_exists("header.php")){include("header.php");}?>
        <article class="block">          
            <a href="forum.php" title="retour"><p class="centre">Annulation</p></a>
           
            <section class="nmenu">
            
        <?php
        if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");}
        
        $requete = "select * from message where message.sujet_id NOT IN(select sujet.sujet_id from sujet)";
        
        
        $requete = "
            select 
            categorie.categorie_id as cid, categorie.designation as cd, sujet.sujet_id as sid, sujet.designation as sd
            from categorie
            inner join sujet
            on categorie.categorie_id = sujet.categorie_id
            "; 
        
            echo "<a href='forum.php?categorie=1&sujet=1' title=''><div class='nmenu bg1 c4'>Forum => Général</div></a>";
                
        if ($resultat = $mysqli->query($requete)){
            reset($resultat);
            while  ($ligne = $resultat->fetch_assoc()){
                echo "
                    <a href='forum.php?categorie=".$ligne["cid"]."&sujet=".$ligne["sid"]."' title=''><div class='nmenu bg2 c4'>".$ligne["cd"]." => ".$ligne["sd"]."</div></a>
                ";
            }
        }
        ?>
                       
            </section>                   

        </article>
        
        

        
        <?php if(file_exists("footer.php")){include("footer.php");} ?>
    </body>

    </html>
