<?php

require 'ModeleRechercher.php';

try{
     require 'vueRechercher.php';
}catch (Exception $e) {
  $msgErreur = $e->getMessage();
  require("./vueErreur.php");
}
?>