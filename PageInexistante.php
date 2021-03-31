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
<!--Corp de la page---------------------------------------------->
    <?php 
    $title = 'CESI Stage - Erreur'; ?>

    <main>
        <div class= "container">
            <h1>La page que vous chercher à atteindre n'existe pas !</h1>
            <a href="./index.php"><button>Accueil</button></a>
        </div>
    </main>



<?php require("./Nav/footer.php"); ?>