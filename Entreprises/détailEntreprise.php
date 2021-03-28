<?php 
$page = "1";
require("../Nav/header.php");
?>

<!------------------------------------------------------------------------------------------------------------------------->

        <main>
            <?php
            function star($nb_star){
              for ($i = 1; $i <= 5; $i++) {
                  if($nb_star >= 1){?>
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                      <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                      </svg>
                      <?php
                      $nb_star = $nb_star-1;
                  }
                  else if($nb_star >= 0.5){?>
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-half" viewBox="0 0 16 16">
                      <path d="M5.354 5.119L7.538.792A.516.516 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.537.537 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.519.519 0 0 1-.146.05c-.341.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.171-.403.59.59 0 0 1 .084-.302.513.513 0 0 1 .37-.245l4.898-.696zM8 12.027c.08 0 .16.018.232.056l3.686 1.894-.694-3.957a.564.564 0 0 1 .163-.505l2.906-2.77-4.052-.576a.525.525 0 0 1-.393-.288L8.002 2.223 8 2.226v9.8z"/>
                      </svg>
                      <?php
                      $nb_star = $nb_star-0.5;
                  }
                  else{?>
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                      <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                      </svg>
                  <?php
                  }

              }
          }


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
                $test1 = 0;
                $test2 = 0;
                
                if(isset($_GET["searchNom"])){
                  $searchNom =  $_GET["searchNom"];
                  $searchLocalisation =  $_GET["searchLocalisation"];
                  $ID_entreprise =  $_GET["ID_entreprise"];                 
                  if($searchNom!= NULL && $searchLocalisation!= NULL){
                      $requete = "SELECT * FROM entreprise 
                      INNER JOIN travaille ON entreprise.ID_entreprise = travaille.ID_entreprise
                      INNER JOIN secteur ON travaille.ID_secteur = secteur.ID_secteur
                      LEFT JOIN offres_stages ON entreprise.ID_entreprise = offres_stages.ID_entreprise
                      LEFT JOIN evaluer ON evaluer.ID_entreprise = entreprise.ID_entreprise 
                      WHERE entreprise.Nom LIKE '$searchNom%' AND entreprise.Ville LIKE '$searchLocalisation%'
                      ORDER BY entreprise.Ville
                      DESC LIMIT 1";
                      $test1 = 1;
                      $reponse = $conn->query($requete);
                      while($donnees = $reponse->fetch())
                      {
                        if(isset($donnees['Ambiance'])){
                          $test2 = 1;
                          $requete = "SELECT AVG(`Ambiance`) AS avgAmbiance, AVG(`Accueil_entreprise`) AS avgAccueil_entreprise, 
                          AVG(`Accompagnement_etudiants`) AS avgAccompagnement_etudiants, AVG(`Taux_apprentissage`) AS avgTaux_apprentissage, 
                          `Nom`, `NB_stagiaires_CESI`, `Numero_rue`, `Rue`, `Ville`, `Code_postal`, `Pays`, `Secteur_activite`,
                          `Description`, `NB_place`, `Remuneration`, `Date_offre`, `Duree_stage`, entreprise.ID_entreprise 
                          FROM entreprise 
                          INNER JOIN travaille ON entreprise.ID_entreprise = travaille.ID_entreprise
                          INNER JOIN secteur On travaille.ID_secteur = secteur.ID_secteur
                          INNER JOIN evaluer ON evaluer.ID_entreprise = entreprise.ID_entreprise
                          LEFT JOIN offres_stages ON entreprise.ID_entreprise = offres_stages.ID_entreprise 
                          WHERE entreprise.Nom LIKE '$searchNom%' AND entreprise.Ville LIKE '$searchLocalisation%'
                          ORDER BY entreprise.Ville";
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
                    $requete2 = "SELECT * FROM entreprise 
                    LEFT JOIN evaluer ON evaluer.ID_entreprise = entreprise.ID_entreprise 
                    WHERE entreprise.Nom LIKE '$searchNom%' AND entreprise.Ville LIKE '$searchLocalisation%'
                    ORDER BY entreprise.Ville";
                    $reponse = $conn->query($requete2);
                    while($donnees = $reponse->fetch()){
                      if($ID_utilisateur == $donnees['ID_utilisateur']){
                        $vote = true;
                        break;
                      }
                      else{
                        $vote = false;
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
                          <?php star($Ambiance);?></br>
                          Accueil de l'entreprise : </br>
                          <?php star($Accueil_entreprise);?></br>
                          Accompagnement des étudiants : </br>
                          <?php star($Accompagnement_etudiants);?></br>
                          Taux d'apprentissage : </br>
                          <?php star($Taux_apprentissage);?></br>
                        </h3>
                        <?php

                        $send = "INSERT INTO evaluer(`ID_entreprise`, `ID_utilisateur`, `Ambiance`, `Accueil_entreprise`, `Accompagnement_etudiants`, `Taux_apprentissage`) 
                        VALUES('$ID_entreprise', $ID_utilisateur, $Ambiance, $Accueil_entreprise, $Accompagnement_etudiants, $Taux_apprentissage);";
                        $conn->exec($send);
                        $test2 = 1;
                        $requete = "SELECT AVG(`Ambiance`) AS avgAmbiance, AVG(`Accueil_entreprise`) AS avgAccueil_entreprise, 
                        AVG(`Accompagnement_etudiants`) AS avgAccompagnement_etudiants, AVG(`Taux_apprentissage`) AS avgTaux_apprentissage, 
                        `Nom`, `NB_stagiaires_CESI`, `Numero_rue`, `Rue`, `Ville`, `Code_postal`, `Pays`, `Secteur_activite`,
                        `Description`, `NB_place`, `Remuneration`, `Date_offre`, `Duree_stage`, entreprise.ID_entreprise 
                        FROM entreprise 
                        INNER JOIN travaille ON entreprise.ID_entreprise = travaille.ID_entreprise
                        INNER JOIN secteur On travaille.ID_secteur = secteur.ID_secteur
                        INNER JOIN evaluer ON evaluer.ID_entreprise = entreprise.ID_entreprise
                        LEFT JOIN offres_stages ON entreprise.ID_entreprise = offres_stages.ID_entreprise 
                        WHERE entreprise.Nom LIKE '$searchNom%' AND entreprise.Ville LIKE '$searchLocalisation%'
                        ORDER BY entreprise.Ville";
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
                          $requete = "SELECT * FROM entreprise 
                          RIGHT JOIN offres_stages ON entreprise.ID_entreprise = offres_stages.ID_entreprise
                          WHERE entreprise.Nom LIKE '$searchNom%' AND entreprise.Ville LIKE '$searchLocalisation%'
                          ORDER BY entreprise.Ville";
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
                }
                ?>
          </main>
<!------------------------------------------------------------------------------------------------------------------------->
        
<?php require("../Nav/footer.php"); ?>