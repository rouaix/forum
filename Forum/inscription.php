<?php
    if(!isset($_SESSION)){session_start();}
    if(file_exists("sys.php")){include("sys.php");}
    if(file_exists("action.php")){include("action.php");}
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

    <body>
        <header><img src="./img/logo1280.jpg" id="logo" alt="" class="animated bounce" /></header>
        <nav><?php if(file_exists("nav.php")){include("nav.php");}?></nav>
        <article>
            <section>
                <fieldset>
                    <legend>Profil utilisateur</legend>
                    <p>Les champs indiqués par une * sont obligatoires.</p>
                    <hr />
                    <form action="inscription.validation.php" method="GET" name="loginform" ENCTYPE="text/plain" class="inscription">
                       
                        <div>
                        <input type="text" name="prenom" placeholder="* Votre Prénom" required>
                        <input type="text" name="nom" placeholder="* Votre nom" required>
                        <input type="text" name="pseudo" placeholder="* Votre Pseudonyme" required>
                        <input type="email" name="mail" placeholder="* Votre adresse de courriel" required>
                        <input type="password" name="motdepasse" placeholder="* Votre mot de passe" required>
                                                
                        <label for="naissance">* Votre date de naissance</label>
                        <input type="date" name="naissance" placeholder="Votre date de naissance">
                        </div>
                        <input type="submit" name="submit" value="">
                        <input type="hidden" name="role_id" value="2">
                        <input type="hidden" name="inscription" value="<?php echo date("Y-m-d"); ?>">
                        <input type="hidden" name="form_nom" value="inscription"> 
                    </form>  
                            <?php
                                if (isset($_SESSION["alerte"])){
                                    echo "<h2>".$_SESSION["alerte"]."</h2>";
                                    unset($_SESSION["alerte"]);
                                }
                            ?>                                    
                </fieldset>
            </section>
        </article>
        <?php if(file_exists("footer.php")){include("footer.php");} ?>
    </body>

    </html>
