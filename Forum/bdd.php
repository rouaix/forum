<?php
 if(!isset($_SESSION)){session_start();}   
                
function sql_connexion(){
  $mac = @explode( '.', $_SESSION["machine"] );
  if ($_SESSION["machine"] == "127.0.0.1" or $_SESSION["machine"] == "localhost"  or @$mac[0] == "192"){
    $_SESSION["base"]="forum";
    $db_serveur = "localhost";
    $db_utilisateur = "root";
    $db_mot_de_passe = "genius371524";
  } else {
//    $_SESSION["base"]="";
//      $db_serveur = "";
//    $db_utilisateur = "";
//    $db_mot_de_passe = "";

    $_SESSION["base"]="";
      $db_serveur = "";
    $db_utilisateur = "";
    $db_mot_de_passe = "";

  }
  @$db = mysql_connect($db_serveur, $db_utilisateur, $db_mot_de_passe);
  if(!mysql_select_db($_SESSION["base"],$db)){
    $_SESSION["alerte"]="Bad Bdd !";
    //@$x = "location:http://".$_SESSION["machine"];
    //header($x);
    //exit();
  }
  unset($db_utilisateur);
  unset($db_mot_de_passe);
  unset($db_serveur);
  //unset($_SESSION["base"]);
}

function sauve(){
  if($_SESSION["temp"] == "ok"){
    if(isset($_SESSION["form_id"]) && @$_SESSION["form_id"] <> ""){
      sauve_update();
    }else{
      sauve_insert();
    }
    unset($_SESSION["temp"]);
    if(isset($_SESSION["form_vide"])){unset($_SESSION["form_vide"]);}
    unset($fkey);
    unset($row);
  }else{
    $_SESSION["alerte"] .= "<p>Pas de confirmation (Ok) !";
  }
}

function sauve_insert(){
  if(@$_SESSION["form_nom"] != ""){
    $champs = "`id`";
    $valeurs = "''";
    $result = mysql_query("SHOW COLUMNS FROM ".$_SESSION["table"]."");
    if (mysql_num_rows($result) > 0) {
      while ($row = mysql_fetch_array($result)) {
        if(is_string($row[0])){
          $fkey="form_".$row[0];
          if ($row[0] != "id"){
            if(isset($_SESSION[$fkey])){
              if($_SESSION[$fkey] == " "){$_SESSION[$fkey] = "";}
              $champs .= ",`".$row[0]."`";
              $valeurs .= ",'".$_SESSION[$fkey]."'";
              unset($_SESSION[$fkey]);
            }else{
              $champs .= ",`".$row[0]."`";
              $valeurs .= ",''";
            }
          }
        }
      }
    }
    $sql = "INSERT INTO `".$_SESSION["table"]."` (".$champs.") VALUES (".$valeurs.");";
    if(!$result = mysql_query($sql)){$_SESSION["alerte"] .= "<p>".mysql_errno().": ".mysql_error()."<p>Anomalie sauve INSERT 001 !";}
    unset($champs);
    unset($valeurs);
  }
}

function sauve_update(){
  if(isset($_SESSION["form_id"])){
    $liste = "id ='".$_SESSION["form_id"]."'";
    $result = mysql_query("SHOW COLUMNS FROM ".$_SESSION["table"]."");
    if (mysql_num_rows($result) > 0) {
      while ($row = mysql_fetch_array($result)) {
        if(is_string($row[0])){
          $fkey="form_".$row[0];
          if(isset($_SESSION[$fkey])){
            if ($row[0] != "id"){
              if($_SESSION[$fkey] == " "){$_SESSION[$fkey] = "";}
                $liste .= ",".$row[0]."='".$_SESSION[$fkey]."'";
                unset($_SESSION[$fkey]);
            }
          }
        }
      }
    }
    $sql = "update ".$_SESSION["table"]." set ".$liste." where id=".$_SESSION["form_id"];
    if(!$result = mysql_query($sql)){$_SESSION["alerte"] .= "<p>".mysql_errno().": ".mysql_error()."<p>Anomalie sauve UPDATE 002 !";}
    unset($liste);
    unset($_SESSION["form_id"]);
  }
}

function date_heure_db(){
   $x = date("Y-m-d H:i:s");
   return($x);
}

function affiche_date_heure_db($x){
   $y = explode(' ',$x);
   $z = explode('-',$y[0]);
   $x = $z[2]."/".$z[1]."/".$z[0]." ".$y[1];
   return($x);
}

function affiche_date_db($x){
   $y = explode(' ',$x);
   $z = explode('-',$y[0]);
   $x = $z[2]."/".$z[1]."/".$z[0];
   return($x);
}

function champs_liste($table){
  if($result = mysql_query("SHOW FULL COLUMNS FROM ".$table)){
    while($ligne = mysql_fetch_assoc($result)){
      $x[$ligne["Field"]] = $ligne["Type"];
    }
    return $x;
  }
}

function champs_titre($table){
  if($result = mysql_query("SHOW FULL COLUMNS FROM ".$table)){
    while($ligne = mysql_fetch_assoc($result)){
      $x[$ligne["Field"]] = $ligne["Comment"];
    }
    return $x;
  }
}

function cherche_civilite($x){
  if($y = mysql_fetch_array(mysql_query("select nom from civilite where id='".$x."'"))){
  return $y["nom"];}
}

function cherche_signature($x){
   $z = "";
  if($y = mysql_fetch_array(mysql_query("select nom from signature where qui='".$x."' limit 1"))){
    //$z = $y["nom"];
      $z = nl2br($y["nom"]);
  }else{
    $z = "Sans Signature";
  }
   return $z;
}

function datas_filtres(){ 
  switch (@$_SESSION["table"]){
    default :
      //$_SESSION["temp"] = "ok";
      //verifier_debutfin();
      if(@$_SESSION["form_nom_".$_SESSION["table"]] != ""){
        $_SESSION["temp"] = "ok";
      }
    break;
    case "user":
      if(isset($_SESSION["form_systeme_user"])){
       if(@$_SESSION["form_systeme_user"] == "A"){
         if(@$_SESSION["form_controle"] != "1"){
           unset($_SESSION["form_systeme_user"]);
           unset($_SESSION["form_controle"]);
         }else{
           $_SESSION["temp"] = "ok";
           unset($_SESSION["form_controle"]);
         }
       }
       }else{
         $_SESSION["temp"] = "ok";
       }
     break;
     case "couleurs":
       $_SESSION["form_type_couleurs"] = "couleurs";
       $_SESSION["temp"] = "ok";
     break;
     case "style":
       unset($_SESSION["style"]);
     break;
   }
}

function detruire_ligne(){
  if (est_administrateur($_SESSION["userid"])){
    if(isset($_SESSION["table"]) && isset($_SESSION["did"])){
      $sql = "delete from ".$_SESSION["table"]." where id='".$_SESSION["did"]."' limit 1";
      $result = mysql_query($sql);
    }
  }
}

?>

