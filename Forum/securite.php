<?php
if(!isset($_SESSION)){session_start();}
if(!isset($_SESSION["alerte"])){$_SESSION["alerte"] = "";}

if(!isset($_SESSION["user"]["id"])){
    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
    
}

?>