<?php 
$page = "rechercheroffre";
require("../Nav/header.php");
?>

<!------------------------------------------------------------------------------------------------------------------------->

        <main>
            <?php
            $servername = 'localhost';
            $username = 'root';
            $password = '';
            
            try{
                $conn = new PDO("mysql:host=$servername;dbname=bdd_cesi_stage", $username, $password);
                //On définit le mode d'erreur de PDO sur Exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //echo 'Connexion réussie <br> <br>';
            }

            //On capture les exceptions si une exception est lancée et on affiche
            //les informations relatives à celle-ci
            catch(PDOException $e){
                echo "Erreur : " . $e->getMessage() . "<br>";
            }
                    
            ?>
            <div class="rechercheStage">
                <form class="form-horizontal" action="./rechercheOffre.php" method="post">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="searchCompetence">Compétence :</label>
                        <div class="col-sm-9">
                        <input type="texte" class="form-control" id="searchCompetence" name="searchCompetence" placeholder="Entrer une competence">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="searchLocalisation">Localisation :</label>
                        <div class="col-sm-9">
                        <input type="texte" class="form-control" id="searchLocalisation" name="searchLocalisation" placeholder="Entrer une localisation">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="searchSecteur">Secteur d'activité de l'entrprise :</label>
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
                $requete =" SELECT entreprise.Nom, offres_stages.Description, secteur.Secteur_activite, entreprise.Ville
                FROM offres_stages 
                INNER JOIN entreprise ON offres_stages.ID_entreprise = entreprise.ID_entreprise 
                INNER JOIN travaille ON travaille.ID_entreprise = entreprise.ID_entreprise 
                INNER JOIN secteur ON travaille.ID_secteur = secteur.ID_secteur 
                INNER JOIN necessite ON offres_stages.ID_offre = necessite.ID_offre
                INNER JOIN competences ON necessite.ID_competences = competences.ID_competences";

                if(isset($_POST["searchCompetence"]) || isset($_POST["searchLocalisation"]) || isset($_POST["searchSecteur"])){
                    $searchCompetence =  $_POST["searchCompetence"];
                    $searchLocalisation =  $_POST["searchLocalisation"];
                    $searchSecteur =  $_POST["searchSecteur"];
                
                    $test = 0;
                    if($searchSecteur != NULL || $searchLocalisation!= NULL || $searchCompetence!= NULL){
                        $requete =" $requete WHERE";
                        if($searchSecteur != NULL){
                            $requete =" $requete secteur.Secteur_activite LIKE '$searchSecteur%'";
                            $test = 1;
                        }
                        if($searchLocalisation!= NULL){
                            if($test == 1){
                                $requete = " $requete AND";
                            }
                            $requete = " $requete entreprise.Ville LIKE '$searchLocalisation%'";
                            $test =1;
                        }
                        if($searchCompetence!= NULL){
                            if($test == 1){
                                $requete = " $requete AND";
                            }
                            $requete = " $requete competences.Competences LIKE '$searchCompetence%'";
                        }
                        $requete = " $requete GROUP BY offres_stages.ID_offre";
                    }
                }
                else{ 
                    $requete =" SELECT entreprise.Nom, offres_stages.Description, entreprise.Ville, offres_stages.ID_offre 
                                FROM offres_stages 
                                INNER JOIN entreprise ON offres_stages.ID_entreprise = entreprise.ID_entreprise 
                                ORDER BY ID_offre 
                                DESC LIMIT 12";
                }
                $reponse = $conn->query($requete);
                while($donnees = $reponse->fetch()){?>
                <div class="col-lg-4 col-md-6 col-sm-12" >
                    <h3> <?php echo $donnees['Nom'];?></h3>
                    <h4> <?php echo $donnees['Ville'];?></h4>
                    <p><?php echo $donnees['Description'];?><p>
                    <a href="../OffresDeStage/détailOffre.php?searchNom=<?php echo $donnees['Nom'];?>&searchLocalisation=<?php echo $donnees['Ville'];?>&ID_offre=<?php echo $donnees['ID_offre'];?>"><button>En savoir plus</button></a>
                </div>
                <?php 
                    }
                    $reponse->closeCursor(); // Termine le traitement de la requête
                ?>
          </main>
<!------------------------------------------------------------------------------------------------------------------------->

<?php require("../Nav/footer.php"); ?>