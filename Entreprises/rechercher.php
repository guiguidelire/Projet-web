<!DOCTYPE html>
<html>
    <head>
        <title>CESI STAGE</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link href="../Assets/Styles/style.css" rel="stylesheet">
        
    </head>
    <body>
        <header>
            <nav class="navbar navbar-inverse navbar-fixed-top"> 
                <div class="container-fluid">
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="../index.php">CESI Stage</a>
                  </div>
                  <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                      
                      <li><a href="../index.php">Accueil</a></li>
                      
                      <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Offres de stage
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="../OffresDeStage/rechercheOffre.php">Rechercher</a></li>
                          <li><a href="../OffresDeStage/création.php">Création</a></li>
                        </ul>
                      </li>
                      
                      <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Entreprise
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li class="active"><a href="../Entreprises/rechercher.php">Rechercher</a></li>
                          <li><a href="../Entreprises/gerer.php">Gerer</a></li>
                        </ul>
                      </li>
                      
                      
                      <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Compte
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="../Compte/monCompte.php">Mon Compte</a></li>
                          <li><a href="../Compte/deconnexion.php">Deconnexion</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                </div>
              </nav>
        </header>
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

            
            /*$array = [[],[]];
            while($donnees = $reponse->fetch()){
                $array[0][]=$donnees['Nom'];
                $array[1][]=$donnees['Description'];
                echo $array[1][0];
            }*/
                    
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
                          `Description`, `NB_place`, `Remuneration`, `Date_offre`, `Duree_stage` 
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
                    <form class="form-horizontal" action="./rechercher.php?searchNom=<?php echo $searchNom;?>&searchLocalisation=<?php echo $searchLocalisation;?>&submit=1" method="post">
                    <div class="form-group">
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
                              <button>En savoir plus</button>
                          </div>
                          <?php 
                          }
                          $reponse->closeCursor(); // Termine le traitement de la requête
                }
                else{
                $requete =" SELECT entreprise.Nom, secteur.Secteur_activite, entreprise.Ville
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
                    $requete =" SELECT Nom, Secteur_activite, entreprise.Ville
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
                    <a href="../Entreprises/rechercher.php?searchNom=<?php echo $donnees['Nom'];?>&searchLocalisation=<?php echo $donnees['Ville'];?>"><button>En savoir plus</button></a>
                </div>
                <?php 
                    }
                    $reponse->closeCursor(); // Termine le traitement de la requête   
                }
                ?>
          </main>
<!------------------------------------------------------------------------------------------------------------------------->
        <footer class="text-center text-lg-start">
          <div class="container p-4">
            <div class="row">
              <div class="col-lg-4 col-md-6 col-sm-12">
                <h5 class="text-uppercase">Localisation</h5>

                <p>
                Parc Club des Tanneries,</br>
                2 Allée des Foulons,</br>
                67380 Strasbourg Lingolsheim</br>
                </p>
              </div>

              <div class="col-lg-4 col-md-6 col-sm-12">
                <h5 class="text-uppercase">Contactez nous</h5>
                <p>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                    <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                  </svg>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                  </svg>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                    <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/>
                  </svg>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
                    <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"/>
                  </svg>
                </p>
              </div>

              <div class="col-lg-4 col-md-6 col-sm-12">
                <h5 class="text-uppercase">Liens Pratiques</h5>
                <ul class="list-unstyled">
                  <li>
                    <a href="https://wayf.cesi.fr/login" class="text-dark">Ent CESI</a>
                  </li>
                  <li>
                    <a href="https://www.cesi.fr/" class="text-dark">CESI.fr</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </footer>
    </body>
</html>