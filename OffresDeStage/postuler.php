<?php 
$page = "1";
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
            <div class="row">
                <?php 
                $ID_offre =  $_GET["ID_offre"];                
                $requete = "SELECT * FROM entreprise 
                INNER JOIN travaille ON entreprise.ID_entreprise = travaille.ID_entreprise
                INNER JOIN secteur ON travaille.ID_secteur = secteur.ID_secteur
                INNER JOIN offres_stages ON entreprise.ID_entreprise = offres_stages.ID_entreprise
                WHERE offres_stages.ID_offre = $ID_offre";

                $reponse = $conn->query($requete);
                while($donnees = $reponse->fetch()){
                    ?>
                    <div class="form-horizontal">
                        <form class="form-horizontal" action="../OffresDeStage/postuler.php?ID_offre=<?php echo $ID_offre;?>&submit=1" method="post">
                            <div class="form-group">
                                <h1 class="col-lg-12 col-md-12 col-sm-12"><?php echo $donnees['Nom']?></h1>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="searchNom">CV:</label>
                                <div class="col-sm-9">
                                <input type="texte" class="form-control" id="searchNom" name="cv" placeholder="Entrer un cv">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="searchLocalisation">Lettre de motivation :</label>
                                <div class="col-sm-9">
                                <input type="texte" class="form-control" id="searchLocalisation" name="lm" placeholder="Entrer une lettre de motivation">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Postuler</button>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php
                }
                $ID_utilisateur = $_COOKIE['ID_utilisateur'];
                $requete2 = "SELECT * FROM offres_stages
                INNER JOIN postuler ON offres_stages.ID_offre = postuler.ID_offre 
                WHERE offres_stages.ID_offre = $ID_offre";
                $reponse = $conn->query($requete2);
                $postul = false;
                while($donnees = $reponse->fetch()){
                    if($ID_utilisateur == $donnees['ID_utilisateur']){
                        $postul = true;
                        break;
                    }
                    else{
                        $postul = false;
                    }
                }
                ?>
                <div class="col-lg-12 col-md-12 col-sm-12" >
                <?php
                if($postul == false){
                    if(isset($_GET["submit"])){
                        $cv =  $_POST["cv"];
                        $lm =  $_POST["lm"];
                        ?>
                        <h1>Votre candidature a bien été prise en compte</h1>
                        <?php
                        $send = "INSERT INTO postuler(`ID_offre`, `ID_utilisateur`, `CV`, `Lm`, `Etat`) 
                        VALUES($ID_offre, $ID_utilisateur, '$cv', '$lm', 1);";
                        $conn->exec($send);
                        }  
                }
                else{
                    if(isset($_GET["submit"])){
                        ?>
                        <h1>Vous avez déjà postulé a cette offre</h1>
                        <?php
                    }
                }
                ?>
                </div>
                <?php
                    

                      $reponse->closeCursor(); // Termine le traitement de la requête
                ?>
          </main>






<!------------------------------------------------------------------------------------------------------------------------->

<?php require("../Nav/footer.php"); ?>