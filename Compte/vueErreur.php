<?php $title = 'CESI Stage - Erreur'; ?>
<?php $page = 'Erreur'; ?>

<?php ob_start() ;?>
<!--Droit d'acces refusé a la page---------------------------------------------->
    <?php if($msgErreur=="NonDroit"){

        $title = 'CESI Stage - Acces Refusé'; ?>

        <main>
            <div class= "container">
                <p>Vous n'avez pas le droit de vous connecter à cette page.</p>
            </div>
        </main>
<!--Non connecté---------------------------------------------------------------->
<?php }else if($msgErreur=="NonConnecte"){

    $title = 'CESI Stage - Non Connecté'; ?>

    <main>
        <div class= "container">
            <h1>Veuillez vous connecter en temps qu'admistrateur ou tuteur pour accéder à cette page.</h1>
            <a href="../Compte/moncompte.php"><button>Connexion</button></a>
        </div>
    </main>

<!--Autre erreur---------------------------------------------------------------->
<?php }else{

    $title = 'CESI Stage - Erreur'; ?>

    <main>
        <div class= "container">
            <h1>Il semblerait qu'une erreur ait eu lieu !</h1>
        </div>
    </main>

<?php } ?>

<?php $contenu = ob_get_clean(); ?>

<?php require("../gabarit.php"); ?>