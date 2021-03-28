<?php
require("./POO.php");
require("../Assets/ConnexionBDD.php");//$conn : connexion bdd   
$page = "gererentreprise";
require("../Nav/header.php");

?>

<!------------------------------------------------------------------------------------------------------------------------->

<main>
    <div class="container">
    <?php
    
    $entrepriseExistedeja = false;
    if(isset($_POST['nomEntreprise'])){
        $entreprise = new entreprise($_POST['nomEntreprise'],$_POST['nbStagiaire'],$_POST['numRue'],$_POST['rue'],$_POST['ville'],$_POST['codePostal'],$_POST['pays'],$_POST['selectSecteur']);
        $entrepriseExistedeja = $entreprise->_VericationEntrepriseExiste($conn);
        if(!$entrepriseExistedeja){
            $entreprise ->_InsertEntreprise($conn);
        }
        $nomEntreprise = $entreprise->_getNomEntreprise();
    }
    ?>
    
        <form class="form-horizontal" action="./gerer.php" method="post">
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
                    <p><?php echo "L'entreprise <strong> $nomEntreprise </strong> existe deja a cette adresse ! Vous pouvez toujours en ajouter une autre."?></p>
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