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
    if(!isset($_SESSION["reponse"])){$_SESSION["reponse"] = 0;}
    if(!isset($_SESSION["destinataire"])){$_SESSION["destinataire"] = 0;}

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
        <title>[MAD - Forum] Forum</title>
        <link rel="stylesheet" href="./css/animate.css" />
        <link rel="stylesheet" href="./css/style.css" />
        <link rel="stylesheet" href="./css/id.css" />
        <link rel="stylesheet" href="./css/classe.css" />
        
      <script src="js/tinymce/tinymce.min.js"></script>
      <script>
        tinymce.init({ 
           selector:'textarea',
	       language : "fr_FR",
	       theme : "modern",            
            plugins: " table code emoticons image media",
            toolbar: "insertfile undo redo | styleselect | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media template | code | emoticons | image | media",
            bbcode_dialect: "punbb" 
                        
        });
        </script>        
    </head>

    <body class="forum fc5" onload="setFocusSaisie();">
            <header class="fc1">
               <img src="./img/logo.jpg" alt="" class="animated bounce forum" />
                
               <div><p class="droite padding"><?php echo @$_SESSION["user"]["pseudo"]; ?><a href="logout.php" title="Sortir"><img src="img/u5.png" alt="Déconnexion" title="Déconnexion" style="width: 24px;height: 24px;margin:0 0 0 5px;"></a></p>
               </div>            
            </header>
            <nav>
                <?php if(file_exists("nav.php")){include("nav.php");}?>
            </nav>
              <article class="forum">

           
            <section class="forum">
                <?php if(file_exists("inc_liste_messages.php")){include("inc_liste_messages.php");} ?>
            </section>
            
            <?php if ($_SESSION["reponse"]!=0){ ?>
            <div class="saisirmessage fc4">                    
                <?php }else{ ?>
            <div class="saisirmessage fc1">
                <?php } ?>

                <?php if(file_exists("inc_form_message.php")){include("inc_form_message.php");} ?>
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
