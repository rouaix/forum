<?php
if(!isset($_SESSION)){session_start();}

function encode_bdd($x){
    return addslashes(htmlentities($x, ENT_QUOTES, "UTF-8"));
}

function decode_bdd($x){
    return stripslashes(html_entity_decode($x));
}

function qui($x){
    $y = "";
    if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");}
    $requete = "select * from user where user_id = '".$x."' limit 1";
    if ($resultat = $mysqli->query($requete)){
        reset($resultat);
        if ($ligne = $resultat->fetch_assoc()){
            $y = ucfirst($ligne["pseudo"])." (".ucfirst($ligne["prenom"])." ".strtoupper($ligne["nom"]).")";
        }
    }
    mysqli_close($mysqli); 
return $y;
}

function administrateur($x){
    if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");}
    $requete = "select * from user where user_id = '".$x."' limit 1";
    if ($resultat = $mysqli->query($requete)){
        reset($resultat);
        if ($ligne = $resultat->fetch_assoc()){
            if($ligne["role_id"]== 1){
                return true;
            }else{
                return false;
            }
        }
    }
    mysqli_close($mysqli); 
}

function utilisateur($x){
    if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");}
    $requete = "select * from user where user_id = '".$x."' limit 1";
    if ($resultat = $mysqli->query($requete)){
        reset($resultat);
        if ($ligne = $resultat->fetch_assoc()){
            if($ligne["role_id"]== 2){
                return true;
            }else{
                return false;
            }
        }
    }
    mysqli_close($mysqli); 
}

function moderateur($x){
    if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");}
    $requete = "select * from user where user_id = '".$x."' limit 1";
    if ($resultat = $mysqli->query($requete)){
        reset($resultat);
        if ($ligne = $resultat->fetch_assoc()){
            if($ligne["role_id"]== 3){
                return true;
            }else{
                return false;
            }
        }
    }
    mysqli_close($mysqli); 
}

function banni($x){
    if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");}
    $requete = "select * from user where user_id = '".$x."' limit 1";
    if ($resultat = $mysqli->query($requete)){
        reset($resultat);
        if ($ligne = $resultat->fetch_assoc()){
            if($ligne["role_id"]== 4){
                return true;
            }else{
                return false;
            }
        }
    }
    mysqli_close($mysqli); 
}

function machine(){
   if(!isset($_SESSION["machine"])){
     $_SESSION["machine"] = getenv("HTTP_HOST");
   }
}

function cherche_ip(){
    if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];}
    elseif(isset($_SERVER['HTTP_CLIENT_IP'])){$ip  = $_SERVER['HTTP_CLIENT_IP'];}
    else{$ip = $_SERVER['REMOTE_ADDR'];}
    return $ip;
}

function session_variables(){
  if(count($_GET)){
    while (list($key, $val) = each($_GET)){
      //if($val!=""){$_SESSION[$key]= $val ;}else{unset($_SESSION[$key]);}
      if($val!=""){
        $_SESSION[$key]= htmlentities($val,ENT_QUOTES,'UTF-8');
      }else{
        unset($_SESSION[$key]);
      }
    }
  }
  if(count($_POST)){
    while (list($key, $val) = each($_POST)){
      //if($val!=""){$_SESSION[$key]= $val ;}else{unset($_SESSION[$key]);}
      if($val!=""){
        //$_SESSION[$key]= htmlentities($val,ENT_QUOTES,'UTF-8');
        $_SESSION[$key]= $val;
      }else{
        unset($_SESSION[$key]);
      }
    }
  }
  unset($_GET);
  unset($_POST);
}

?>
