<?php
$page = "moncompte";
require("../Nav/header.php");

require("../Assets/ConnexionBDD.php");//$conn : connexion bdd  

function avancement($etat){
    if($etat == 1){
        echo "Votre candidature est envoyé";
    }
    else if($etat == 2){
        echo "Votre candidature est en cour de traitement";
    }
    else if($etat == 3){
        echo "Fiche de validation émise par l'entreprise";
    }
    else if($etat == 4){
        echo "Fiche de validation envoyé à l'assistant administratif";
    }
    else if($etat == 5){
        echo "Convention de stage envoiyé à l'entreprise";
    }
    else if($etat == 6){
        echo "Convention de stage signé par l'entreprise";
    }
}
?>

<!------------------------------------------------------------------------------------------------------------------------->

        <main>            
            <?php            
            if(isset($_COOKIE['Login'])){
                $ID_utilisateur = $_COOKIE['ID_utilisateur'];
                if(isset($_GET['ID_utilisateur']) && (($_COOKIE['Fonction']==3) || ($_COOKIE['Fonction']==1))){
                    $ID_utilisateur = $_GET['ID_utilisateur'];
                }
                ?>
                <div class="container"> 
                    <h1>Information utilisateur</h1>
                <?php
                $requete =" SELECT * FROM utilisateur    
                INNER JOIN role ON utilisateur.ID_fonction = role.ID_fonction
                INNER JOIN centre ON utilisateur.ID_centre = centre.ID_centre
                INNER JOIN promotion ON utilisateur.ID_promotion = promotion.ID_promotion
                WHERE ID_utilisateur = $ID_utilisateur";                    

                $reponse = $conn->query($requete);
                while($donnees = $reponse->fetch()){?>
                    <h3> <?php echo $donnees['Nom'];?> <?php echo $donnees['Prenom'];?></h3>
                    <h4> <?php echo $donnees['Nom_centre'];?></h4>
                    <h4> <?php echo $donnees['Promotion'];?></h4>
                    <p><?php echo $donnees['Fonction'];?></p>
                    <?php
                }
                if($_COOKIE['Fonction']==1 || $_COOKIE['Fonction']==3){?>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <a href="../Compte/detailUtilisateur.php?delete=true&ID_utilisateur=<?php echo $ID_utilisateur;?>">
                            <button>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                                Suprimer cet utilisateur
                            </button>
                        </a>
                    </div>                           
                    <?php
                    if(isset($_GET['delete'])){
                        if($_GET['delete']==true){
                            $requete = "DELETE FROM postuler WHERE ID_utilisateur = $ID_utilisateur;
                            DELETE FROM wish_list WHERE ID_utilisateur = $ID_utilisateur;
                            DELETE FROM evaluer WHERE ID_utilisateur = $ID_utilisateur;
                            DELETE FROM dispose WHERE ID_utilisateur = $ID_utilisateur;
                            DELETE FROM utilisateur WHERE ID_utilisateur = $ID_utilisateur;";
                            $conn->exec($requete);
                            ?> 
                            <meta http-equiv="refresh" content="0;URL=monCompte.php">
                            <?php
                        }
                    }
                }
                ?>
                </div>
                <div class="row">
                    <div class="col-sm-12"> 
                        <h1>Liste de souhait</h1>
                    </div>
                    
                    <?php
                    $requete =" SELECT entreprise.Nom, offres_stages.Description, entreprise.Ville, offres_stages.ID_offre
                    FROM offres_stages 
                    INNER JOIN entreprise ON offres_stages.ID_entreprise = entreprise.ID_entreprise 
                    INNER JOIN wish_list ON offres_stages.ID_offre = wish_list.ID_offre
                    WHERE wish_list.ID_utilisateur = $ID_utilisateur";                    

                    $reponse = $conn->query($requete);
                    while($donnees = $reponse->fetch()){?>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <h3> <?php echo $donnees['Nom'];?></h3>
                        <h4> <?php echo $donnees['Ville'];?></h4>
                        <p><?php echo $donnees['Description'];?></p>                    
                        <a href="../OffresDeStage/détailOffre.php?searchNom=<?php echo $donnees['Nom'];?>&searchLocalisation=<?php echo $donnees['Ville'];?>&ID_offre=<?php echo $donnees['ID_offre'];?>"><button>En savoir plus</button></a>
                    </div>
                    <?php
                    }
                    ?>
                    
                    <div class="col-sm-12"> 
                        <h1>Candidature</h1>
                    </div>
                    <?php
                    $requete =" SELECT entreprise.Nom, offres_stages.Description, entreprise.Ville, offres_stages.ID_offre, postuler.Etat
                    FROM offres_stages 
                    INNER JOIN entreprise ON offres_stages.ID_entreprise = entreprise.ID_entreprise 
                    INNER JOIN postuler ON offres_stages.ID_offre = postuler.ID_offre
                    WHERE postuler.ID_utilisateur = $ID_utilisateur";                    

                    $reponse = $conn->query($requete);
                    while($donnees = $reponse->fetch()){?>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <h3> <?php echo $donnees['Nom'];?></h3>
                        <h4> <?php echo $donnees['Ville'];?></h4>
                        <p><?php echo $donnees['Description'];?></p>
                        <h4> Etat : <?php avancement($donnees['Etat']);?></h4>
                        <?php
                        $ID_offre = $donnees['ID_offre'];
                        if(($_COOKIE['Fonction']==3) || ($_COOKIE['Fonction']==1)){?>
                            <form class="form-horizontal" method="post">
                                <input type="hidden" value="1" name="<?php echo $ID_offre ?>"></input>
                                <div>
                                    <button type="submit" >Etape suivante</button>
                                </div>
                            </form>
                            <?php
                            if(isset($_POST[$ID_offre])){
                                if($donnees['Etat'] < 6){
                                    $etat = $donnees['Etat'] + 1;
                                    $requete = "UPDATE postuler SET Etat = $etat
                                        WHERE ID_offre = $ID_offre AND ID_utilisateur = $ID_utilisateur";
                                    $conn->exec($requete);
                                }
                                unset($_POST[$ID_offre]);?>
                                <meta http-equiv="refresh" content="0;URL=detailUtilisateur.php?ID_utilisateur=<?php echo $ID_utilisateur;?>">
                                <?php
                            }
                        }
                        ?>
                        <div class="col-sm-12">
                            <a href="../OffresDeStage/détailOffre.php?searchNom=<?php echo $donnees['Nom'];?>&searchLocalisation=<?php echo $donnees['Ville'];?>&ID_offre=<?php echo $donnees['ID_offre'];?>"><button>En savoir plus</button></a>
                        </div>
                    </div>
                    <?php 
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