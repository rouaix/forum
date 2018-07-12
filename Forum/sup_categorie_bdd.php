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
    
    if(isset($_SESSION["user_id"]) && isset($_SESSION["categorie_id"]) && isset($_SESSION["page"])){
        if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");}
        $requete = "delete from categorie where categorie_id = '".$_SESSION["categorie_id"]."'";
        $resultat = $mysqli->query($requete) or die ('Erreur '.$requete.' '.$mysqli->error);

        
        $requete = "delete from sujet where categorie_id = '".$_SESSION["categorie_id"]."'";
        $resultat = $mysqli->query($requete) or die ('Erreur '.$requete.' '.$mysqli->error);
        
        unset($_SESSION["categorie_id"]);
        unset($_SESSION["user_id"]);
        
        echo "<script type='text/javascript'>document.location.replace('".$_SESSION["page"].".php');</script>"; 
        
    mysqli_close($mysqli); 
}
?>