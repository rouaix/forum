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
        <?php if(file_exists("header.php")){include("header.php");}?>
        <article>
            <section class="marge nmenu cnoir bg4">
                    <h3>Page d'inscription</h3>
                    <p>Les champs indiqués par une * sont obligatoires.</p>
                    <hr />
                    <form action="inscription.validation.php" method="GET" name="loginform" ENCTYPE="text/plain" class="inscription">
                       
                        <div>
                        <input class="cnoir" type="text" name="prenom" placeholder="* Votre Prénom" required>
                        <input class="cnoir" type="text" name="nom" placeholder="* Votre nom" required>
                        <input class="cnoir" type="text" name="pseudo" placeholder="* Votre Pseudonyme" required>
                        <input class="cnoir" type="email" name="mail" placeholder="* Votre adresse de courriel" required>
                        <input class="cnoir" type="password" name="motdepasse" placeholder="* Votre mot de passe" required>
                                                
                        <label class="cnoir" for="naissance">* Votre date de naissance</label>
                        <input class="cnoir" type="date" name="naissance" placeholder="Votre date de naissance">
                        <input type="submit" name="submit" value="Envoyer" class="bg2" style="display:block; width:50%;">
                        </div>
                        
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
            </section>
        </article>
        <?php if(file_exists("footer.php")){include("footer.php");} ?>
    </body>

    </html>
