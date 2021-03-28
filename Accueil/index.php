<?php 
$page = "accueil";
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
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
             
              <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
              </ol>
          
           
              <div class="carousel-inner">
          
                <?php 
                $requeteALaUne =" SELECT offres_stages.ID_offre, entreprise.Nom, offres_stages.Description, competences.Competences, offres_stages.ID_offre, entreprise.Ville  FROM offres_stages 
                INNER JOIN entreprise ON offres_stages.ID_entreprise = entreprise.ID_entreprise
                INNER JOIN necessite ON offres_stages.ID_offre = necessite.ID_offre
                INNER JOIN competences ON necessite.ID_competences = competences.ID_competences
                WHERE competences = 'HTML' OR competences = 'CSS' OR competences = 'JS' OR competences = 'PHP'
                ORDER BY ID_offre 
                DESC LIMIT 1;";
                $reponseALaUne = $conn->query($requeteALaUne);
                while($donneesALaUne = $reponseALaUne->fetch()){?>
                  <div class="item active">
                    <img src="../Assets/Pictures/WEBALaUne.jpg" alt="1ere offre à la une" class="w-100 h-100">
                    <div class="carousel-caption">
                      <h3><?php echo $donneesALaUne['Nom']; ?></h3>
                      <p><?php echo $donneesALaUne['Competences']; ?></p>
                      <p><?php echo $donneesALaUne['Description']; ?></p>
                      <a href="../OffresDeStage/détailOffre.php?searchNom=<?php echo $donneesALaUne['Nom'];?>&searchLocalisation=<?php echo $donneesALaUne['Ville'];?>&ID_offre=<?php echo $donneesALaUne['ID_offre'];?>"><button>En savoir plus</button></a>
                    </div>
                  </div>
                <?php } ?>

                <?php 
                $requeteALaUne =" SELECT offres_stages.ID_offre, entreprise.Nom, offres_stages.Description, competences.Competences, offres_stages.ID_offre, entreprise.Ville  FROM offres_stages 
                INNER JOIN entreprise ON offres_stages.ID_entreprise = entreprise.ID_entreprise
                INNER JOIN necessite ON offres_stages.ID_offre = necessite.ID_offre
                INNER JOIN competences ON necessite.ID_competences = competences.ID_competences
                WHERE competences = 'Reseau'OR competences = 'AD'
                ORDER BY ID_offre 
                DESC LIMIT 1;";
                $reponseALaUne = $conn->query($requeteALaUne);
                while($donneesALaUne = $reponseALaUne->fetch()){?>
                  <div class="item">
                    <img src="../Assets/Pictures/RESEAUalaune.jpg" alt="2e offre à la une" class="w-100 h-100">
                    <div class="carousel-caption">
                      <h3><?php echo $donneesALaUne['Nom']; ?></h3>
                      <p><?php echo $donneesALaUne['Competences']; ?></p>
                      <p><?php echo $donneesALaUne['Description']; ?></p>
                      <a href="../OffresDeStage/détailOffre.php?searchNom=<?php echo $donneesALaUne['Nom'];?>&searchLocalisation=<?php echo $donneesALaUne['Ville'];?>&ID_offre=<?php echo $donneesALaUne['ID_offre'];?>"><button>En savoir plus</button></a>
                    </div>
                  </div>
                <?php } ?>
              
                <?php 
                $requeteALaUne =" SELECT offres_stages.ID_offre, entreprise.Nom, offres_stages.Description, competences.Competences, offres_stages.ID_offre, entreprise.Ville  FROM offres_stages 
                INNER JOIN entreprise ON offres_stages.ID_entreprise = entreprise.ID_entreprise
                INNER JOIN necessite ON offres_stages.ID_offre = necessite.ID_offre
                INNER JOIN competences ON necessite.ID_competences = competences.ID_competences
                WHERE competences = 'Arduino' OR competences = 'C++' OR competences = 'C' OR competences = 'SQL'
                ORDER BY ID_offre 
                DESC LIMIT 1;";
                $reponseALaUne = $conn->query($requeteALaUne);
                while($donneesALaUne = $reponseALaUne->fetch()){?>
                  <div class="item">
                    <img src="../Assets/Pictures/Calaune.jpg" alt="2e offre à la une" class="w-100 h-100">
                    <div class="carousel-caption">
                      <h3><?php echo $donneesALaUne['Nom']; ?></h3>
                      <p><?php echo $donneesALaUne['Competences']; ?></p>
                      <p><?php echo $donneesALaUne['Description']; ?></p>
                      <a href="../OffresDeStage/détailOffre.php?searchNom=<?php echo $donneesALaUne['Nom'];?>&searchLocalisation=<?php echo $donneesALaUne['Ville'];?>&ID_offre=<?php echo $donneesALaUne['ID_offre'];?>"><button>En savoir plus</button></a>
                    </div>
                  </div>
                <?php } ?>
            
              </div>
          
             
              <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
            <div class="Titre_Nouveauté">
                <h3>Stage</h3>
                <p>Nouveauté</p>
            </div>
            <div class="Nouveauté">
              <?php
                
                $requete =" SELECT entreprise.Nom, offres_stages.Description, entreprise.Ville, offres_stages.ID_offre 
                            FROM offres_stages INNER JOIN entreprise 
                            ON offres_stages.ID_entreprise = entreprise.ID_entreprise 
                            ORDER BY ID_offre 
                            DESC LIMIT 6";
                $reponse = $conn->query($requete);
                
              ?>
              <div class="row">
                <?php while($donnees = $reponse->fetch()){?>
                  <div class="col-lg-4 col-md-6 col-sm-12" >
                    <h3>Stage chez <?php echo $donnees['Nom'];?></h3>
                    <p><?php echo $donnees['Description'];?><p>
                    <a href="../OffresDeStage/détailOffre.php?searchNom=<?php echo $donnees['Nom'];?>&searchLocalisation=<?php echo $donnees['Ville'];?>&ID_offre=<?php echo $donnees['ID_offre'];?>"><button>En savoir plus</button></a>
                  </div>
                <?php
                  }
                  $reponse->closeCursor(); // Termine le traitement de la requête
                ?>
              </div>
            </div>
          </main>
<!------------------------------------------------------------------------------------------------------------------------->

<?php require("../Nav/footer.php"); ?>