<<!DOCTYPE html>
<html>
    <head>
        <title>CESI STAGE</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link href="./Assets/Styles/style.css" rel="stylesheet">
        
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
                    <a class="navbar-brand" href="./index.php">CESI Stage</a>
                  </div>
                  <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                      <li class="active"><a href="./index.php">Accueil</a></li>

                      
                      <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Offres de stage
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="./OffresDeStage/rechercheOffre.php">Rechercher</a></li>
                          <?php

                          if(isset($_COOKIE['Login']) && (isset($_COOKIE['Fonction']))){ 
                            if($_COOKIE['Fonction']==1 || $_COOKIE['Fonction']==3){?>
                              <li><a href="./OffresDeStage/création.php">Création</a></li>
                              <?php
                            }
                          }                             
                          ?>
                        </ul>
                      </li>
              
                      <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Entreprise
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="./Entreprises/rechercher.php">Rechercher</a></li>
                          <?php
                          if(isset($_COOKIE['Login']) && (isset($_COOKIE['Fonction']))){ 
                            if($_COOKIE['Fonction']==1 || $_COOKIE['Fonction']==3){?>
                                <li><a href="./Entreprises/gerer.php">Gerer</a></li>
                              <?php
                            } 
                          }
                          ?>
                        </ul>
                      </li>
                                           
                      <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Compte
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li ><a href="./Compte/monCompte.php">Mon Compte</a></li>
                          <?php
                          if(isset($_COOKIE['Login']) || isset($_POST['Login'])){
                            ?>
                            <li><a href="./Compte/deconnexion.php">Deconnexion</a></li>
                            <?php
                          }
                          ?>
                        </ul>
                      </li>

                      <?php 
                      if(isset($_COOKIE['Login']) && (isset($_COOKIE['Fonction']))){ 
                        if($_COOKIE['Fonction']==1 || $_COOKIE['Fonction']==3){?>
                          <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Autre administration
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                              <li><a href="./Compte/creationCompte.php">Créer un nouveau compte</a></li>
                            </ul>
                          </li>
                        <?php
                        }
                      }
                      ?>
                    </li>
                  </ul>
                </div>
              </div>
            </nav>
        </header>

<!------------------------------------------------------------------------------------------------------------------------->

        <main>
          <?php
          require("./Assets/ConnexionBDD.php");
   
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
                    <img src="./Assets/Pictures/WEBALaUne.jpg" alt="1ere offre à la une" class="w-100 h-100">
                    <div class="carousel-caption">
                      <h3><?php echo $donneesALaUne['Nom']; ?></h3>
                      <p><?php echo $donneesALaUne['Competences']; ?></p>
                      <p><?php echo $donneesALaUne['Description']; ?></p>
                      <a href="./OffresDeStage/détailOffre.php?searchNom=<?php echo $donneesALaUne['Nom'];?>&searchLocalisation=<?php echo $donneesALaUne['Ville'];?>&ID_offre=<?php echo $donneesALaUne['ID_offre'];?>"><button>En savoir plus</button></a>
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
                    <img src="./Assets/Pictures/RESEAUalaune.jpg" alt="2e offre à la une" class="w-100 h-100">
                    <div class="carousel-caption">
                      <h3><?php echo $donneesALaUne['Nom']; ?></h3>
                      <p><?php echo $donneesALaUne['Competences']; ?></p>
                      <p><?php echo $donneesALaUne['Description']; ?></p>
                      <a href="./OffresDeStage/détailOffre.php?searchNom=<?php echo $donneesALaUne['Nom'];?>&searchLocalisation=<?php echo $donneesALaUne['Ville'];?>&ID_offre=<?php echo $donneesALaUne['ID_offre'];?>"><button>En savoir plus</button></a>
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
                    <img src="./Assets/Pictures/Calaune.jpg" alt="2e offre à la une" class="w-100 h-100">
                    <div class="carousel-caption">
                      <h3><?php echo $donneesALaUne['Nom']; ?></h3>
                      <p><?php echo $donneesALaUne['Competences']; ?></p>
                      <p><?php echo $donneesALaUne['Description']; ?></p>
                      <a href="./OffresDeStage/détailOffre.php?searchNom=<?php echo $donneesALaUne['Nom'];?>&searchLocalisation=<?php echo $donneesALaUne['Ville'];?>&ID_offre=<?php echo $donneesALaUne['ID_offre'];?>"><button>En savoir plus</button></a>
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
                    <a href="./OffresDeStage/détailOffre.php?searchNom=<?php echo $donnees['Nom'];?>&searchLocalisation=<?php echo $donnees['Ville'];?>&ID_offre=<?php echo $donnees['ID_offre'];?>"><button>En savoir plus</button></a>
                  </div>
                <?php
                  }
                  $reponse->closeCursor(); // Termine le traitement de la requête
                ?>
              </div>
            </div>
          </main>
<!------------------------------------------------------------------------------------------------------------------------->

<?php require("./Nav/footer.php"); ?>