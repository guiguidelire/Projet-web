<!DOCTYPE html>
<html>
    <head>
        <title>CESI STAGE Créer une offre</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link href="../Assets/Styles/style.css" rel="stylesheet">
        <style>
            strong{
                color : red;
            }
        </style>
        
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
                          <li><a href="../Entreprises/rechercher.php">Rechercher</a></li>
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
            $offreCréée = false;


            if(isset($_POST["creationOffreEntreprise"])){
                $duréeStage =  $_POST["duréeStage"];
                $dateDebutStage =  $_POST["dateDebutStage"];
                $nbPlace =  $_POST["nbPlace"];
                $remuneration =  $_POST["remuneration"];
                $creationOffreEntreprise =  strtoupper($_POST["creationOffreEntreprise"]);
                $descriptionStageCreation =  $_POST["descriptionStageCreation"];

            

                $requeteEntreprise ="SELECT Nom FROM entreprise";
                $reponseEntreprise = $conn->query($requeteEntreprise);

                $requetePromotion ="SELECT Promotion FROM promotion";
                $reponsePromotion = $conn->query($requetePromotion);
                

                $requeteCompetence ="SELECT Competences FROM competences";
                $reponseCompetence = $conn->query($requeteCompetence);


                while($donneesEntreprise = $reponseEntreprise->fetch()){
                    if($donneesEntreprise['Nom']==$creationOffreEntreprise){
                        $entrepriseExiste = true;
                    }
                }           
            }

            ?>
            
            <div class="creationStage">
                <form class="form-horizontal" action="./création.php" method="post">
                    <?php if($offreCréée){ ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <p><?php echo "L'offre chez <strong> $creationOffreEntreprise </strong> a été créé !"?></p>
                            </div>
                        </div>
                    <?php }else if(!$entrepriseExiste && isset($_POST["creationOffreEntreprise"])){?>
                        <div class="row">
                            <div class="col-sm-12">
                                <p><?php echo "L'entreprise <strong> $creationOffreEntreprise </strong> n'existe pas, veuillez d'abord la créer !"?></p>
                            </div>
                        </div>
                    <?php 
                    } ?>
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="duréeStage">Durée du stage :</label>
                            <div class="col-sm-3 col-md-4">
                                <input type="number" class="form-control" id="duréeStage" name="duréeStage" placeholder="Entrer la durée du stage en mois" required>
                            </div>
                            <label class="control-label col-sm-2 col-md-1" for="dateDebutStage">Début du stage :</label>
                            <div class="col-sm-4">
                                <input type="texte" class="form-control" id="dateDebutStage" name="dateDebutStage" placeholder="Entrer date de début du stage (AAAA-MM-DD)" required>
                            </div>
                        </div>
                    </div>
                    <!------------------------------------------------------------------------------------------------->
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="nbPlace">Nombre de place a pourvoir :</label>
                            <div class="col-sm-3 col-md-4">
                                <input type="number" class="form-control" id="nbPlace" name="nbPlace" placeholder="Entrer le nombre de place à pourvoir"required>
                            </div>
                            <label class="control-label col-sm-2 col-md-1" for="remuneration">Rémunération :</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="remuneration" name="remuneration" placeholder="Entrer la rémuneration de l'étudiant durant son stage" required>
                            </div>
                        </div>
                    </div>
                    <!------------------------------------------------------------------------------------------------->
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="creationOffreEntreprise">Nom de l'entreprise :</label>
                            <div class="col-sm-9">
                            <input type="texte" class="form-control" id="creationOffreEntreprise" name="creationOffreEntreprise" placeholder="Entrer le nom de l'entreprise où le stage sera effectué" required>
                            </div>
                        </div>
                    </div>
                    <!------------------------------------------------------------------------------------------------->
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="descriptionStageCreation">Description :</label>
                            <div class="col-sm-9">
                            <input type="textarea" class="form-control" id="descriptionStageCreation" name="descriptionStageCreation" placeholder="Decriver brievement le stage" required>
                            </div>
                        </div>
                    </div><br>
                    <!--Promotion----------------------------------------------------------------------------------------------->
                    <br>
                    <div class="row">
                        <div class="form-group ">
                            <?php
                                $requetePromotionRecup ="SELECT Promotion FROM promotion ORDER BY Promotion;";
                                $reponsePromotionRecup = $conn->query($requetePromotionRecup);
                            ?>
                            <label class="control-label col-sm-2" for="selectPromotion">Promotions concernés :</label>
                            <div class="col-sm-3 col-md-4">
                                <select class="form-control" id="selectPromotion" name="selectPromotion[]" multiple size ="10" required>
                                    <option value="">--Choisissez une promotion concerné par le stage--</option>
                                    <?php
                                    while($donnesPromotionRecup = $reponsePromotionRecup->fetch()){
                                        $promotion = $donnesPromotionRecup['Promotion']?>
                                        <?php echo $promotion?>
                                        <option value=<?php echo $promotion?>> <?php echo $promotion?> </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                    <!--Competences----------------------------------------------------------------------------------------------->
                    
                            <?php
                                $requeteCompetenceRecup ="SELECT Competences FROM competences ORDER BY competences;";
                                $reponseCompetenceRecup = $conn->query($requeteCompetenceRecup);
                            ?>
                            <label class="control-label col-sm-2 col-md-1" for="selectCompetence">Compétences :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="selectCompetence" name="selectCompetence[]" multiple size ="10" required>
                                    <option value="">--Choisissez une ou plusieurs competences--</option>
                                    <?php
                                    while($donnesCompetenceRecup = $reponseCompetenceRecup->fetch()){
                                        $competence = $donnesCompetenceRecup['Competences']?>
                                        <?php echo $competence?>
                                        <option value=<?php echo $competence?>> <?php echo $competence?> </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!------------------------------------------------------------------------------------------------->
                    <div class="form-group">
                        <div class="row">
                            <div class=" col-lg-1 col-md-1 col-sm-offset-2 col-sm-1">
                                <button type="submit">Créer</button>
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-offset-4 col-sm-1 ">
                                <button type="reset">Réinitialiser</button>
                            </div>
                        </div>
                    </div>
                </form>
                <?php 


            if($entrepriseExiste){
                $requeteOffre = "INSERT INTO offres_stages(Duree_stage, Date_offre, NB_place, Remuneration, ID_entreprise, `Description`) 
                                        VALUES('$duréeStage','$dateDebutStage','$nbPlace','$remuneration',(
                                            SELECT ID_entreprise FROM entreprise 
                                            WHERE Nom LIKE '$creationOffreEntreprise'
                                        ),'$descriptionStageCreation');";
                $conn->exec($requeteOffre); 
                $selectPromotion = $_POST['selectPromotion'];
                foreach($selectPromotion as $promotionConcerne){
                    $requeteOffreConcerne = "INSERT INTO concerne(ID_promotion, ID_offre)
                                            VALUES(
                                                (SELECT ID_Promotion FROM promotion WHERE Promotion LIKE '$promotionConcerne'),
                                                (SELECT ID_offre FROM offres_stages ORDER BY ID_offre DESC LIMIT 1));";
                    $conn->exec($requeteOffreConcerne); 
                }
                $selectCompetence = $_POST['selectCompetence'];
                foreach($selectCompetence as $competenceNecessite){
                    $requeteOffreNecessite = "INSERT INTO necessite(ID_competences, ID_offre)
                                            VALUES(
                                                (SELECT ID_competences FROM competences WHERE Competences LIKE '$competenceNecessite'),
                                                (SELECT ID_offre FROM offres_stages ORDER BY ID_offre DESC LIMIT 1));";
                    $conn->exec($requeteOffreNecessite); 
                }
                $offreCréée = true;
            }
            ?>
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