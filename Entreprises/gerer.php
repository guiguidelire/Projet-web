<?php

require 'ModeleDétail.php';

try {
    if(!isset($_COOKIE['ID_utilisateur'])){
        throw new Exception("NonConnecte");
    }
    else{
        if($_COOKIE['Fonction']==1 || $_COOKIE['Fonction']==3){
            throw new Exception("NonDroit");
        }
        else
            require 'vueDétailEntreprise.php';
    }
}catch (Exception $e) {
  $msgErreur = $e->getMessage();
  require("./vueErreur.php");
}
?>