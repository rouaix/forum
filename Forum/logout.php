<?php
if(!isset($_SESSION)){session_start();}

while (list($key, $val) = each($_SESSION)){
    unset($_SESSION[$key]);
}
session_write_close();
unset($_SESSION);
echo "<script type='text/javascript'>document.location.replace('index.php');</script>";  
?>