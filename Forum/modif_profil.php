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

    while (list($key, $val) = @each($_SESSION)){
        if(!is_array($key)){
         if (substr($key,0,4) == "maj_"){
             $champs = substr($key,4); 
             if($champs != "motdepasse"){
                $requete = "update user set ".$champs." = '".encode_bdd($val)."' where user_id='".$_SESSION["user"]["id"]."'";
                $resultat = $mysqli->query($requete) or die ('Erreur '.$requete.' '.$mysqli->error);                 
             }else{
                 if($val != ""){
                    $requete = "update user set ".$champs." = '".md5($val)."' where user_id='".$_SESSION["user"]["id"]."'";
                    $resultat = $mysqli->query($requete) or die ('Erreur '.$requete.' '.$mysqli->error);                      
                 }
             }
         }
        }
    }


    mysqli_close($mysqli);
    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";    
?>
