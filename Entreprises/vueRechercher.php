<?php 
$title = "CESI Stage - Recherche entreprise";
 
$page = "rechercherentreprise";
ob_start(); ?>

<!------------------------------------------------------------------------------------------------------------------------->

    <main>
        <div class="rechercheStage">
            <form class="form-horizontal" action="./rechercher.php" method="post">
            <h1 class="col-lg-12 col-md-12 col-sm-12">Rechercher</h1>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="searchNom">Nom de l'entreprise:</label>
                    <div class="col-sm-9">
                    <input type="texte" class="form-control" id="searchNom" name="searchNom" placeholder="Entrer une nom">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="searchLocalisation">Localisation :</label>
                    <div class="col-sm-9">
                    <input type="texte" class="form-control" id="searchLocalisation" name="searchLocalisation" placeholder="Entrer une localisation">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="searchSecteur">Secteur d'activité de l'entreprise :</label>
                    <div class="col-sm-9">
                    <input type="texte" class="form-control" id="searchSecteur" name="searchSecteur" placeholder="Entrer un secteur d'activité">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Rechercher</button>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="row">
            <?php 
            
            if(isset($_POST["searchNom"]) || isset($_POST["searchLocalisation"]) || isset($_POST["searchSecteur"])){
                $recherche = new recherche($_POST["searchNom"],$_POST["searchLocalisation"],$_POST["searchSecteur"]);
                $conn = $recherche->_getBdd();
                //$conn : connexion bdd 
                $reponse = $recherche->_requeteRecherche($conn);
            }else{
                $recherche = new recherche('','',''); 
                $conn = $recherche->_getBdd();
                //$conn : connexion bdd 
                $reponse = $recherche->_requeteTouteEntreprises($conn);
            }
            
            while($donnees = $reponse->fetch()){?>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <h3> <?php echo $donnees['Nom'];?></h3>
                <h4> <?php echo $donnees['Ville'];?></h4>
                <p> <?php echo $donnees['Secteur_activite'];?><p>
                <a href="../Entreprises/détailEntreprise.php?searchNom=<?php echo $donnees['Nom'];?>&searchLocalisation=<?php echo $donnees['Ville'];?>&ID_entreprise=<?php echo $donnees['ID_entreprise'];?>"><button>En savoir plus</button></a>
            </div>
            <?php 
                }
                $reponse->closeCursor(); // Termine le traitement de la requête   
            ?>
        </div>
    </main>
<!------------------------------------------------------------------------------------------------------------------------->

<?php $contenu = ob_get_clean(); ?>

<?php require("../gabarit.php"); ?>