<?php require ("./libs/Smarty.class.php");
    $title = "titre de la page";
    $tab = array("Rivendell","Mirko","Fangorn","Lorien");


    $smarty = new Smarty;

    $smarty->assign('titre', $title);
    $smarty->assign('tableau', $tab);
    $smarty->display('./tpl/index.tpl');

?>
