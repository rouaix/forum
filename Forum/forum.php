<?php
    if(!isset($_SESSION)){session_start();}

    if(count($_GET)){
        while (list($key, $val) = each($_GET)){
          if($val!=""){
            $_SESSION[$key]= $val;
          }else{
            //unset($_SESSION[$key]);
          }
        }
        unset($_GET);
    }

//htmlentities($str);
//html_entity_decode($str);

    if(file_exists("sys.php")){include("sys.php");}
    if(file_exists("action.php")){include("action.php");}

    if(!isset($_SESSION["categorie"])){$_SESSION["categorie"] = 1;}
    if(!isset($_SESSION["sujet"])){$_SESSION["sujet"] = 1;}

    if(isset($_SESSION["form_message"])){
        if($_SESSION["form_message"] == "ecrire"){
            if(isset($_SESSION["contenu"]) && isset($_SESSION["user_id"]) && isset($_SESSION["categorie_id"]) && isset($_SESSION["sujet_id"])){
                if($_SESSION["contenu"]!="" && $_SESSION["user_id"]!="" && $_SESSION["categorie_id"]!="" && $_SESSION["sujet_id"]!=""){
                    if(!isset($_SESSION['destinataire_id'])){
                        $_SESSION['destinataire_id']=0;
                    }
                    if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");}
                    $requete = "insert into message values (null, '".htmlentities($_SESSION['contenu'])."', '".$_SESSION['user_id']."', '".$_SESSION['categorie_id']."', '".$_SESSION['sujet_id']."', '".$_SESSION['destinataire_id']."', '".$_SESSION['date']."');";
                    $resultat = $mysqli->query($requete) or die ('Erreur '.$requete.' '.$mysqli->error);
                    if($resultat == 1){                             unset($_SESSION['contenu'],$_SESSION['user_id'],$_SESSION['destinataire_id'],$_SESSION['date'],$_SESSION['form_message']);
                    }                    
                }
            }
        }
        echo "<script type='text/javascript'>document.location.replace('forum.php');</script>";   
    }
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>[MAD - Forum] Forum</title>
        <link rel="stylesheet" href="./css/animate.css" />
        <link rel="stylesheet" href="./css/style.css" />
        <link rel="stylesheet" href="./css/id.css" />
        <link rel="stylesheet" href="./css/classe.css" />
    </head>

    <body class="forum fc3">
        <article class="forum">
            <header>
                <img src="./img/logo.jpg" alt="" class="animated bounce forum" />

                <p class="droite padding fc1"><a href="user.php" title="Mon profil"><img src="img/u3.png" alt="Profil" title="Mon profil" style="width: 24px;height: 24px;margin:0 5px 0 0;"></a>
                    <?php echo @$_SESSION["user"]["pseudo"]; ?><a href="logout.php" title="Sortir"><img src="img/u5.png" alt="Déconnexion" title="Déconnexion" style="width: 24px;height: 24px;margin:0 0 0 5px;"></a></p>
            </header>
            <section class="forum">
                <?php
            
        if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");}
            
        $requete = "select * from message where categorie_id = '".$_SESSION["categorie"]."' and sujet_id = '".$_SESSION["sujet"]."' order by categorie_id desc";
    
        echo "<div class='listemessage'>";
        if ($resultat = $mysqli->query($requete)){
            reset($resultat);
            while  ($ligne = $resultat->fetch_assoc())
            {
                echo "<div class='message'>".html_entity_decode($ligne["contenu"]);
                echo "<br />";
                $requeteB = "select * from user where user_id = '".$ligne["user_id"]."' limit 1";
                if ($resultatB = $mysqli->query($requeteB)){
                    reset($resultatB);
                    $ligneB = $resultatB->fetch_assoc();
                    
                    echo "Auteur => ".ucfirst($ligneB["pseudo"]);
                        if(($ligne["user_id"]== $_SESSION["user"]["id"]) || $_SESSION["user"]["role"]==1 || $_SESSION["user"]["role"] ==2 || $_SESSION["user"]["role"] == 3){
                            echo "<div><a href='sup_message_bdd.php?message_id=".$ligne["message_id"]."&user_id= ".$_SESSION["user"]["id"]."&page=forum '><img src='img/ko.png' width='24' height='24' alt='' /></a></div>";
                        }
                    echo "</div>";
                }
            }

        }
        echo "</div>";

        mysqli_close($mysqli); 

        ?>
            </section>
            <div class="saisirmessage fc1">
                <form action="forum.php" method="GET" name="forumform" enctype="text/plain">
                    <textarea name="contenu">
                    </textarea>
                    <input type="submit" name="submit" value="Ecrire">
                    
                    <input type="hidden" name="form_message" value="ecrire">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id']; ?>">
                    <input type="hidden" name="categorie_id" value="<?php echo $_SESSION['categorie']; ?>">
                    <input type="hidden" name="sujet_id" value="<?php echo $_SESSION['sujet']; ?>">
                    <input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>">
                </form>
            </div>
        </article>
        <aside class="forum">
            <div>
                <section>
                    <?php
                    if(isset($_SESSION["user"]["role"])){
                        if($_SESSION["user"]["role"] != 4){
                            if(file_exists("inc_liste_categories.php")){include("inc_liste_categories.php");}
                        }
                    }
                ?>
                </section>
            </div>
        </aside>
        <?php if(file_exists("footer.php")){include("footer.php");} ?>
    </body>

    </html>
