<?php 
$title = "CESI Stage - Détails de l'Entreprise";
 
$page = "1";

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
                        <button type="submit">Rechercher</button>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="row">
                <?php 
                $test1 = 0;
                $test2 = 0;
                
                if(isset($_GET["searchNom"])){
                    $details = new detail($_GET["searchNom"],$_GET["searchLocalisation"],$_GET["ID_entreprise"]);   
                    $conn = $details->_getBdd();
                    //$conn : connexion bdd          
                    if($details->_getSearchName()!= NULL && $details->_getSearchPlace()!= NULL){
                        $requete = $details->_Recherche();
                        $reponse = $conn->query($requete);
                        $test1 = 1;
                        while($donnees = $reponse->fetch()){
                            if(isset($donnees['Ambiance'])){
                                $test2 = 1;
                                $requete = $details->_Moyenne();
                            }
                        }
                    }
                } 

                if($test1 == 1){
                  ?>
                    <form class="form-horizontal" action="./détailEntreprise.php?searchNom=<?php echo $details->_getSearchName();?>&searchLocalisation=<?php echo $details->_getSearchPlace();?>&ID_entreprise=<?php echo $details->_getSearchID();?>&submit=1" method="post">
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
                          <button type="submit">Valider</button>
                        </div>
                      </div>
                    </form>
                  <div class="col-lg-12 col-md-12 col-sm-12">

                  <?php
                  if(isset($_COOKIE['ID_utilisateur'])){
                    $ID_utilisateur = $_COOKIE['ID_utilisateur'];
                    $vote = $details->_Vote($conn, $ID_utilisateur);
                    $ID_entreprise = $details->_getSearchID();
                    if($_COOKIE['Fonction']==1 || $_COOKIE['Fonction']==3){?>
                      <form class="form-horizontal" method="post">
                        <div class="form-group">
                          <input type="hidden" name="delete" value="true">
                          <div class="col-sm-12">
                            <button type="submit">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                              </svg>
                              Supprimer cette entreprise
                            </button>
                          </div>
                        </div>
                      </form>
                      <?php
                      if(isset($_POST['delete'])){
                        echo "bonjour";
                          if($_POST['delete']==true){
                            $ID_entreprise = $_GET['ID_entreprise'];
                            $requete = "SELECT ID_offre FROM offres_stages WHERE ID_entreprise = $ID_entreprise";
                            $reponse = $conn->query($requete);
                            while($donnees = $reponse->fetch()){
                              $ID_offre = $donnees['ID_offre'];
                              $requete = "DELETE FROM postuler WHERE ID_offre = $ID_offre;
                              DELETE FROM wish_list WHERE ID_offre = $ID_offre;
                              DELETE FROM concerne WHERE ID_offre = $ID_offre;
                              DELETE FROM necessite WHERE ID_offre = $ID_offre;
                              DELETE FROM offres_stages WHERE ID_offre = $ID_offre;";
                              $conn->exec($requete);
                            }
                            $requete = "DELETE FROM travaille WHERE ID_entreprise = $ID_entreprise;
                            DELETE FROM evaluer WHERE ID_entreprise = $ID_entreprise;
                            DELETE FROM offres_stages WHERE ID_entreprise = $ID_entreprise;
                            DELETE FROM entreprise WHERE ID_entreprise = $ID_entreprise;";
                            $conn->exec($requete);
                            ?> 
                              <meta http-equiv="refresh" content="0;URL=rechercher.php">
                            <?php
                          }
                        }
                      }
                    
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
                          <?php $details->_star($Ambiance);?></br>
                          Accueil de l'entreprise : </br>
                          <?php $details->_star($Accueil_entreprise);?></br>
                          Accompagnement des étudiants : </br>
                          <?php $details->_star($Accompagnement_etudiants);?></br>
                          Taux d'apprentissage : </br>
                          <?php $details->_star($Taux_apprentissage);?></br>
                        </h3>
                        <?php

                        $details->_InsertInto($ID_utilisateur, $Ambiance, $Accueil_entreprise, $Accompagnement_etudiants, $Taux_apprentissage, $conn);
                        $test2 = 1;
                        $requete = $details->_Moyenne();
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
                            <div class="col-lg-6 col-md-6 col-sm-12">
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
                                      <?php $details->_star($donnees['avgAmbiance']);?></br>
                                      Accueil de l'entreprise : </br>
                                      <?php $details->_star($donnees['avgAccueil_entreprise']);?></br>
                                      Accompagnement des étudiants : </br>
                                      <?php $details->_star($donnees['avgAccompagnement_etudiants']);?></br>
                                      Taux d'apprentissage : </br>
                                      <?php $details->_star($donnees['avgTaux_apprentissage']);?></br>
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
                          $reponse = $details->_ListeEntreprise($conn);
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