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

    if(file_exists("sys.php")){include("sys.php");}
    if(file_exists("action.php")){include("action.php");}

    if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");}

    $requete = "select * from user where mail='".$_SESSION["mail"]."' or pseudo = '".$_SESSION["pseudo"]."' ";
    $resultat = $mysqli->query($requete) or die ('Erreur '.$requete.' '.$msqli->error);
    $ligne = $resultat->fetch_assoc();
    if (count($ligne)){
        $_SESSION["alerte"] = "Erreur - Adresse mail ou Pseudo existant !";
        echo "<script type='text/javascript'>document.location.replace('inscription.php');</script>"; 
        mysqli_close($mysqli); 
    }else{
         mysqli_close($mysqli); 
        if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");}
        
        if(!isset($_SESSION['naissance'])){
            $_SESSION['naissance'] = date("Y-m-d");
        }
            
        $_SESSION['inscription'] = date("Y-m-d");
        
        $requete = "insert into user values (null, '".$_SESSION['pseudo']."', '".$_SESSION['prenom']."', '".$_SESSION['nom']."', '".$_SESSION['mail']."', '".$_SESSION['role_id']."', '".md5($_SESSION['motdepasse'])."', '".$_SESSION['naissance']."', '".$_SESSION['inscription']."');";
        
        $resultat = $mysqli->query($requete) or die ('Erreur '.$requete.' '.$mysqli->error);
        
        if($resultat == 1){
                
        $_SESSION["user"]["type"] = "Utilisateur";
        $_SESSION["user"]["nom"] = strtoupper($_SESSION["nom"]);
        $_SESSION["user"]["prenom"] = ucfirst($_SESSION["prenom"]);
        $_SESSION["user"]["pseudo"] = ucfirst($_SESSION["pseudo"]);
        $_SESSION["user"]["email"] = strtolower($_SESSION["mail"]);
        $_SESSION["user"]["role"] = $_SESSION["role_id"];
        $_SESSION["user"]["naissance"] = $_SESSION["naissance"];
        $_SESSION["user"]["inscription"] = $_SESSION["inscription"];   
        unset($_SESSION["nom"],$_SESSION["prenom"],$_SESSION["pseudo"],$_SESSION["mail"],$_SESSION["role_id"],$_SESSION["naissance"],$_SESSION["inscription"]);

        echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
            
        }else{
            $_SESSION["alerte"] = "Erreur !";
            echo "<script type='text/javascript'>document.location.replace('inscription.php');</script>";            
        }
    }
?>