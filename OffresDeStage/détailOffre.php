<?php 
$page = "1";
require("../Nav/header.php");
?>

<!------------------------------------------------------------------------------------------------------------------------->

        <main>
            <?php
            require("../Assets/ConnexionBDD.php");     
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
                        <form class="form-horizontal">
                            <div class="form-group">
                                <h1 class="col-lg-12 col-md-12 col-sm-12"><?php echo $donnees['Nom']?></h1>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="col-lg-12 col-md-12 col-sm-12" >
                            <a href="../Entreprises/détailEntreprise.php?searchNom=<?php echo $donnees['Nom'];?>&searchLocalisation=<?php echo $donnees['Ville'];?>&ID_entreprise=<?php echo $donnees['ID_entreprise'];?>"><button class="btn btn-default">En savoir plus sur <?php echo $donnees['Nom']?></button></a>
                            <h3 class="col-lg-12 col-md-12 col-sm-12">Description du stage : <?php echo $donnees['Description']?></h3>
                        </div>                       
                          <div class="col-lg-6 col-md-6 col-sm-12" >
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
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-12" >
                              <h4>
                                  Duréee du stage : 
                                  <?php echo $donnees['Duree_stage'];?> mois 
                              </h4>
                              <h4>
                                  Date du début du stage :
                                  <?php echo $donnees['Date_offre'];?>
                              </h4>
                              <h4>
                                  Nombre de place : 
                                  <?php echo $donnees['NB_place'];?>  
                              </h4>
                              <h4>
                                  Rémunération : 
                                  <?php echo $donnees['Remuneration'];?> €  
                              </h4>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12" >
                        <h2>Compétence requise :</h2>
                        <?php
                        $requete = "SELECT * FROM offres_stages
                        INNER JOIN necessite ON offres_stages.ID_offre = necessite.ID_offre
                        INNER JOIN competences ON necessite.ID_competences = competences.ID_competences
                        WHERE offres_stages.ID_offre = $ID_offre";
                        $reponse = $conn->query($requete);
                        while($donnees = $reponse->fetch()){
                          ?>
                              <h4>
                                  <?php echo $donnees['Competences'];?> 
                              </h4>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                    <?php
                    if(!isset($_COOKIE['ID_utilisateur'])){?>
                         <h3>Veuillez vous connecter pour postuler a cette offre</h3>
                       <?php
                    }
                    else{?>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                        <a href="../OffresDeStage/postuler.php?ID_offre=<?php echo $ID_offre;?>"><button class="btn btn-default">Postuler</button></a>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                        <a href="../OffresDeStage/détailOffre.php?wishlist=true&ID_offre=<?php echo $ID_offre;?>"><button class="btn btn-default">Ajouté à la liste de souhait</button></a>
                        </div>
                        
                        <?php    
                        $ID_utilisateur = $_COOKIE['ID_utilisateur'];
                        $requete = "SELECT * FROM offres_stages
                        INNER JOIN wish_list ON offres_stages.ID_offre = wish_list.ID_offre 
                        WHERE offres_stages.ID_offre = $ID_offre";
                        $reponse = $conn->query($requete);
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
                        
                        if($postul == false){
                            if(isset($_GET['wishlist'])){
                                ?>
                                <h1>Cette offre à bien été ajouté a votre liste</h1>
                                <?php
                                $send = "INSERT INTO wish_list(`ID_offre`, `ID_utilisateur`) 
                                VALUES($ID_offre, $ID_utilisateur);";
                                $conn->exec($send);
                            }
                        }
                        else{
                            if(isset($_GET['wishlist'])){
                                ?>
                                <h1>Cette offre est déjà dans votre liste</h1>
                                <?php
                            }
                        }
                    }
                    ?>
                    </div>
                    <?php
                }
                      $reponse->closeCursor(); // Termine le traitement de la requête
                ?>
          </main>

<!------------------------------------------------------------------------------------------------------------------------->

<?php require("../Nav/footer.php"); ?>