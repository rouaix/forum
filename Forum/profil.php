<?php
    if(!isset($_SESSION)){session_start();}
    if(file_exists("sys.php")){include("sys.php");}
    if(file_exists("action.php")){include("action.php");}
    if(file_exists("securite.php")){include("securite.php");}
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>[MAD - Forum] Inscription</title>
        <link rel="stylesheet" href="./css/animate.css" />
        <link rel="stylesheet" href="./css/style.css" />
        <link rel="stylesheet" href="./css/id.css" />
        <link rel="stylesheet" href="./css/classe.css" />
    </head>

    <body class="fond">
        <?php if(file_exists("header.php")){include("header.php");}?>
        <article>
            <section class="marge nmenu cnoir bg4">
                    <h3>Profil utilisateur</h3>
                    <?php
                        if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");}
                        $requete = "select * from user where user_id = '".$_SESSION['user']["id"]."' limit 1";
                        if ($resultat = $mysqli->query($requete)){
                            reset($resultat);
                            $ligne = $resultat->fetch_assoc();
                        }
                    ?>
                    
                    <hr />
                    <p>Role => <?php echo nomRole($ligne["role_id"]);?></p>
                    <hr />
                    
                    <?php
                        if (isset($_SESSION["alerte"])){
                            echo "<h2>".$_SESSION["alerte"]."</h2>";
                            unset($_SESSION["alerte"]);
                        }
                    ?>  
                                        
                    <form action="modif_profil.php" method="GET" name="modifprofilform" ENCTYPE="text/plain" class="inscription">
                       
                        <div>
                        <input class="cnoir" type="text" name="maj_prenom" value="<?php echo $ligne["prenom"];?>">
                        <input class="cnoir" type="text" name="maj_nom" value="<?php echo $ligne["nom"];?>">
                        <input class="cnoir" type="text" name="maj_pseudo" value="<?php echo $ligne["pseudo"];?>">
                        <input class="cnoir" type="email" name="maj_mail" value="<?php echo $ligne["mail"];?>">
                        <input class="cnoir" type="password" name="maj_motdepasse" value="">                                                
                        <label class="cnoir" for="naissance">* Votre date de naissance</label>
                        <input class="cnoir" type="date" name="maj_naissance" value="<?php echo $ligne["naissance"];?>">
                        
                        <input type="submit" name="submit" value="Envoyer" class="bg2" style="display:block; width:50%;">
                        </div>
                        
                        <input type="hidden" name="form_nom" value="majprofil"> 
                    </form>                                    
            </section>
        </article>
        <?php 
        if(file_exists("footer.php")){include("footer.php");} 
        mysqli_close($mysqli); 
        ?>
    </body>

    </html>
