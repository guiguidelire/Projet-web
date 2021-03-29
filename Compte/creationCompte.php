<?php 
require("../Assets/ConnexionBDD.php");
//$conn : connexion bdd  
require("./POO.php");
$page = "creationutilisateur";
require("../Nav/header.php");
?>

<!------------------------------------------------------------------------------------------------------------------------->

        <main>
            <?php
            if(!isset($_COOKIE['ID_utilisateur'])){
                ?>
                    <h1 class="col-lg-12 col-md-12 col-sm-12">Veuillez vous connecter en temps qu'admistrateur ou tuteur</h1>
                <?php
                }
                else{
                    if($_COOKIE['Fonction']==1 || $_COOKIE['Fonction']==3){?>
                        <div class="container">
                        <?php
                        $requetePromotion =" SELECT ID_promotion,Promotion FROM promotion ORDER BY Promotion;";
                        $requeteCentre =" SELECT ID_centre, Nom_centre FROM centre;";
                        $requeteRole =" SELECT ID_fonction, Fonction FROM `role`;";
                        if(isset($_POST['selectCentre'])){

                            //POO creation de l'utilisateur
                            $user = new utilisateur($_POST['Nom'],$_POST['Prenom'],$_POST['selectPromotion'],$_POST['selectCentre'],$_POST['selectRole']);
                            //POO Insertion de l'utilisateur dans la bdd
                            $user -> _InsertUtilisateur($conn);
                            //POO Recupration de son nom et son prenom
                            $Prenom = $user->_getPrenom();
                            $Nom = $user->_getNom();
                            $mdp = $user->_getPassword();
                            $login = $user->_getLogin();
                        }      
                        ?>
            <!--Formulaire pour la creation d'un utilisateur---------------------------------------------------------------------
            --------------------Affichage de l'utilisateur créé----------------------------------------------------------------->
                            <form class="form-horizontal" action="./creationCompte.php" method="post">
                                <?php if(isset($_POST['selectCentre'])){ ?>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p><?php 
                                        echo "Utilisateur<strong> $Prenom $Nom </strong>créé !"?></p>
                                        <p><?php 
                                        echo "Avec le login :<strong> $login </strong> et le mot de passe :<strong> $mdp </strong>"?></p>
                                    </div>
                                </div>
                                <?php } ?>
                                <br>
            <!---------Nom de l'utilisateur------------------------------------------------------------------------------------------------>
                                <div class="row">
                                    <div class="form-group ">
                                        <label class="control-label col-sm-2 col-sm-offset-3" for="Nom">Nom :</label>
                                        <div class="col-sm-3">
                                            <input type="texte" class="form-control" id="Nom" name="Nom" placeholder="Entrer le nom de l'utilisateur" required>
                                        </div>
                                    </div>
                                </div>
            <!-----------Prenom de l'utilisateur------------------------------------------------------------------------------------------->
                                <div class="row">
                                    <div class="form-group ">
                                        <label class="control-label col-sm-2 col-sm-offset-3" for="Prenom">Prénom :</label>
                                        <div class="col-sm-3">
                                            <input type="texte" class="form-control" id="Prenom" name="Prenom" placeholder="Entrer le prénom de l'utilisateur" autocapitalize="words" required>
                                        </div>
                                    </div>
                                </div><br>
            <!----------Promotion de l'utilisateur en select recuperer de la bdd----------------------------------------------------------->
                                <div class="row">
                                    <div class="form-group ">
                                        <label class="control-label col-sm-2 col-sm-offset-3" for="selectPromotion">Promotion :</label>
                                        <div class="col-sm-3">
                                            <select class="form-control" id="selectPromotion" name="selectPromotion" required>
                                                <option value="">--Choisissez une promotion--</option>
                                                <option value="NONE">Aucune promotion</option>
                                                <?php
                                                $reponsePromotion = $conn->query($requetePromotion);
                                                while($donneesPromotion = $reponsePromotion->fetch()){
                                                    $Promotion = $donneesPromotion['Promotion']
                                                    ?><option value=<?php echo $Promotion?>><?php echo $Promotion?></option><?php
                                                } 
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
            <!------Centre de l'utilisateur en select recuperer de la bdd------------------------------------------------------------------>
                                <div class="row">
                                    <div class="form-group ">
                                        <label class="control-label col-sm-2 col-sm-offset-3" for="selectCentre">Centre :</label>
                                        <div class="col-sm-3">
                                            <select class="form-control" id="selectCentre" name="selectCentre" required>
                                                <option value="">--Choisissez un centre--</option>
                                                <?php
                                                $reponseCentre = $conn->query($requeteCentre);
                                                while($donneesCentre = $reponseCentre->fetch()){
                                                    $centre = $donneesCentre['Nom_centre']
                                                    ?><option value=<?php echo $centre?>><?php echo $centre?></option><?php
                                                } 
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
            <!-----Fonction de l'utilisateur en select recuperer de la bdd------------------------------------------------------------------>
                                <div class="row">
                                    <div class="form-group ">
                                        <label class="control-label col-sm-2 col-sm-offset-3" for="selectRole">Role :</label>
                                        <div class="col-sm-3">
                                            <select class="form-control" id="selectRole" name="selectRole" required>
                                                <option value="">--Choisissez un role--</option>
                                                <?php
                                                $reponseRole = $conn->query($requeteRole);
                                                while($donneesRole = $reponseRole->fetch()){
                                                    $role = $donneesRole['Fonction']
                                                    ?><option value=<?php echo $role?>><?php echo $role?></option><?php
                                                } 
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
            <!-------Submit et reset-------------------------------------------------------------------------------------------------------->
                                <div class="row">
                                    <div class="form-group">
                                        <div class=" col-lg-1 col-md-1 col-sm-offset-5 col-sm-1">
                                            <button type="submit">Créer</button>
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-1 ">
                                            <button type="reset">Réinitialiser</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php
                    }
                    else{
                        ?>
                            <h1 class="col-lg-12 col-md-12 col-sm-12">Veuillez vous connecter en temps qu'admistrateur ou tuteur</h1>
                        <?php
                    }
                }
            ?>
          </main>
<!------------------------------------------------------------------------------------------------------------------------->
        
<?php require("../Nav/footer.php"); ?>