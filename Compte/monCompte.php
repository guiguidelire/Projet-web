<?php
require("../Assets/ConnexionBDD.php");//$conn : connexion bdd  
if(isset($_POST['Login'])){
    $LoginCheck = false;
    $MDPCheck = false;
    $requeteLogin =" SELECT ID_utilisateur,`Login`, mdp, ID_fonction 
                FROM utilisateur;";
    $reponseLogin = $conn->query($requeteLogin);
    
    while($donneesLogin = $reponseLogin->fetch()){
        if($donneesLogin['Login']== $_POST['Login']){
            $LoginCheck = true;
            if($donneesLogin['mdp']== crypt($_POST['motDePasse'], 'rl')){
                $MDPCheck = true;
                $IDFonction = $donneesLogin['ID_fonction'];
                setcookie('Login', $_POST['Login'],time()+300,'/');
                setcookie('ID_utilisateur',$donneesLogin['ID_utilisateur'],time()+300,'/');
                setcookie('Fonction',$IDFonction,time()+300,'/');
            }
        }
    }
}


$page = "moncompte";
require("../Nav/header.php");
?>

<!------------------------------------------------------------------------------------------------------------------------->

        <main>            
            <?php            
            if(isset($_COOKIE['Login'])){
                $ID_utilisateur = $_COOKIE['ID_utilisateur'];
                ?>
                <div class="container"> 
                    <h1>Information utilisateur</h1>
                <?php
                $requete =" SELECT * FROM utilisateur    
                INNER JOIN role ON utilisateur.ID_fonction = role.ID_fonction
                INNER JOIN centre ON utilisateur.ID_centre = centre.ID_centre
                LEFT JOIN promotion ON utilisateur.ID_promotion = promotion.ID_promotion
                WHERE ID_utilisateur = $ID_utilisateur";                    

                $reponse = $conn->query($requete);
                while($donnees = $reponse->fetch()){?>
                    <h3> <?php echo $donnees['Nom'];?> <?php echo $donnees['Prenom'];?></h3>
                    <h4> <?php echo $donnees['Nom_centre'];?></h4>
                    <h4> <?php echo $donnees['Promotion'];?></h4>
                    <p><?php echo $donnees['Fonction'];?><p>
                    <?php
                    $idcentre = $donnees['ID_centre'];
                    $idpromotion = $donnees['ID_promotion'];
                    $nomcentre = $donnees['Nom_centre'];
                }
                ?>
                </div>
                <?php
                
                if($_COOKIE['Fonction']==3){?>
                    <div class="col-lg-12 col-md-12 col-sm-12"> 
                        <h1 class="col-lg-12 col-md-12 col-sm-12">Information étudiants</h1>
                    </div>
                    <?php
                    $requete =" SELECT * FROM utilisateur    
                    INNER JOIN role ON utilisateur.ID_fonction = role.ID_fonction
                    INNER JOIN centre ON utilisateur.ID_centre = centre.ID_centre
                    INNER JOIN promotion ON utilisateur.ID_promotion = promotion.ID_promotion
                    WHERE utilisateur.ID_centre = $idcentre AND utilisateur.ID_promotion = $idpromotion AND (utilisateur.ID_fonction = 4 OR utilisateur.ID_fonction = 2)";                    

                    $reponse = $conn->query($requete);
                    while($donnees = $reponse->fetch()){?>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <h3> <?php echo $donnees['Nom'];?> <?php echo $donnees['Prenom'];?></h3>
                        <h4> <?php echo $donnees['Nom_centre'];?></h4>
                        <h4> <?php echo $donnees['Promotion'];?></h4>
                        <p><?php echo $donnees['Fonction'];?><p>
                        <a href="../Compte/detailUtilisateur.php?ID_utilisateur=<?php echo $donnees['ID_utilisateur']?>"><button>Plus d'information</button></a>
                    </div>
                    <?php
                    }
                }

                if($_COOKIE['Fonction']==1){?>
                    <div class="col-lg-12 col-md-12 col-sm-12"> 
                        <h1 class="col-lg-12 col-md-12 col-sm-12">Informations utilisateurs dans le centre de <?php echo $nomcentre ?></h1>
                    </div>
                    <?php
                    $requete =" SELECT * FROM utilisateur    
                    INNER JOIN role ON utilisateur.ID_fonction = role.ID_fonction
                    INNER JOIN centre ON utilisateur.ID_centre = centre.ID_centre
                    INNER JOIN promotion ON utilisateur.ID_promotion = promotion.ID_promotion
                    WHERE utilisateur.ID_centre = $idcentre  AND (utilisateur.ID_fonction = 4 OR utilisateur.ID_fonction = 3 OR utilisateur.ID_fonction = 2)";                    

                    $reponse = $conn->query($requete);
                    while($donnees = $reponse->fetch()){?>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <h3> <?php echo $donnees['Nom'];?> <?php echo $donnees['Prenom'];?></h3>
                        <h4> <?php echo $donnees['Nom_centre'];?></h4>
                        <h4> <?php echo $donnees['Promotion'];?></h4>
                        <p><?php echo $donnees['Fonction'];?><p>
                        <a href="../Compte/detailUtilisateur.php?ID_utilisateur=<?php echo $donnees['ID_utilisateur']?>"><button>Plus d'information</button></a>
                    </div>
                    <?php
                    }
                }
                else{?>          
                    <meta http-equiv="refresh" content="0;URL=detailUtilisateur.php?ID_utilisateur=<?php echo $ID_utilisateur;?>">
                    <?php
                }
            }
            else if(isset($_POST['Login'])){
                if(!$MDPCheck){
                    if(!$LoginCheck){
                        ?><div class="container">
                        <h2 > Le Login n'est pas valide ! </h2> 
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <a href="../Compte/monCompte.php"><button>Mon compte</button></a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <a href="../index.php"><button>Accueil</button></a>
                        </div>
                    </div><?php
                        
                    }else{
                        ?><div class="container">
                        <h2 > Le mot de passe n'est pas valide ! </h2> 
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <a href="../Compte/monCompte.php"><button>Mon compte</button></a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <a href="../index.php"><button>Accueil</button></a>
                        </div>
                    </div><?php
                    }
                }else if($MDPCheck && $LoginCheck){
                    ?>?><div class="container">
                        <h2 > Felecitation vous voila connecté ! </h2> 
                        <meta http-equiv="refresh" content="0;URL=monCompte.php">
                    </div><?php
                }
            }else{ ?>
            <div class="container">
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
                            <div class=" col-lg-1 col-md-1 col-sm-offset-5 col-sm-1">
                                <button type="submit">Connexion</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <?php
            }
            ?>
          </main>
<!------------------------------------------------------------------------------------------------------------------------->

<?php require("../Nav/footer.php"); ?>