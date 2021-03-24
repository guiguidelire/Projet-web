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
                          <li><a href="./OffresDeStage/rechercheOffre.php">Rechercher</a></li>
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
            ?>
            
            <?php
            $entrepriseExiste = false;
            $entrepriseCréée = false;
            $offreCréée = false;
            $promotionExiste = false;
            $competence1Existe = false;
            $competence2Existe = false;
            $competence3Existe = false;
            $creationOffresCompetences2 = NULL;
            $creationOffresCompetences3 = NULL;
            //$requete="";
            if(isset($_POST["creationOffreEntreprise"])){
                $duréeStage =  $_POST["duréeStage"];
                $dateDebutStage =  $_POST["dateDebutStage"];
                $nbPlace =  $_POST["nbPlace"];
                $remuneration =  $_POST["remuneration"];
                $creationOffreEntreprise =  $_POST["creationOffreEntreprise"];
                $descriptionStageCreation =  $_POST["descriptionStageCreation"];
                $promotionConcernéCréation =  $_POST["promotionConcernéCréation"];
                $creationOffresCompetences1 =  $_POST["creationOffresCompetences1"];
                $creationOffresCompetences2 =  $_POST["creationOffresCompetences2"];
                $creationOffresCompetences3 =  $_POST["creationOffresCompetences3"];
            

                $requeteEntreprise =" SELECT Nom FROM entreprise";
                $reponseEntreprise = $conn->query($requeteEntreprise);

                $requetePromotion =" SELECT Promotion FROM promotion";
                $reponsePromotion = $conn->query($requetePromotion);
                

                $requeteCompetence =" SELECT Competences FROM competences";
                $reponseCompetence = $conn->query($requeteCompetence);


                while($donneesEntreprise = $reponseEntreprise->fetch()){
                    if($donneesEntreprise['Nom']==$creationOffreEntreprise){
                        $entrepriseExiste = true;
                    }

                }
                while($donneesPromotion = $reponsePromotion->fetch()){
                    if($donneesPromotion['Promotion']==$promotionConcernéCréation){
                        $promotionExiste = true;
                    }
                }
                while($donneesCompetence = $reponseCompetence->fetch()){
                    if($donneesCompetence['Competences']==$creationOffresCompetences1){
                        $competence1Existe = true;
                    }
                    if($donneesCompetence['Competences']==$creationOffresCompetences2){
                        $competence2Existe = true;
                    }
                    if($donneesCompetence['Competences']==$creationOffresCompetences3){
                        $competence3Existe = true;
                    }
                }
                
                
                if(!$entrepriseExiste && isset($_POST["creationOffreEntreprise"])){?>
                    <div class="creationStageEntreprise">
                        <form class="form-horizontal" action="./création.php?<?php echo 'nomEntreprise='.urlencode($creationOffreEntreprise).'&duréeStage='.urlencode($duréeStage).'&dateDebutStage='.urlencode($dateDebutStage).'&nbPlace='.urlencode($nbPlace).'&remuneration='.urlencode($remuneration).'&creationOffreEntreprise='.urlencode($creationOffreEntreprise).'&descriptionStageCreation='.urlencode($descriptionStageCreation).'&promotionConcernéCréation='.urlencode($promotionConcernéCréation).'&creationOffresCompetences1='.urlencode($creationOffresCompetences1).'&creationOffresCompetences2='.urlencode($creationOffresCompetences2).'&creationOffresCompetences3='.urlencode($creationOffresCompetences3) ;?>" method="post">
                            <div class="form-group">
                                <p class="control-label col-sm-9" style="color:white"> L'entreprise n'est pas encore dans nos données, veuillez la renseigner. <p>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="nbStagiaireCESI">Nombre stagiaire CESI y étant déjà allé :</label>
                                <div class="col-sm-8">
                                <input type="texte" class="form-control input-sm" id="nbStagiaireCESI" name="nbStagiaireCESI" placeholder="Entrer le nombre stagiaire CESI étant déjà allé en stage dans cette entreprise" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="creationOffreNum">Numero de rue :</label>
                                <div class="col-sm-8">
                                <input type="texte" class="form-control input-sm" id="creationOffreNum" name="creationOffreNum" placeholder="Entrer le numero de rue de l'entreprise" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="creationOffreRue">Rue :</label>
                                <div class="col-sm-8">
                                <input type="texte" class="form-control input-sm" id="creationOffreRue" name="creationOffreRue" placeholder="Entrer le nom de la rue où se situe l'entreprise" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="creationOffreVille">Ville :</label>
                                <div class="col-sm-8">
                                <input type="texte" class="form-control input-sm" id="creationOffreVille" name="creationOffreVille" placeholder="Entrer le nom de la ville où se situe l'entreprise" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="creationOffreCode">Code Postal :</label>
                                <div class="col-sm-8">
                                <input type="texte" class="form-control input-sm" id="creationOffreCode" name="creationOffreCode" placeholder="Entrer le code postal de l'entreprise" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="creationOffrePays">Pays :</label>
                                <div class="col-sm-8">
                                <input type="texte" class="form-control input-sm" id="creationOffrePays" name="creationOffrePays" placeholder="Entrer le nom du pays dans lequel se trouve l'entreprise" required>
                                </div>
                            </div><br>
                            <div class="form-group">
                        <div class="row">
                            <div class=" col-lg-1 col-md-1 col-sm-offset-2 col-sm-1">
                                <button type="submit" class="btn btn-default">Créer</button>
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-1 ">
                                <button type="reset" class="btn btn-default">Réinitialiser</button>
                            </div>
                        </div>
                    </div>
                        </form>
                    </div>
                <?php
                }
                          
            }else{ ?>
            <div class="creationStage">
                <form class="form-horizontal" action="./création.php" method="post">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="duréeStage">Durée du stage :</label>
                        <div class="col-sm-9">
                        <input type="number" class="form-control" id="duréeStage" name="duréeStage" placeholder="Entrer la durée du stage en mois" <?php if(isset($_POST['duréeStage'])){echo"value=$duréeStage";} ?> required>
                        </div>
                    </div>
                    <!------------------------------------------------------------------------------------------------->
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="dateDebutStage">Début du stage :</label>
                        <div class="col-sm-9">
                        <input type="texte" class="form-control" id="dateDebutStage" name="dateDebutStage" placeholder="Entrer date de début du stage (AAAA-MM-DD)" <?php if(isset($_POST['dateDebutStage'])){echo"value=$dateDebutStage";} ?> required>
                        </div>
                    </div>
                    <!------------------------------------------------------------------------------------------------->
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="nbPlace">Nombre de place a pourvoir :</label>
                        <div class="col-sm-9">
                        <input type="number" class="form-control" id="nbPlace" name="nbPlace" placeholder="Entrer le nombre de place à pourvoir" <?php if(isset($_POST['nbPlace'])){echo"value=$nbStage";} ?> required>
                        </div>
                    </div>
                    <!------------------------------------------------------------------------------------------------->
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="remuneration">Rémunération :</label>
                        <div class="col-sm-9">
                        <input type="number" class="form-control" id="remuneration" name="remuneration" placeholder="Entrer la rémuneration de l'étudiant durant son stage" <?php if(isset($_POST['remuneration'])){echo"value=$remuneration";} ?> required>
                        </div>
                    </div>
                    <!------------------------------------------------------------------------------------------------->
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="creationOffreEntreprise">Nom de l'entreprise :</label>
                        <div class="col-sm-9">
                        <input type="texte" class="form-control" id="creationOffreEntreprise" name="creationOffreEntreprise" placeholder="Entrer le nom de l'entreprise où le stage sera effectué" <?php if(isset($_POST['creationOffreEntreprise'])){echo"value=$creationOffreEntreprise";} ?> required>
                        </div>
                    </div>

                    <!------------------------------------------------------------------------------------------------->
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="descriptionStageCreation">Description :</label>
                        <div class="col-sm-9">
                        <input type="textarea" class="form-control" id="descriptionStageCreation" name="descriptionStageCreation" placeholder="Decriver brievement le stage" <?php if(isset($_POST['descriptionStageCreation'])){echo"value=$descriptionStageCreation";} ?> required>
                        </div>
                    </div><br>
                    <!------------------------------------------------------------------------------------------------->
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="promotionConcernéCréation">Promotion concerné :</label>
                        <div class="col-sm-9">
                        <input type="texte" class="form-control" id="promotionConcernéCréation" name="promotionConcernéCréation" placeholder="Entrer la promotion concerné par votre offre de stage (ex : A2 INFO, A5 Généraliste, A3 S3E,...)" <?php if(isset($_POST['promotionConcernéCréation'])){echo"value=$promotionConcernéCréation";} ?> required>
                        </div>
                    </div><br>
                    <!------------------------------------------------------------------------------------------------->
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="creationOffresCompetences1">Competence 1 :</label>
                        <div class="col-sm-9">
                        <input type="texte" class="form-control" id="creationOffresCompetences1" name="creationOffresCompetences1" placeholder="Entrer une compétence nécessaire pour le stage" <?php if(isset($_POST['promotionConcernéCréation'])){echo"value=$creationOffresCompetences1";} ?> required>
                        </div>
                    </div>
                    <!------------------------------------------------------------------------------------------------->
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="creationOffresCompetences2">Competence 2 :</label>
                        <div class="col-sm-9">
                        <input type="texte" class="form-control" id="creationOffresCompetences2" name="creationOffresCompetences2" placeholder="Entrer une compétence nécessaire pour le stage (facultatif)" <?php if(isset($_POST['promotionConcernéCréation'])){echo"value=$creationOffresCompetences2";} ?> >
                        </div>
                    </div>
                    <!------------------------------------------------------------------------------------------------->
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="creationOffresCompetences3">Competence 3 :</label>
                        <div class="col-sm-9">
                        <input type="texte" class="form-control" id="creationOffresCompetences3" name="creationOffresCompetences3" placeholder="Entrer une compétence nécessaire pour le stage (facultatif)" <?php if(isset($_POST['promotionConcernéCréation'])){echo"value=$creationOffresCompetences3";} ?> >
                        </div>
                    </div>
                    <!------------------------------------------------------------------------------------------------->
                    <div class="form-group">
                        <div class="row">
                            <div class=" col-lg-1 col-md-1 col-sm-offset-3 col-sm-1">
                                <button type="submit" class="btn btn-default">Créer</button>
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-1 ">
                                <button type="reset" class="btn btn-default">Réinitialiser</button>
                            </div>
                        </div>
                    </div>
                </form>
                <?php 
                if ($creationOffresCompetences2 == NULL){$competence2Existe = true;}
                if ($creationOffresCompetences3 == NULL){$competence3Existe = true;}
                
                if(isset($_POST['nbStagiaireCESI'])){
                    $nomEntreprise = $_GET['nomEntreprise'];
                    $nbStagiaireCESI = $_POST['nbStagiaireCESI'];
                    $creationOffreNum = $_POST['creationOffreNum'];
                    $creationOffreRue = $_POST['creationOffreRue'];
                    $creationOffreVille = $_POST['creationOffreVille'];
                    $creationOffreCode = $_POST['creationOffreCode'];
                    $creationOffrePays = $_POST['creationOffrePays'];

                    $entrepriseExiste = true;
                    $entrepriseCréée = true;
                    $duréeStage =  $_GET["duréeStage"];
                    $dateDebutStage =  $_GET["dateDebutStage"];
                    $nbPlace =  $_GET["nbPlace"];
                    $remuneration =  $_GET["remuneration"];
                    $creationOffreEntreprise =  $_GET["creationOffreEntreprise"];
                    $descriptionStageCreation =  $_GET["descriptionStageCreation"];
                    $promotionConcernéCréation =  $_GET["promotionConcernéCréation"];
                    $creationOffresCompetences1 =  $_GET["creationOffresCompetences1"];
                    $creationOffresCompetences2 =  $_GET["creationOffresCompetences2"];
                    $creationOffresCompetences3 =  $_GET["creationOffresCompetences3"];
                    $requeteEntreprise="INSERT INTO entreprise(Nom, NB_stagiaires_CESI, Numero_rue, Rue, Ville, Code_postal,Pays) 
                                        VALUES('$nomEntreprise','$nbStagiaireCESI','$creationOffreNum','$creationOffreRue','$creationOffreVille','$creationOffreCode','$creationOffrePays');"; 
                    $conn->exec($requeteEntreprise);                   
                }  
            }
            if($entrepriseExiste){
                $requeteOffre = "INSERT INTO offres_stages(Duree_stage, Date_offre, NB_place, Remuneration, ID_entreprise, `Description`) 
                                        VALUES('$duréeStage','$dateDebutStage','$nbPlace','$remuneration',(
                                            SELECT ID_entreprise FROM entreprise 
                                            WHERE Nom LIKE '$creationOffreEntreprise'
                                        ),'$descriptionStageCreation');";
                $conn->exec($requeteOffre); 

                $requeteOffreConcerne = "INSERT INTO concerne(ID_promotion, ID_offre)
                                            VALUES(
                                                (SELECT ID_promotion FROM promotion WHERE Promotion LIKE '$promotionConcernéCréation'),
                                                (SELECT ID_offre FROM offres_stages ORDER BY ID_offre DESC LIMIT 1));";
                $conn->exec($requeteOffreConcerne); 

                $requeteOffreNecessite = "INSERT INTO necessite(ID_competences, ID_offre)
                                            VALUES(
                                                (SELECT ID_competences FROM competences WHERE Competences LIKE '$creationOffresCompetences1'),
                                                (SELECT ID_offre FROM offres_stages ORDER BY ID_offre DESC LIMIT 1));";
                $conn->exec($requeteOffreNecessite); 

                if($creationOffresCompetences2 != NULL){
                    $requeteCompetence2 = "INSERT INTO necessite(ID_competences, ID_offre)
                                            VALUES(
                                                (SELECT ID_competences FROM competences WHERE Competences LIKE '$creationOffresCompetences2'),
                                                (SELECT ID_offre FROM offres_stages ORDER BY ID_offre DESC LIMIT 1));";
                    $conn->exec($requeteCompetence2); 
                }
                if($creationOffresCompetences3 != NULL){
                    $requeteCompetence2 = "INSERT INTO necessite(ID_competences, ID_offre)
                                            VALUES(
                                                (SELECT ID_competences FROM competences WHERE Competences LIKE '$creationOffresCompetences3'),
                                                (SELECT ID_offre FROM offres_stages ORDER BY ID_offre DESC LIMIT 1));";
                    $conn->exec($requeteCompetence2); 
                }
                $offreCréée = true;
                
            }
            
            if($entrepriseCréée){
                echo "L'entreprise \"$nomEntreprise\" crée";
            }
            if($offreCréée){
                echo "Offre crée";
            }
                ?>
            </div>
            <div>
            </div>
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