<?php
    $mysqli = mysqli_connect('localhost', 'root', 'genius371524', 'forum');            
    if (!$mysqli) 
    {
        die('Erreur de connexion (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
    }

//htmlentities($str);
//html_entity_decode($str);
?>