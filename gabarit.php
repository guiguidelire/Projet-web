<!doctype html>
<html lang="fr">
    <head>
        <title><?php echo $title ?></title>
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
                    <a class="navbar-brand" href="../index.php">CESI Stage</a>
                  </div>
                  <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                      <li><a href="../index.php">Accueil</a></li>

                      <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Offres de stage
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <?php if($page == "rechercheroffre"){?>
                            <li class="active"><a href="../OffresDeStage/rechercheOffre.php">Rechercher</a></li>
                          <?php
                          }
                          else{?>
                            <li><a href="../OffresDeStage/rechercheOffre.php">Rechercher</a></li>
                          <?php
                          } 
                          
                          if(isset($_COOKIE['Login']) && (isset($_COOKIE['Fonction']))){ 
                            if($_COOKIE['Fonction']==1 || $_COOKIE['Fonction']==3){
                              if($page == "creationoffre"){?>
                                <li class="active"><a href="../OffresDeStage/création.php">Création</a></li>
                              <?php
                              }
                              else{?>
                                <li><a href="../OffresDeStage/création.php">Création</a></li>
                              <?php
                              } 
                            }
                          }                             
                          ?>
                        </ul>
                      </li>


                      
                      <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Entreprise
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                        <?php if($page == "rechercherentreprise"){?>
                            <li class="active"><a href="../Entreprises/rechercher.php">Rechercher</a></li>
                          <?php
                          }
                          else{?>
                            <li><a href="../Entreprises/rechercher.php">Rechercher</a></li>
                          <?php
                          }

                          if(isset($_COOKIE['Login']) && (isset($_COOKIE['Fonction']))){ 
                            if($_COOKIE['Fonction']==1 || $_COOKIE['Fonction']==3){
                              if($page == "gererentreprise"){?>
                                <li class="active"><a href="../Entreprises/gerer.php">Création</a></li>
                              <?php
                              }
                              else{?>
                                <li><a href="../Entreprises/gerer.php">Gerer</a></li>
                              <?php
                              } 
                            }
                          }
                          ?>
                        </ul>
                      </li>
                      
                      
                      <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Compte
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <?php 
                          if($page == "moncompte"){?>
                            <li class="active"><a href="../Compte/monCompte.php">Mon Compte</a></li>
                          <?php
                          }
                          else{?>
                            <li><a href="../Compte/monCompte.php">Mon Compte</a></li>
                          <?php
                          }
                          if(isset($_COOKIE['Login']) || isset($_POST['Login'])){
                            if($page == "deconnexion"){?>
                              <li class="active"><a href="../Compte/deconnexion.php">Deconnexion</a></li>
                            <?php
                            }
                            else{?>
                              <li><a href="../Compte/deconnexion.php">Deconnexion</a></li>
                            <?php
                            }
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
                          <?php
                          if($page == "creationutilisateur"){?>
                            <li class="active"><a href="../Compte/creationCompte.php">Créer un nouveau compte</a></li>
                            <?php
                            }
                            else{?>
                              <li><a href="../Compte/creationCompte.php">Créer un nouveau compte</a></li>
                            <?php
                            }
                            ?>
                          </ul>
                          </li>
                        <?php
                        }
                      } ?>
                    </li>



                  </ul>
                </div>
              </div>
            </nav>
        </header>

<!-----------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------------>

        <?= $contenu ?>   <!-- Élément spécifique -->

<!-----------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------------>

        <footer class="text-center text-lg-start">
          <div class="container p-4">
            <div class="row">
              <div class="col-lg-4 col-md-6 col-sm-12">
                <h5 class="text-uppercase">Localisation</h5>

                <p>
                Parc Club des Tanneries,</br>
                2 Allée des Foulons,</br>
                67380 Strasbourg Lingolsheim</br>
                </p>
              </div>

              <div class="col-lg-4 col-md-6 col-sm-12">
                <h5 class="text-uppercase">Contactez nous</h5>
                <p>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                    <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                  </svg>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                  </svg>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                    <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/>
                  </svg>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
                    <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"/>
                  </svg>
                </p>
              </div>

              <div class="col-lg-4 col-md-6 col-sm-12">
                <h5 class="text-uppercase">Liens Pratiques</h5>
                <ul class="list-unstyled">
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