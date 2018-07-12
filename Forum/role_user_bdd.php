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
    
    if(isset($_SESSION["user_id"]) && isset($_SESSION["role_id"]) && isset($_SESSION["page"])){
        if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");}
        
        $requete = "update user set role_id = '".$_SESSION["role_id"]."' where user_id='".$_SESSION["user_id"]."'";
        
        
        $resultat = $mysqli->query($requete) or die ('Erreur '.$requete.' '.$mysqli->error);
        
        unset($_SESSION["role_id"]);
        unset($_SESSION["user_id"]);
        
        echo "<script type='text/javascript'>document.location.replace('".$_SESSION["page"].".php');</script>"; 
        
    mysqli_close($mysqli); 
}
?>