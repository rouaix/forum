<?php
if(!isset($_SESSION)){session_start();}

function encode_bdd($x){
    return addslashes(htmlentities($x, ENT_QUOTES, "UTF-8"));
}

function decode_bdd($x){
    return stripslashes(html_entity_decode($x));
}

function nomRole($c){
    if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");}   
    $requete = "select * from role where role_id = '".$c."'";
    if ($resultat = $mysqli->query($requete)){
        reset($resultat);
        $ligne = $resultat->fetch_assoc();
        return ucfirst($ligne["designation"]);
    } 
    mysqli_close($mysqli); 
}

function nomCategorie($c){
    if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");}   
    $requete = "select * from categorie where categorie_id = '".$c."'";
    if ($resultat = $mysqli->query($requete)){
        reset($resultat);
        $ligne = $resultat->fetch_assoc();
        return ucfirst($ligne["designation"]);
    } 
    mysqli_close($mysqli); 
}

function nomSujet($c){
    if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");}   
    $requete = "select * from sujet where sujet_id = '".$c."'";
    if ($resultat = $mysqli->query($requete)){
        reset($resultat);
        $ligne = $resultat->fetch_assoc();
        return ucfirst($ligne["designation"]);
    } 
    mysqli_close($mysqli); 
}

function liste_messagesorphelinssujet(){
    $html="";
    if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");}   
    $requete = "select * from message where message.sujet_id NOT IN(select sujet.sujet_id from sujet)";
    if ($resultat = $mysqli->query($requete)){
        reset($resultat);
        $html .= "<div class='marge padding nmenu'>";
        while  ($ligne = $resultat->fetch_assoc()){
            $html .= "<div class='marge padding nmenu bg2'>";
            $html .= "<p class='padding'>Message N°".$ligne["message_id"];
            $html .= "</p>";
            $html .=  "<div class='bg1'><a class='marge padding' href='sup_message_bdd.php?message_id=".$ligne["message_id"]."&user_id= ".$ligne["user_id"]."&page=admin ' title='Supprimer'>";
            $html .=  "<img src='img/Close-128.png' alt='' title='Supprimer' width='24' height='24' />";
            $html .=  "</a></div>";     
            $html .= "</div>";

        }
        $html .= "</div>";
    } 
    return $html;
    mysqli_close($mysqli); 
}

function liste_messagesorphelinscategorie(){
    $html="";
    if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");}   
    
    $requete = "select * from message where message.categorie_id NOT IN(select categorie.categorie_id from categorie)";
    
    if ($resultat = $mysqli->query($requete)){
        reset($resultat);
        $html .= "<div class='marge padding nmenu'>";
        while  ($ligne = $resultat->fetch_assoc()){
            $html .= "<div class='marge padding nmenu bg2'>";
            $html .= "<p class='padding'>Message N°".$ligne["message_id"];
            $html .= "</p>";
            $html .=  "<a class='marge padding' href='sup_message_bdd.php?message_id=".$ligne["message_id"]."&user_id= ".$ligne["user_id"]."&page=admin ' title='Supprimer'>";
            $html .=  "<img src='img/Close-128.png' alt='' title='Supprimer' width='24' height='24' />";
            $html .=  "</a>";   
            $html .= "</div>";
        }
        $html .= "</div>";
    } 
    return $html;
    mysqli_close($mysqli); 
}

function liste_categoriesetsujets(){
    $html="";
    if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");}   
    
    $requete = "select * from categorie order by designation";
    if ($resultat = $mysqli->query($requete)){
        reset($resultat);
        $html .= "<div class='marge padding nmenu'>";
        while  ($ligne = $resultat->fetch_assoc()){            
            $html .= "<p class='marge padding nmenu bg2'>";
            $html .=  "<a class='marge padding' href='sup_categorie_bdd.php?categorie_id=".$ligne["categorie_id"]."&user_id= ".$ligne["user_id"]."&page=admin ' title='Supprimer catégorie'><img src='img/Close-128.png' alt='' title='Supprimer catégorie' width='16' height='16' /></a>";              
            $html .= " ".ucfirst($ligne["designation"]);
                $requeteB = "select * from sujet where categorie_id = '".$ligne["categorie_id"]."' order by designation";
                if ($resultatB = $mysqli->query($requeteB)){
                    while ($ligneB = $resultatB->fetch_assoc()){
                        $html .= "<br />";
                        $html .=  "<a class='marge padding' href='sup_sujet_bdd.php?sujet_id=".$ligneB["sujet_id"]."&user_id= ".$ligneB["user_id"]."&page=admin ' title='Supprimer sujet'><img src='img/Close-128.png' alt='' title='Supprimer sujet' width='16' height='16' /></a>";                         
                        $html .= " => ";
                        $html .= ucfirst($ligneB["designation"]);
                    }  
                }
            $html .= "</p>";
        }
        $html .= "</div>";
    } 
    return $html;
    mysqli_close($mysqli);  
    
}

function liste_utilisateurs(){
    $html="";
    if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");}   
    
    $requete = "select * from user order by user_id";
    if ($resultat = $mysqli->query($requete)){
        reset($resultat);
        $html .= "<div class='marge padding nmenu'>";
        while  ($ligne = $resultat->fetch_assoc()){            
            $html .= "<p class='marge padding nmenu bg2'>";            
            $html .= $ligne["pseudo"];
            $html .= " (".ucfirst($ligne["pseudo"]);
            $html .= " ".strtoupper($ligne["pseudo"]).")";
            $html .= " => ".$ligne["role_id"];
                $requeteB = "select * from role where role_id = '".$ligne["role_id"]."'";
                if ($resultatB = $mysqli->query($requeteB)){
                    while ($ligneB = $resultatB->fetch_assoc()){
                        $html .= " => ".$ligneB["designation"];
                        $html .= "</p>";
                        $html .= "<p>";
                        $html .= "<a class='marge' href='role_user_bdd.php?user_id=".$ligne["user_id"]."&role_id=1&page=admin' title='Administrateur'><img src='img/Business-Man-Settings-128.png' alt='' title='Administrateur' width='24' height='24' /></a>";
                        $html .= "<a class='marge' href='role_user_bdd.php?user_id=".$ligne["user_id"]."&role_id=2&page=admin' title='Utilisateur'><img src='img/Windows-8-Login-128.png' alt='' title='Utilisateur' width='24' height='24' /></a>";
                        $html .= "<a class='marge' href='role_user_bdd.php?user_id=".$ligne["user_id"]."&role_id=3&page=admin' title='Moderateur'><img src='img/Check-128.png' alt='' title='Moderateur' width='24' height='24' /></a>";
                        $html .= "<a class='marge' href='role_user_bdd.php?user_id=".$ligne["user_id"]."&role_id=4&page=admin' title='Bannir'><img src='img/Power-Off-128.png' alt='' title='Bannir' width='24' height='24' /></a>";
                        $html .= "<a class='marge' href='sup_user_bdd.php?user_id=".$ligne["user_id"]."&page=admin' title='Supprimer'><img src='img/Close-128.png' alt='' title='Supprimer' width='24' height='24' /></a>";
                        $html .= "</p>";                    
                    }
                }    
        }
        $html .= "</div>";
    } 
    return $html;
    mysqli_close($mysqli); 
}

function liste_reponsesorphelines(){
    $html="";
    if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");}       
    $requete = "select * from message where pere_id != '0' and message.pere_id NOT IN(select message.message_id from message)";
    
    if ($resultat = $mysqli->query($requete)){
        reset($resultat);
        $html .= "<div class='marge padding nmenu'>";
        while  ($ligne = $resultat->fetch_assoc()){
            
            $html .= "<div class='marge padding nmenu bg2'>";
            $html .= "<p class='padding'>Message N°".$ligne["message_id"]."</p>";
            $html .=  "<a class='marge padding' href='sup_message_bdd.php?message_id=".$ligne["message_id"]."&user_id= ".$ligne["user_id"]."&page=admin ' title='Supprimer'>";
            $html .=  "<img src='img/Close-128.png' alt='' title='Supprimer' width='24' height='24' />";
            $html .=  "</a>";                
            $html .= "</div>";   
            
        }
        $html .= "</div>";
    } 
    return $html;
    mysqli_close($mysqli); 
}

function affiche_message($id){
    $html = "";
    if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");} 
    $requete = "select * from message where message_id = '".$id."'";
    if ($resultat = $mysqli->query($requete)){
        reset($resultat);
        while  ($ligne = $resultat->fetch_assoc()){ 
            $html .= "<p class='marge padding'>".decode_bdd($ligne["contenu"])."</p";
            $html .= "<p class='marge padding droite'>".auteur($ligne["user_id"])."</p>";
        }
    }
    return $html;
    mysqli_close($mysqli); 
}

function reponse($message){
    $html="";
    if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");}    
    $requeteC = "select * from message where pere_id = '".$message."' and pere_id != 0 order by message_id desc";
    if ($resultatC = $mysqli->query($requeteC)){
        reset($resultatC);
        while  ($ligneC = $resultatC->fetch_assoc()){
            $html .= "<div class='message juste reponse bgblanc'>";
            $html .= "<p class='bg3 c4 padding'>Réponse au message N°".$message."</p>";
            $html .= decode_bdd($ligneC["contenu"]);
            $requeteB = "select * from user where user_id = '".$ligneC["user_id"]."' limit 1";
            if ($resultatB = $mysqli->query($requeteB)){
                reset($resultatB);
                $ligneB = $resultatB->fetch_assoc();
                $html .= "<div class='droite cnoir marge'>";
                $html .= "".ucfirst($ligneB["pseudo"])." (".ucfirst($ligneB["prenom"])." ".strtoupper($ligneB["nom"]).")";
                $html .= "</div>";
                $html .= "<div class='droite cnoir marge'>";
                //$html .= icones_messages($_SESSION["user"]["id"],$ligneC["message_id"],$ligneC["message_id"],"droite",""); .
                $html .= icones_reponse_messages($_SESSION["user"]["id"],$ligneC["message_id"],$ligneC["pere_id"],"droite","");
                $html .= "</div>";
            }                        
            $html .= "</div>";
        }
    } 
    return $html;
    mysqli_close($mysqli); 
}

function censure_active($id){
        if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");}

        $requete = "select * from message where message_id = '".$id."'";
        $resultat = $mysqli->query($requete);
        reset($resultat);
        $ligne = $resultat->fetch_assoc();

        if(strstr(decode_bdd($ligne["contenu"]),"Message censur")){      
            return true;
        }else{
            return false;
        }
    mysqli_close($mysqli); 
}

function auteur($user){
    $html="";
    if(file_exists("inc_mysqli_connect.php")){include("inc_mysqli_connect.php");}
    $requeteB = "select * from user where user_id = '".$user."' limit 1";
    if ($resultatB = $mysqli->query($requeteB)){
        reset($resultatB);
        $ligneB = $resultatB->fetch_assoc();
        $html .= "<div class='droite marge'>";
        $html .= ucfirst($ligneB["pseudo"])." (".ucfirst($ligneB["prenom"])." ".strtoupper($ligneB["nom"]).")";
        $html .= "</div>";
    }   
    return $html;
    mysqli_close($mysqli); 
}

function icones_messages($user,$message,$align,$classe){
    $html="";
    $html .= "<div class='".$align." ".$classe." bg3 padding'>";
    $html .=  "<div class='lblock gauche padding cblanc'>&nbsp;Message N°".$message."</div>";
    
    if(administrateur($_SESSION["user"]["id"]) || moderateur($_SESSION["user"]["id"]) || ($_SESSION["user"]["id"]==$user)){
        
        $html .=  "<a class='marge' href='forum.php?editeur=1&reponse=".$message."'>";
        $html .=  "<img src='img/Data-Edit-128.png' alt='' title='Répondre' width='24' height='24' />";
        $html .=  "</a>";
        $html .=  "<a class='marge' href='sup_message_bdd.php?message_id=".$message."&user_id=".$user."&page=forum ' title='Supprimer'>";
        $html .=  "<img src='img/Close-128.png' alt='' title='Supprimer' width='24' height='24' />";
        $html .=  "</a>";
        if(administrateur($_SESSION["user"]["id"]) || moderateur($_SESSION["user"]["id"])){
            if (!censure_active($message)){
                $html .=  "<a class='marge' href='censure.php?censure=".$message."'>";
                $html .=  "<img src='img/Hand-04-128.png' alt='' title='Censurer' width='24' height='24' />";
                $html .=  "</a>";
            }
        }                 
    }   
    $html .=  "</div>";
    return $html;
}

function icones_reponse_messages($user,$message,$pere,$align,$classe){
    $html="";
    $html .= "<div class='".$align." ".$classe." bg3 padding'>";
    $html .=  "<div class='lblock gauche padding cblanc'>&nbsp;Message N°".$message."</div>";
    
    if(administrateur($_SESSION["user"]["id"]) || moderateur($_SESSION["user"]["id"]) || ($_SESSION["user"]["id"]==$user)){
        $html .=  "<a class='marge' href='forum.php?editeur=1&reponse=".$pere."'>";
        $html .=  "<img src='img/Data-Edit-128.png' alt='' title='Répondre' width='24' height='24' />";
        $html .=  "</a>";
        $html .=  "<a class='marge' href='sup_message_bdd.php?message_id=".$message."&user_id= ".$user."&page=forum ' title='Supprimer'>";
        $html .=  "<img src='img/Close-128.png' alt='' title='Supprimer' width='24' height='24' />";
        $html .=  "</a>";
    }

    if(administrateur($_SESSION["user"]["id"]) || moderateur($_SESSION["user"]["id"])){
        if (!censure_active($message)){
            $html .=  "<a class='marge' href='censure.php?censure=".$message."'>";
            $html .=  "<img src='img/Hand-04-128.png' alt='' title='Censurer' width='24' height='24' />";
            $html .=  "</a>";
        }
    }    
    $html .=  "</div>";
    return $html;
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
