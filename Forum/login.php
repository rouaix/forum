<?php
    if(!isset($_SESSION)){session_start();}

    if(count($_GET)){
        while (list($key, $val) = each($_GET)){
          if($val!=""){
            $_SESSION[$key]= $val;
          }else{
            unset($_SESSION[$key]);
          }
        }
        unset($_GET);
    }

?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>[MAD - Forum]</title>
        <link rel="stylesheet" href="./css/animate.css" />
        <link rel="stylesheet" href="./css/style.css" />
        <link rel="stylesheet" href="./css/id.css" />
        <link rel="stylesheet" href="./css/classe.css" />
    </head>

    <body>
        <?php


    if(file_exists("sys.php")){include("sys.php");}
    if(file_exists("action.php")){include("action.php");}

    if(isset($_SESSION["loguser"]) && $_SESSION["loguser"] != "")
    {
        if(isset($_SESSION["logpass"]) && $_SESSION["logpass"] != "")
        {
            if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");}
                                 
            $_SESSION["user"]["type"]="Visisteur";               
            
            //--------------------------------
            
            $requete = "select * from user where mail='".$_SESSION["loguser"]."'";
            $resultat = $mysqli->query($requete) or die ('Erreur '.$requete.' '.$msqli->error);
            $ligne = $resultat->fetch_assoc();
            
            if($_SESSION["loguser"] == $ligne["mail"] && md5($_SESSION["logpass"]) == $ligne["motdepasse"])
            {
                $_SESSION["user"]["type"] = "Utilisateur";
                $_SESSION["user"]["id"] = strtoupper($ligne["user_id"]);
                $_SESSION["user"]["nom"] = strtoupper($ligne["nom"]);
                $_SESSION["user"]["prenom"] = ucfirst($ligne["prenom"]);
                $_SESSION["user"]["pseudo"] = ucfirst($ligne["pseudo"]);
                $_SESSION["user"]["email"] = strtolower($ligne["mail"]);
                $_SESSION["user"]["role"] = $ligne["role_id"];
                $_SESSION["user"]["naissance"] = $ligne["naissance"];
                $_SESSION["user"]["inscription"] = $ligne["inscription"];
            }else{
                unset($_SESSION["user"]);
                $_SESSION["alerte"] = "Erreur de connexion";
                echo "<script type='text/javascript'>document.location.replace('index.php');</script>"; 
            }                
                        
            //-------------------------------- 
            
            mysqli_close($mysqli); 
        } 
    }
    echo "<script type='text/javascript'>document.location.replace('forum.php');</script>";      
?>

    </body>

    </html>
