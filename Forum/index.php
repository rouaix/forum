<?php
    if(!isset($_SESSION)){session_start();}

    if(file_exists("sys.php")){include("sys.php");}
    if(file_exists("action.php")){include("action.php");}
    
    $_SESSION["page"] = "accueil";
?>
    <!DOCTYPE html>
    <html>
    <head>
        <?php if(file_exists("head.php")){include("head.php");}?>
    </head>
    <body class="bg3 cblanc">
        <?php if(file_exists("header.php")){include("header.php");}?>
        <article class="fond">
            <section class="centre">
            <?php
                if (isset($_SESSION["alerte"])){
                    echo "<h2>".$_SESSION["alerte"]."</h2>";
                    unset($_SESSION["alerte"]);
                }
            ?>            
            </section>
            <section class="centre"><?php
               if(!isset($_SESSION["user"]["id"])){?>
                    <form class="padding centre block" action="login.php" method="GET" name="loginform" ENCTYPE="text/plain">
                       <div class="nmenu bg3">
                        <h3 class="centre"><strong>Connexion</strong></h3>
                        <input class="nmenu c4" type="email" name="loguser" placeholder="Votre adresse mail">
                        <input class="nmenu c4" type="password" name="logpass" placeholder="Votre mot de passe">
                        <br /><input class="bg2" type="submit" name="submit" value="Envoyer">
                        <input type="hidden" name="form_nom" value="login">
                        </div>
                        <a href="inscription.php" title="Inscription"><p class="centre nmenu bg1">Si c'est votre première visite, suivez moi <img src="./img/001.png" id="logo" alt="" style="width:30px;height:30px;margin-left:5px;vertical-align:baseline;" /></p></a>
                    </form>                   
               <?php }else{ ?>
                   <div class="bg2"><p class="nmenu"><strong><?php 
                       echo $_SESSION["user"]["pseudo"];
                       echo " [".ucfirst($_SESSION["user"]["prenom"]);
                       echo " ".strtoupper($_SESSION["user"]["nom"])."]";
                       echo " est parmi nous !";
                       ?></strong></p></div>
               <?php } ?>
            </section>
            <section class="centre flex">
                <div class="dflex">                
                <?php if(isset($_SESSION["user"]["id"])){ ?>
                <a href='forum.php' title='Forum'><div class="block centre nmenu l300 bg3">
                <img src="img/f_forum.png" alt="" width="120px" height="120px" class="col"/>
                <h3 class="col centre nmenu bg2">Forum</h3></div></a>
                <a href='profil.php' title='Profil'><div class="block centre nmenu l300 bg3"><img src="img/f_user.png" alt="" width="120px" height="120px"  class="col"/>
                <h3 class="col centre nmenu bg2">Utilisateur</h3></div></a>
                <?php if(administrateur($_SESSION["user"]["id"])){ ?>
                <a href='admin.php' title='Administration'><div class="block centre nmenu l300 bg3"><img src="img/f_admin.png" alt="" width="120px" height="120px"  class="col"/>
                <h3 class="col centre nmenu bg2">Administration</h3></div></a>
                <?php } ?>
                <?php } ?>                    
                </div>
            </section>  
         
        </article>
        <?php if(file_exists("footer.php")){include("footer.php");} ?>
    </body>

    </html>
