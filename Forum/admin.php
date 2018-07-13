<?php
    if(!isset($_SESSION)){session_start();}

    if(file_exists("sys.php")){include("sys.php");}
    if(file_exists("action.php")){include("action.php");}
    if(file_exists("securite.php")){include("securite.php");}
    $_SESSION["page"] = "admin";
?>
<!DOCTYPE html>
<html>
<head>
    <?php if(file_exists("head.php")){include("head.php");}?>
</head>

<body class="bg3 cblanc">
    <?php if(file_exists("header.php")){include("header.php");}?>
    
    <?php
    if (isset($_SESSION["user"]["id"])){
        if(administrateur($_SESSION["user"]["id"])){
        ?>
        <article class="padding">
            <section class=""><h3>Utilisateurs</h3>
            <?php echo liste_utilisateurs(); ?>
            </section>
            <section class=""><h3>Catégories & sujets</h3>
            <?php echo liste_categoriesetsujets(); ?>
            </section>       
            <section class=""><h3>Réponses orphelines</h3>
            <?php echo liste_reponsesorphelines(); ?>
            </section>   
            <section class=""><h3>Messages orphelins de categorie </h3>
            <?php echo liste_messagesorphelinscategorie(); ?>
            </section>  
            <section class=""><h3>Messages orphelins de sujet </h3>
            <?php echo liste_messagesorphelinssujet(); ?>
            </section>                                 
        </article>        
        <?php
        }else{
            echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
        }
    }else{
        echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
    }
    if(file_exists("footer.php")){include("footer.php");} ?>
</body>

</html>
