<?php 
$title = "CESI Stage - Détails de l'Entreprise";
//$conn : connexion bdd  
$page = "1";
$conn = getBdd();
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
                $test1 = 0;
                $test2 = 0;
                
                if(isset($_GET["searchNom"])){
                    $searchNom =  $_GET["searchNom"];
                    $searchLocalisation =  $_GET["searchLocalisation"];
                    $ID_entreprise =  $_GET["ID_entreprise"];                 
                    if($searchNom!= NULL && $searchLocalisation!= NULL){
                        $requete = recherche($searchNom, $searchLocalisation);
                        $reponse = $conn->query($requete);
                        $test1 = 1;
                        while($donnees = $reponse->fetch()){
                            if(isset($donnees['Ambiance'])){
                                $test2 = 1;
                                $requete = Moyenne($searchNom,$searchLocalisation);
                            }
                        }
                    }
                } 

                if($test1 == 1){
                  ?>
                    <form class="form-horizontal" action="./détailEntreprise.php?searchNom=<?php echo $searchNom;?>&searchLocalisation=<?php echo $searchLocalisation;?>&ID_entreprise=<?php echo $ID_entreprise;?>&submit=1" method="post">
                      <div class="form-group">
                        <h1 class="col-lg-12 col-md-12 col-sm-12">Evaluer</h1>
                        <label class="control-label col-lg-2 col-md-3 col-sm-5" for="Range: 5">Ambiance</label>
                        <div class="col-lg-4 col-md-3 col-sm-6">
                            <input type="range" class="custom-range" min="0" max="5" id="customRange" name="Ambiance">
                        </div>
                    
                        <label class="control-label col-lg-2 col-md-3 col-sm-5" for="Range: 5">Acueil de l'entreprise</label>
                        <div class="col-lg-4 col-md-3 col-sm-6">
                            <input type="range" class="custom-range" min="0" max="5" id="customRange" name="Accueil_entreprise">
                        </div>

                        <label class="control-label col-lg-2 col-md-3 col-sm-5" for="Range: 5">Accompagnement des étudiants</label>
                        <div class="col-lg-4 col-md-3 col-sm-6">
                            <input type="range" class="custom-range" min="0" max="5" id="customRange" name="Accompagnement_etudiants">
                        </div>

                        <label class="control-label col-lg-2 col-md-3 col-sm-5" for="Range: 5">Taux d'apprentissage</label>
                        <div class="col-lg-4 col-md-3 col-sm-6">
                            <input type="range" class="custom-range" min="0" max="5" id="customRange" name="Taux_apprentissage">
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-default">Valider</button>
                        </div>
                      </div>
                    </form>
                  <div class="col-lg-12 col-md-12 col-sm-12">

                  <?php
                  if(isset($_COOKIE['ID_utilisateur'])){
                    $ID_utilisateur = $_COOKIE['ID_utilisateur'];
                    $vote = vote($searchNom, $searchLocalisation, $conn, $ID_utilisateur);
                    
                    if($vote == false){
                      if(isset($_GET["submit"])){
                        $Ambiance =  $_POST["Ambiance"];
                        $Accueil_entreprise =  $_POST["Accueil_entreprise"];
                        $Accompagnement_etudiants =  $_POST["Accompagnement_etudiants"];
                        $Taux_apprentissage =  $_POST["Taux_apprentissage"];
                        ?>
                        <h1>Votre note à été prise en compte : </h1>
                        <h3>
                          L'ambiance : </br>
                          <?php star($Ambiance);?></br>
                          Accueil de l'entreprise : </br>
                          <?php star($Accueil_entreprise);?></br>
                          Accompagnement des étudiants : </br>
                          <?php star($Accompagnement_etudiants);?></br>
                          Taux d'apprentissage : </br>
                          <?php star($Taux_apprentissage);?></br>
                        </h3>
                        <?php

                        InsertInto($ID_entreprise, $ID_utilisateur, $Ambiance, $Accueil_entreprise, $Accompagnement_etudiants, $Taux_apprentissage, $conn);
                        $test2 = 1;
                        $requete = Moyenne($searchNom, $searchLocalisation);
                      }
                    }
                    else{
                      if(isset($_GET["submit"])){
                        ?>
                        <h1>Vous avez déja évalué cette entreprise</h1>
                        <?php
                      }
                    }
                  }
                  else{
                    ?>
                    <h1>Veuillez vous connecter pour noter cette entreprise</h1>
                    <h3>
                    <?php
                  }
                    ?>
                  </div>
                    <?php
                    $reponse = $conn->query($requete);
                    while($donnees = $reponse->fetch()){?>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="col-lg-6 col-md-6 col-sm-12" >
                                <h1> <?php echo $donnees['Nom'];?></h1>
                                <h4>
                                    Secteur : 
                                    <?php echo $donnees['Secteur_activite'];?>
                                </h4>
                                <h4>
                                    <?php echo $donnees['Numero_rue'];?>, 
                                    <?php echo $donnees['Rue'];?></br>
                                    <?php echo $donnees['Code_postal'];?>
                                    <?php echo $donnees['Ville'];?>,
                                    <?php echo $donnees['Pays'];?>
                                </h4>
                                <h5>
                                    Nombre de stagière CESI déjà accepté : 
                                    <?php echo $donnees['NB_stagiaires_CESI'];?>  
                                </h5>

                            </div>
                            <?php
                            if($test2 == 1){
                              ?>
                                <div class="col-lg-6 col-md-6 col-sm-12" >
                                  <h1>Les notes</h1>
                                  <h3>
                                      L'ambiance : </br>
                                      <?php star($donnees['avgAmbiance']);?></br>
                                      Accueil de l'entreprise : </br>
                                      <?php star($donnees['avgAccueil_entreprise']);?></br>
                                      Accompagnement des étudiants : </br>
                                      <?php star($donnees['avgAccompagnement_etudiants']);?></br>
                                      Taux d'apprentissage : </br>
                                      <?php star($donnees['avgTaux_apprentissage']);?></br>
                                  </h3>
                                </div>
                              <?php
                            }
                            else{
                              ?>
                                <div class="col-lg-6 col-md-6 col-sm-12" >
                                  <h1>Les notes</h1>
                                  <h3>
                                      L'entreprise n'a pas encore été noté
                                  </h3>
                                </div>
                                <?php

                            }
                            ?>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                              <h1>Les stages proposés</h1>
                            </div>
                            <?php 
                          }
                          $reponse = ListeEntreprise($searchNom, $searchLocalisation, $conn);
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
                }
                ?>
          </main>
<!------------------------------------------------------------------------------------------------------------------------->
        
<?php $contenu = ob_get_clean(); ?>

<?php require("../gabarit.php"); ?>