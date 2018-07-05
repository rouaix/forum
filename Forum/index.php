<?php
    if(!isset($_SESSION)){session_start();}
    if(file_exists("sys.php")){include("sys.php");}
    if(file_exists("action.php")){include("action.php");}

?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>[MAD - Forum] Accueil</title>
        <link rel="stylesheet" href="./css/animate.css" />
        <link rel="stylesheet" href="./css/style.css" />
        <link rel="stylesheet" href="./css/id.css" />
        <link rel="stylesheet" href="./css/classe.css" />
    </head>

    <body>
        <header><img src="./img/logo1280.jpg" id="logo" alt="" class="animated bounce" /></header>
        <nav>
            <?php if(file_exists("nav.php")){include("nav.php");}?>
        </nav>
        <article>
            <section>
                <fieldset>
                    <legend>Présentation</legend>
                </fieldset>
            </section>
            <section><?php
               if(!isset($_SESSION["user"]["type"])){?>
                    <form action="login.php" method="GET" name="loginform" ENCTYPE="text/plain">
                        <fieldset>
                            <legend>Formulaire de connexion</legend>
                            <br />
                            <input type="email" name="loguser" placeholder="Votre adresse mail">
                            <input type="password" name="logpass" placeholder="Votre mot de passe">
                            <input type="submit" name="submit" value="">
                            <input type="hidden" name="form_nom" value="login">

                            <p class="centre">Si c'est votre première visite, suivez moi <a href="inscription.php" title="Inscription"><img src="./img/suivant.png" id="logo" alt="" style="width:30px;height:30px;margin-left:5px;" /></a></p>
                            <?php
                                if (isset($_SESSION["alerte"])){
                                    echo "<h2>".$_SESSION["alerte"]."</h2>";
                                    unset($_SESSION["alerte"]);
                                }
                            ?>
                        </fieldset>
                    </form>                   
               <?php }else{ ?>
                   <fieldset>
                       <legend>Utilisateur connecté</legend>
                       <p><a href="logout.php" title="Sortir"><img src="img/r9.png" alt="Déconnexion" title="Déconnexion" style="width:36px;height:36px;margin:0 20px 0 0;"></a>Bonjour <?php echo $_SESSION["user"]["pseudo"]; ?></p>
                   </fieldset> 
               <?php } ?>

            </section>
            <section>
                <fieldset>
                    <legend>Liste des Catégories et sujets disponibles</legend>
                    <?php
                        if(isset($_SESSION["user"]["role"])){
                            if($_SESSION["user"]["role"] != 4){
                                if(file_exists("inc_liste_categories.php")){include("inc_liste_categories.php");}
                            }else{
                                echo "<p>Votre bannissement interdit toute consultation.</p>";
                            }  
                        }else{
                            echo "<p>Connectez-vous pour consulter la liste des catégories !</p>";
                        }
                    ?>                    
                </fieldset>
            </section>
        </article>
        <?php if(file_exists("footer.php")){include("footer.php");} ?>
    </body>

    </html>
