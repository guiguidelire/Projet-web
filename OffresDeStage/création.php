<?php 
$page = "creationoffre";
require("../Nav/header.php");
?>

<!------------------------------------------------------------------------------------------------------------------------->

        <main>
            <?php
            if(!isset($_COOKIE['ID_utilisateur'])){?>
                    <h1 class="col-lg-12 col-md-12 col-sm-12">Veuillez vous connecter en temps qu'admistrateur ou tuteur</h1>       
            <?php
            }
            else{
                if($_COOKIE['Fonction']==1 || $_COOKIE['Fonction']==3){
                    require("../Assets/ConnexionBDD.php");
                    
                    $entrepriseExiste = false;
                    $offreCréée = false;


                    if(isset($_POST["creationOffreEntreprise"])){
                        $offreCréée = true;
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
                                        <input type="date" class="form-control" id="dateDebutStage" name="dateDebutStage" placeholder="Entrer date de début du stage (AAAA-MM-DD)" required>
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
                        
                    }
                    ?>
                    </div>
                
                   
                    
                <?php
                }
                else{?>
                     <h1 class="col-lg-12 col-md-12 col-sm-12">Veuillez vous connecter en temps qu'admistrateur ou tuteur</h1>
                     <?php
                }
            }
            ?>
        </main>
<!------------------------------------------------------------------------------------------------------------------------->

<?php require("../Nav/footer.php"); ?>