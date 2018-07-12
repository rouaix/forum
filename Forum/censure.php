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

    if(file_exists("sys.php")){include("sys.php");}
    if(file_exists("action.php")){include("action.php");}

    if(isset($_SESSION["censure"])){
        if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");}

        $requete = "select * from message where message_id = '".$_SESSION["censure"]."'";
        $resultat = $mysqli->query($requete);
        reset($resultat);
        $ligne = $resultat->fetch_assoc();

        if(!strstr(decode_bdd($ligne["contenu"]),"Message censur")){      
            $contenu = "Message censuré => ";
            $requete = "update message set contenu= '".encode_bdd($contenu)."' where message_id = '".$_SESSION["censure"]."'";
            $resultat = $mysqli->query($requete) or die ('Erreur '.$requete.' '.$mysqli->error);
        }
            
        unset($_SESSION["message_id"]);
        unset($_SESSION["user_id"]);
        unset($_SESSION["censure"]);
        
        echo "<script type='text/javascript'>document.location.replace('".$_SESSION["page"].".php');</script>"; 
        
        mysqli_close($mysqli); 
    }
?>