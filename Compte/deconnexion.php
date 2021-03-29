<?php 
require("../Assets/ConnexionBDD.php");//$conn : connexion bdd
setcookie('Login', '', 1,"/");
setcookie('ID_utilisateur', '', 1,"/");
setcookie('Fonction', '', 1,"/");
  
$page = "deconnexion";
require("../Nav/header.php");
?>

<!------------------------------------------------------------------------------------------------------------------------->

        <main>
            <div class="container">
                <p> Vous venez de vous deconnecter.</p>
                <meta http-equiv="refresh" content="0;URL=monCompte.php">
            </div>
          </main>
<!------------------------------------------------------------------------------------------------------------------------->

<?php require("../Nav/footer.php"); ?>