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

    if(file_exists("sys.php")){include("sys.php");}
    if(file_exists("action.php")){include("action.php");}
    if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");}



        $requete = "insert into sujet values (null, '".encode_bdd(strtolower($_SESSION['newsujet']))."', '".$_SESSION['categorie']."', '".$_SESSION['user']['id']."');";
        if ($resultat = $mysqli->query($requete)){
            //$_SESSION["alerte"] = "Sujet ajouté.";    
        }        



    unset($_SESSION['newsujet']);
    unset($_SESSION['user_id']);
    

    mysqli_close($mysqli);
    echo "<script type='text/javascript'>document.location.replace('".$_SESSION["page"].".php');</script>";
?>