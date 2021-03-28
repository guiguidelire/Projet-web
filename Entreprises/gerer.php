<?php 
$page = "gererentreprise";
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
            <div class="container">
            <?php
            
            $entrepriseExistedeja = false;
            $pageEnvoiPOST = "./gerer.php";
            if(isset($_POST['creationOffreEntreprise'])){
                
                $pageEnvoiPOST = "../OffresDeStage/création.php";
                
            }else if(isset($_POST['nomEntreprise'])){
                $nomEntreprise = strtoupper($_POST['nomEntreprise']);
                $nbStagiaire = $_POST['nbStagiaire'];
                $numRue = $_POST['numRue'];
                $rue = $_POST['rue'];
                $ville = strtoupper($_POST['ville']);
                $codePostal = $_POST['codePostal'];
                $pays = strtoupper($_POST['pays']);
                $Secteur = $_POST['selectSecteur'];

                
                $requeteEntrepriseExiste =" SELECT * FROM entreprise ORDER BY ID_entreprise;";
                $reponseEntrepriseExiste = $conn->query($requeteEntrepriseExiste);
                while($donneesEntrepriseExiste = $reponseEntrepriseExiste->fetch()){
                    $deeNom = $donneesEntrepriseExiste['Nom'];
                    $deeNumero_rue = $donneesEntrepriseExiste['Numero_rue'];
                    $deeRue = $donneesEntrepriseExiste['Rue'];
                    $deeVille = $donneesEntrepriseExiste['Ville'];
                    $deeCode_postal = $donneesEntrepriseExiste['Code_postal'];
                    $deePays = $donneesEntrepriseExiste['Pays'];
                    if($deeNom == $nomEntreprise  && $deeNumero_rue == $numRue && $deeRue == $rue && $deeVille == $ville && $deeCode_postal == $codePostal && $deePays == $pays){
                        $entrepriseExistedeja = true;
                    }
                } 

                if(!$entrepriseExistedeja){
                    $requeteEntreprise = "INSERT INTO entreprise(Nom, NB_stagiaires_CESI, Numero_rue, Rue, Ville, Code_Postal, Pays) 
                                            VALUES('$nomEntreprise','$nbStagiaire','$numRue','$rue','$ville','$codePostal','$pays');";
                    $conn->exec($requeteEntreprise);

                    $requeteSecteurID ="( SELECT ID_secteur FROM secteur WHERE `Secteur_activite` LIKE 'Autres_secteurs_industriels')";//$Secteur')";
                    $requeteEntrepriseID ="( SELECT ID_entreprise FROM entreprise ORDER BY ID_entreprise DESC LIMIT 1)";
                
                    $requeteTravaille = "INSERT INTO travaille(ID_secteur, ID_entreprise) 
                                            VALUES($requeteSecteurID, $requeteEntrepriseID);";
                    $conn->exec($requeteTravaille);
                }
            }      
            ?>
            
                <form class="form-horizontal" action=<?php echo $pageEnvoiPOST?> method="post">
                    <?php if(!$entrepriseExistedeja && isset($_POST['nomEntreprise'])){ ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <p><?php echo "L'entreprise <strong> $nomEntreprise </strong> a été créé !"?></p>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if($entrepriseExistedeja){ ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <p><?php echo "L'entreprise <strong> $deeNom </strong> existe deja a cette adresse ! Vous pouvez toujours en ajouter une autre"?></p>
                        </div>
                    </div>
                    <?php } ?>
                    <br>
                    <div class="row">
                        <div class="form-group ">
                            <label class="control-label col-sm-2 col-sm-offset-3" for="nomEntreprise">Nom de l'entreprise :</label>
                            <div class="col-sm-4">
                                <input type="texte" class="form-control" id="nomEntreprise" name="nomEntreprise" placeholder="Entrer le nom de l'entreprise" required>
                            </div>
                        </div>
                    </div>
                    <!------------------------------------------------------------------------------------------------------->
                    <div class="row">
                        <div class="form-group ">
                            <label class="control-label col-sm-2 col-sm-offset-3" for="nbStagiaire">Nombre stagiaire CESI :</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="nbStagiaire" name="nbStagiaire" placeholder="Entrer le nombre d'étudiant CESI y étant deja aller " value="0" required>
                            </div>
                        </div>
                    </div><br>
                    <!------------------------------------------------------------------------------------------------------->
                    <div class="row">
                        <div class="form-group ">
                            <label class="control-label col-sm-2 col-sm-offset-3" for="numRue">Numero de rue :</label>
                            <div class="col-sm-4">
                                <input type="texte" class="form-control" id="numRue" name="numRue" placeholder="Entrer le nombre d'étudiant CESI y étant deja aller " required>
                            </div>
                        </div>
                    </div>
                    <!------------------------------------------------------------------------------------------------------->
                    <div class="row">
                        <div class="form-group ">
                            <label class="control-label col-sm-2 col-sm-offset-3" for="rue">Rue :</label>
                            <div class="col-sm-4">
                                <input type="texte" class="form-control" id="rue" name="rue" placeholder="Entrer le nombre d'étudiant CESI y étant deja aller " required>
                            </div>
                        </div>
                    </div>
                    <!------------------------------------------------------------------------------------------------------->
                    <div class="row">
                        <div class="form-group ">
                            <label class="control-label col-sm-2 col-sm-offset-3" for="ville">Ville :</label>
                            <div class="col-sm-4">
                                <input type="texte" class="form-control" id="ville" name="ville" placeholder="Entrer le nombre d'étudiant CESI y étant deja aller " required>
                            </div>
                        </div>
                    </div>
                    <!------------------------------------------------------------------------------------------------------->
                    <div class="row">
                        <div class="form-group ">
                            <label class="control-label col-sm-2 col-sm-offset-3" for="codePostal">Code Postal :</label>
                            <div class="col-sm-4">
                                <input type="texte" class="form-control" id="codePostal" name="codePostal" placeholder="Entrer le nombre d'étudiant CESI y étant deja aller " required>
                            </div>
                        </div>
                    </div>
                    <!------------------------------------------------------------------------------------------------------->
                    <div class="row">
                        <div class="form-group ">
                            <label class="control-label col-sm-2 col-sm-offset-3" for="pays">Pays :</label>
                            <div class="col-sm-4">
                                <input type="texte" class="form-control" id="pays" name="pays" placeholder="Entrer le nombre d'étudiant CESI y étant deja aller " required>
                            </div>
                        </div>
                    </div><br>
                    <!------------------------------------------------------------------------------------------------------->
                    <div class="row">
                        <div class="form-group ">
                            <label class="control-label col-sm-2 col-sm-offset-3" for="selectSecteur">Secteur d'activité :</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="selectSecteur" name="selectSecteur" required>
                                    <option value="">--Choisissez un secteur d'activité--</option>
                                    <?php
                                    $requeteSecteur =" SELECT Secteur_activite FROM secteur ORDER BY secteur_activite;";
                                    $reponseSecteur = $conn->query($requeteSecteur);
                                    while($donneesSecteur = $reponseSecteur->fetch()){
                                        $Secteur = $donneesSecteur['Secteur_activite'];
                                        ?><option value=<?php echo $Secteur?>><?php echo $Secteur?></option><?php
                                    } 
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!------------------------------------------------------------------------------------------------------->
                    
                    <div class="form-group">
                        <div class="row">
                            <div class=" col-lg-1 col-md-1 col-sm-offset-5 col-sm-1">
                                <button type="submit">Créer</button>
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-1 ">
                                <button type="reset">Réinitialiser</button>
                            </div>
                            
                        </div>
                    </div>
                </form>
                <div class="col-lg-3 col-md-3 col-sm-3 col-sm-offset-5">
                    <a href="../OffresDeStage/création.php"><button>Créer une offre de stage</button></a>
                </div><br><br>
            </div>
        </main>
<!------------------------------------------------------------------------------------------------------------------------->
        
<?php require("../Nav/footer.php"); ?>