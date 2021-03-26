<!DOCTYPE html>
<html>
    <head>
        <title>CESI STAGE</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link href="../Assets/Styles/style.css" rel="stylesheet">
        
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
                          <li><a href="./OffresDeStage/rechercheOffre.php">Rechercher</a></li>
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

            
                    
            ?>
            <div class="container">
                <?php 
                
                if(isset($_COOKIE['Login'])){
                    echo "<div class='row'> 
                            <p> Vous etes deja connecté ! </p>
                        </div>";
                }else if(isset($_POST['Login'])){
                    $LoginCheck = false;
                    $MDPCheck = false;
                    $requeteLogin =" SELECT ID_utilisateur,`Login`, mdp 
                                FROM utilisateur;";
                    $reponseLogin = $conn->query($requeteLogin);
                    
                    while($donneesLogin = $reponseLogin->fetch()){
                        if($donneesLogin['Login']== $_POST['Login']){
                            $LoginCheck = true;
                            if($donneesLogin['mdp']== $_POST['motDePasse']){
                                $MDPCheck = true;
                                setcookie('Login', $_POST['Login'],time()+60*30);
                                setcookie('ID_utilisateur',$donneesLogin['ID_utilisateur'],time()+60*30);
                                echo "<div class='row'> 
                                        <p> Felecitation vous voila connecté ! </p>
                                    </div>";
                            }
                        }
                    }
                    if(!$MDPCheck){
                        if(!$LoginCheck){
                            echo "<p> Le Login n'est pas valide ! </p>";
                        }else{
                            echo "<p> Le mot de passe n'est pas valide ! </p>";
                        }
                    }
                    
                }else{ ?>
                    <form class="form-horizontal" action="./monCompte.php" method="post">
                        <br>
                        <div class="row">
                            <div class="form-group ">
                                <label class="control-label col-sm-2 col-sm-offset-3" for="Login">Login :</label>
                                <div class="col-sm-3">
                                    <input type="texte" class="form-control" id="Login" name="Login" placeholder="Entrer votre Login" required>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group ">
                                <label class="control-label col-sm-2 col-sm-offset-3" for="motDePasse">Password :</label>
                                <div class="col-sm-3">
                                    <input type="password" class="form-control" id="motDePasse" name="motDePasse" placeholder="Entrer votre password" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class=" col-lg-1 col-md-1 col-sm-offset-3 col-sm-1">
                                    <button type="submit" class="btn btn-default">Connexion</button>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php
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