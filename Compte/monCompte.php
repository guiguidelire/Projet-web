<?php
require("../Assets/ConnexionBDD.php");//$conn : connexion bdd  
if(isset($_POST['Login'])){
    $LoginCheck = false;
    $MDPCheck = false;
    $requeteLogin =" SELECT ID_utilisateur,`Login`, mdp, ID_fonction 
                FROM utilisateur;";
    $reponseLogin = $conn->query($requeteLogin);
    
    while($donneesLogin = $reponseLogin->fetch()){
        if($donneesLogin['Login']== $_POST['Login']){
            $LoginCheck = true;
            if($donneesLogin['mdp']== crypt($_POST['motDePasse'], 'rl')){
                $MDPCheck = true;
                $IDFonction = $donneesLogin['ID_fonction'];
                setcookie('Login', $_POST['Login'],time()+300,'/');
                setcookie('ID_utilisateur',$donneesLogin['ID_utilisateur'],time()+300,'/');
                setcookie('Fonction',$IDFonction,time()+300,'/');
            }
        }
    }
}
?>

<?php 
$page = "moncompte";
require("./POO.php");
require("../Nav/header.php");
?>

<!------------------------------------------------------------------------------------------------------------------------->

        <main>            
            <?php            
            if(isset($_COOKIE['Login'])){
                $ID_utilisateur = $_COOKIE['ID_utilisateur'];

                ?>
                <div class="container"> 
                    <h1>information utilisateur</h1>
                <?php
                $requete =" SELECT * FROM utilisateur    
                INNER JOIN role ON utilisateur.ID_fonction = role.ID_fonction
                INNER JOIN centre ON utilisateur.ID_centre = centre.ID_centre
                INNER JOIN promotion ON utilisateur.ID_promotion = promotion.ID_promotion
                WHERE ID_utilisateur = $ID_utilisateur";                    

                $reponse = $conn->query($requete);
                while($donnees = $reponse->fetch()){?>
                    <h3> <?php echo $donnees['Nom'];?> <?php echo $donnees['Prenom'];?></h3>
                    <h4> <?php echo $donnees['Nom_centre'];?></h4>
                    <h4> <?php echo $donnees['Promotion'];?></h4>
                    <p><?php echo $donnees['Fonction'];?><p>
                <?php
                }
                ?>
                </div>   

                <div class="col-lg-12 col-md-12 col-sm-12"> 
                    <h1 class="col-lg-12 col-md-12 col-sm-12">Liste de souhait</h1>
                </div>
                <?php
                $requete =" SELECT entreprise.Nom, offres_stages.Description, entreprise.Ville, offres_stages.ID_offre
                FROM offres_stages 
                INNER JOIN entreprise ON offres_stages.ID_entreprise = entreprise.ID_entreprise 
                INNER JOIN wish_list ON offres_stages.ID_offre = wish_list.ID_offre
                WHERE wish_list.ID_utilisateur = $ID_utilisateur";                    

                $reponse = $conn->query($requete);
                while($donnees = $reponse->fetch()){?>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <h3> <?php echo $donnees['Nom'];?></h3>
                    <h4> <?php echo $donnees['Ville'];?></h4>
                    <p><?php echo $donnees['Description'];?><p>
                    <a href="../OffresDeStage/détailOffre.php?searchNom=<?php echo $donnees['Nom'];?>&searchLocalisation=<?php echo $donnees['Ville'];?>&ID_offre=<?php echo $donnees['ID_offre'];?>"><button>En savoir plus</button></a>
                </div>
                <?php
                }
                ?>
                <div class="col-lg-12 col-md-12 col-sm-12"> 
                    <h1 class="col-lg-12 col-md-12 col-sm-12">Candidature</h1>
                </div>
                <?php
                $requete =" SELECT entreprise.Nom, offres_stages.Description, entreprise.Ville, offres_stages.ID_offre
                FROM offres_stages 
                INNER JOIN entreprise ON offres_stages.ID_entreprise = entreprise.ID_entreprise 
                INNER JOIN postuler ON offres_stages.ID_offre = postuler.ID_offre
                WHERE postuler.ID_utilisateur = $ID_utilisateur";                    

                $reponse = $conn->query($requete);
                while($donnees = $reponse->fetch()){?>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <h3> <?php echo $donnees['Nom'];?></h3>
                    <h4> <?php echo $donnees['Ville'];?></h4>
                    <p><?php echo $donnees['Description'];?><p>
                    <a href="../OffresDeStage/détailOffre.php?searchNom=<?php echo $donnees['Nom'];?>&searchLocalisation=<?php echo $donnees['Ville'];?>&ID_offre=<?php echo $donnees['ID_offre'];?>"><button>En savoir plus</button></a>
                </div>
                <?php 
                }
            }
            else if(isset($_POST['Login'])){
                if(!$MDPCheck){
                    if(!$LoginCheck){
                        ?><h2 class="col-lg-12 col-md-12 col-sm-12"> Le Login n'est pas valide ! </h2> <?php
                    }else{
                        ?><h2 class="col-lg-12 col-md-12 col-sm-12"> Le mot de passe n'est pas valide ! </h2> <?php
                    }
                }else if($MDPCheck && $LoginCheck){
                    ?><h2 class="col-lg-12 col-md-12 col-sm-12"> Felecitation vous voila connecté ! </h2> <?php
                }
            }else{ ?>
            <div class="container">
                <form class="form-horizontal" action="./monCompte.php" method="post">
                    <br>
                    <div class="row">
                        <div class="form-group ">
                            <label class="control-label col-sm-2 col-sm-offset-3" for="Login">Login :</label>
                            <div class="col-sm-3">
                                <input type="texte" class="form-control" id="Login" name="Login" placeholder="Entrer votre Login" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group ">
                            <label class="control-label col-sm-2 col-sm-offset-3" for="motDePasse">Password :</label>
                            <div class="col-sm-3">
                                <input type="password" class="form-control" id="motDePasse" name="motDePasse" placeholder="Entrer votre password" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class=" col-lg-1 col-md-1 col-sm-offset-5 col-sm-1">
                                <button type="submit">Connexion</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <?php
            }
            ?>
          </main>
<!------------------------------------------------------------------------------------------------------------------------->

<?php require("../Nav/footer.php"); ?>