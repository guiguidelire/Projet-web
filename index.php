<!DOCTYPE html>
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
                    <a class="navbar-brand" href="#">CESI Stage</a>
                  </div>
                  <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                      
                      <li class="active"><a href="#">Accueil</a></li>
                      
                      <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Offres de stage
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="./rechercheOffre.php">Rechercher</a></li>
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

          $requeteALaUne =" SELECT offres_stages.ID_offre, entreprise.Nom, offres_stages.Description, competences.Competences FROM offres_stages 
          INNER JOIN entreprise ON offres_stages.ID_entreprise = entreprise.ID_entreprise
          INNER JOIN necessite ON offres_stages.ID_offre = necessite.ID_offre
          INNER JOIN competences ON necessite.ID_competences = competences.ID_competences;"
          $reponseALaUne = $conn->query($requeteALaUne);
                
          ?>
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
             
              <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
              </ol>
          
           
              <div class="carousel-inner">
          
                <div class="item active">
                  <img src="./Assets/Pictures/WEBalaune.jpg" alt="Los Angeles" style="width:100%;">
                  <div class="carousel-caption">
                    <h3>Nom de l'entreprise 1</h3>
                    <p>Competence</p>
                    <p>Description du stage</p>
                  </div>
                </div>
          
                <div class="item">
                  <img src="./Assets/Pictures/RESEAUalaune.jpg" alt="Chicago" style="width:100%;">
                  <div class="carousel-caption">
                    <h3>Nom de l'entreprise 2</h3>
                    <p>Competence</p>
                    <p>Description du stage</p>
                  </div>
                </div>
              
                <div class="item">
                  <img src="./Assets/Pictures/Calaune.jpg" alt="New York" style="width:100%;">
                  <div class="carousel-caption">
                    <h3>Nom de l'entreprise 3</h3>
                    <p>Competence</p>
                    <p>Description du stage</p>
                  </div>
                </div>
            
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
                
                $requete =" SELECT entreprise.Nom, offres_stages.Description 
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
                        <button>En savoir plus</button>
                      </div>
                    <?php
                    }
                    $reponse->closeCursor(); // Termine le traitement de la requête
                    ?>
                </div>
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