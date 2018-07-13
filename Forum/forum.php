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

    if(count($_POST)){
        while (list($key, $val) = each($_POST)){
          if($val!=""){
            $_SESSION[$key]= $val;
          }else{
            //unset($_SESSION[$key]);
          }
        }
        unset($_POST);
    }

    $_SESSION["page"] = "forum";

//htmlentities($str);
//html_entity_decode($str);

    if(file_exists("sys.php")){include("sys.php");}
    if(file_exists("action.php")){include("action.php");}
    if(file_exists("securite.php")){include("securite.php");}

    if(!isset($_SESSION["categorie"])){$_SESSION["categorie"] = 1;}
    if(!isset($_SESSION["sujet"])){$_SESSION["sujet"] = 1;}
    if(!isset($_SESSION["reponse"])){$_SESSION["reponse"] = 0;}
    if(!isset($_SESSION["destinataire"])){$_SESSION["destinataire"] = 0;}

    if(!isset($_SESSION["editeur"])){$_SESSION["editeur"] = 0;}


    if(isset($_SESSION["form_message"])){
        if($_SESSION["form_message"] == "ecrire"){
            if(isset($_SESSION["contenu"]) && isset($_SESSION["user_id"]) && isset($_SESSION["categorie_id"]) && isset($_SESSION["sujet_id"])){
                if($_SESSION["contenu"]!="" && $_SESSION["user_id"]!="" && $_SESSION["categorie_id"]!="" && $_SESSION["sujet_id"]!=""){
                    
                    if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");}
                    
                    $requete = "insert into message values (null, '".encode_bdd($_SESSION['contenu'])."', '".$_SESSION['user_id']."', '".$_SESSION['categorie_id']."', '".$_SESSION['sujet_id']."', '".$_SESSION['destinataire_id']."', '".$_SESSION['date']."', '".$_SESSION['reponse']."');";
                    $resultat = $mysqli->query($requete) or die ('Erreur '.$requete.' '.$mysqli->error);
                    
                    unset($_SESSION['contenu']);
                    unset($_SESSION['user_id']);
                    unset($_SESSION['destinataire_id']);
                    unset($_SESSION['date']);
                    unset($_SESSION['form_message']);
                    unset($_SESSION['pere_id']);
                    $_SESSION['reponse'] = 0;
                                   
                }
            }
        }
        echo "<script type='text/javascript'>document.location.replace('forum.php');</script>";   
    }
?>
    <!DOCTYPE html>
    <html>

    <head>
        <?php if(file_exists("head.php")){include("head.php");}?>
        <script src="js/tinymce/tinymce.min.js"></script>
        <script>
            tinymce.init({
                selector: 'textarea',
                language: "fr_FR",
                theme: "modern",
                plugins: " table code emoticons image media",
                toolbar: "insertfile undo redo | styleselect | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media template | code | emoticons",
                bbcode_dialect: "punbb"
            });

        </script>
    </head>

    <body class="bgblanc" onload="">
        <?php if(file_exists("header.php")){include("header.php");}?>
        <div class="centre bg1 padding">
            <a class="" href="forum.php?editeur=1" title="Ecrire"><img src="img/Editor-128.png" width="32" height="32" alt="Ecrire un message" title="Ecrire un message"/></a>
        </div>
        
        <div class="centr"><?php 
            if(isset($_SESSION["alerte"])){
                echo $_SESSION["alerte"];
                unset($_SESSION["alerte"]);
            }
        ?></div>
        <div class="dflex"> 
        <article class="nmenu forum bg4 margebas">
          
            <section class="listemessage">
                <?php if(file_exists("inc_liste_messages.php")){include("inc_liste_messages.php");} ?>
            </section>

        <?php if($_SESSION["editeur"]==0){ ?>
        <?php }else{ ?>
            <div class="editeur bg3" id="editeur">    
                <div class="saisirmessage<?php if ($_SESSION["reponse"]!=0){ ?>bg3">
                    <?php }else{ ?>cblanc bg2"><?php } ?>
                    <?php if(file_exists("inc_form_message.php")){include("inc_form_message.php");} ?>
                </div>
            </div>
        <?php } ?>                        

        </article>
        <aside class="forum">
        <div class="nmenu">
            <?php if(file_exists("inc_categorie.php")){include("inc_categorie.php");} ?>
        </div>
        </aside>     
        </div>
        <?php if(file_exists("footer.php")){include("footer.php");} ?>
    </body>

    </html>
