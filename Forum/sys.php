<?php
if(!isset($_SESSION)){session_start();}

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
