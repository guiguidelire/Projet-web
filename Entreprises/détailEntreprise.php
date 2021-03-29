<?php

require 'ModeleDétail.php';

try {
    require 'vueDétailEntreprise.php';
}
catch (Exception $e) {
  $msgErreur = $e->getMessage();
  require("./vueErreur.php");
} 