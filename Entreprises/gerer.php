<?php

require 'ModeleDétail.php';

try {
    if(!isset($_COOKIE['ID_utilisateur'])){
        throw new Exception("NonConnecte");
    }
    else{
        if($_COOKIE['Fonction']==2 || $_COOKIE['Fonction']==4){
            throw new Exception("NonDroit");
        }
        else
            require 'vueGerer.php';
    }
}catch (Exception $e) {
  $msgErreur = $e->getMessage();
  require("./vueErreur.php");
}
?>