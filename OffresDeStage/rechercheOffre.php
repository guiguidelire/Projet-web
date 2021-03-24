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
                    <a class="navbar-brand" href="#">CESI Stage</a>
                  </div>
                  <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                      
                      <li class="active"><a href="#">Accueil</a></li>
                      
                      <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Offres de stage
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="./rechercheOffre.php">Rechercher</a></li>
                          <li><a href="#">Création</a></li>
                        </ul>
                      </li>
                      
                      <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Entreprise
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="#">Rechercher</a></li>
                          <li><a href="#">Gerer</a></li>
                          <li><a href="#">Evalution</a></li>
                        </ul>
                      </li>
                      
                      
                      <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Compte
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="#">Mon Compte</a></li>
                          <li><a href="#">Deconnexion</a></li>
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
                /*if(isset($_POST["searchSecteur"])){
                    $searchCompetence =  $_POST["searchCompetence"];
                    $searchLocalisation =  $_POST["searchLocalisation"];
                    $searchSecteur =  $_POST["searchSecteur"];
                    $requete =" SELECT entreprise.Nom, offres_stages.Description, secteur.Secteur_activite
                                FROM offres_stages 
                                INNER JOIN entreprise ON offres_stages.ID_entreprise = entreprise.ID_entreprise 
                                INNER JOIN travaille ON travaille.ID_entreprise = entreprise.ID_entreprise 
                                INNER JOIN secteur ON travaille.ID_secteur = secteur.ID_secteur 
                                INNER JOIN necessite ON offres_stages.ID_offre = necessite.ID_offre
                                INNER JOIN competences ON necessite.ID_competences = competences.ID_competences
                                WHERE secteur.Secteur_activite ='$searchSecteur' 
                                AND  entreprise.Ville='$searchLocalisation'
                                AND competences.Competences='$searchCompetence'
                                ORDER BY offres_stages.ID_offre";*/
   
                $requete =" SELECT entreprise.Nom, offres_stages.Description, secteur.Secteur_activite
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
                            $requete =" $requete secteur.Secteur_activite ='$searchSecteur'";
                            $test = 1;
                        }
                        if($searchLocalisation!= NULL){
                            if($test == 1){
                                $requete = " $requete AND";
                            }
                            $requete = " $requete entreprise.Ville='$searchLocalisation'";
                            $test =1;
                        }
                        if($searchCompetence!= NULL){
                            if($test == 1){
                                $requete = " $requete AND";
                            }
                            $requete = " $requete competences.Competences='$searchCompetence'";
                        }
                        $requete = " $requete GROUP BY offres_stages.ID_offre";
                    }
                }
                else{ 
                    $requete =" SELECT entreprise.Nom, offres_stages.Description 
                                FROM offres_stages INNER JOIN entreprise 
                                ON offres_stages.ID_entreprise = entreprise.ID_entreprise 
                                ORDER BY ID_offre 
                                DESC LIMIT 12";
                }
                $reponse = $conn->query($requete);
                while($donnees = $reponse->fetch()){?>
                <div class="col-lg-4 col-md-6 col-sm-12" >
                    <h3> <?php echo $donnees['Nom'];?></h3>
                    <p><?php echo $donnees['Description'];?><p>
                    <button>En savoir plus</button>
                </div>
                <?php 
                    }
                    $reponse->closeCursor(); // Termine le traitement de la requête
                ?>
          </main>
<!------------------------------------------------------------------------------------------------------------------------->
        <footer class="text-center text-lg-start">
          <div class="container p-4">
            <div class="row">
              <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                <h5 class="text-uppercase">Footer Content</h5>

                <p>
                  Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iste atque ea quis
                  molestias. Fugiat pariatur maxime quis culpa corporis vitae repudiandae aliquam
                  voluptatem veniam, est atque cumque eum delectus sint!
                </p>
              </div>

              <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                <h5 class="text-uppercase">Links</h5>

                <ul class="list-unstyled mb-0">
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