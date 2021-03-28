<?php 
$page = "rechercherentreprise";
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
                $requete =" SELECT entreprise.Nom, secteur.Secteur_activite, entreprise.Ville, entreprise.ID_entreprise
                FROM entreprise
                INNER JOIN travaille ON travaille.ID_entreprise = entreprise.ID_entreprise 
                INNER JOIN secteur ON travaille.ID_secteur = secteur.ID_secteur";

                if(isset($_POST["searchNom"]) || isset($_POST["searchLocalisation"]) || isset($_POST["searchSecteur"])){
                    $searchNom =  $_POST["searchNom"];
                    $searchLocalisation =  $_POST["searchLocalisation"];
                    $searchSecteur =  $_POST["searchSecteur"];
                
                    $test = 0;
                    if($searchSecteur != NULL || $searchLocalisation!= NULL || $searchNom!= NULL){
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
                        if($searchNom!= NULL){
                            if($test == 1){
                                $requete = " $requete AND";
                            }
                            $requete = " $requete entreprise.Nom LIKE '$searchNom%'";
                        }
                        $requete = " $requete GROUP BY entreprise.Ville";
                    }
                }
                else{ 
                    $requete =" SELECT Nom, Secteur_activite, entreprise.Ville, entreprise.ID_entreprise
                                FROM entreprise
                                INNER JOIN travaille ON travaille.ID_entreprise = entreprise.ID_entreprise 
                                INNER JOIN secteur ON travaille.ID_secteur = secteur.ID_secteur 
                                ORDER BY entreprise.Ville
                                DESC LIMIT 12";
                }
                $reponse = $conn->query($requete);
                while($donnees = $reponse->fetch()){?>
                <div class="col-lg-4 col-md-6 col-sm-12" >
                    <h3> <?php echo $donnees['Nom'];?></h3>
                    <h4> <?php echo $donnees['Ville'];?></h4>
                    <p> <?php echo $donnees['Secteur_activite'];?><p>
                    <a href="../Entreprises/détailEntreprise.php?searchNom=<?php echo $donnees['Nom'];?>&searchLocalisation=<?php echo $donnees['Ville'];?>&ID_entreprise=<?php echo $donnees['ID_entreprise'];?>"><button>En savoir plus</button></a>
                </div>
                <?php 
                    }
                    $reponse->closeCursor(); // Termine le traitement de la requête   
                ?>
          </main>
<!------------------------------------------------------------------------------------------------------------------------->

<?php require("../Nav/footer.php"); ?>