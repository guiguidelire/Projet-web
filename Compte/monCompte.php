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
if(isset($_POST['Login'])){
    $LoginCheck = false;
    $MDPCheck = false;
    $requeteLogin =" SELECT ID_utilisateur,`Login`, mdp, ID_fonction 
                FROM utilisateur;";
    $reponseLogin = $conn->query($requeteLogin);
    
    while($donneesLogin = $reponseLogin->fetch()){
        if($donneesLogin['Login']== $_POST['Login']){
            $LoginCheck = true;
            if($donneesLogin['mdp']== $_POST['motDePasse']){
                $MDPCheck = true;
                $IDFonction = $donneesLogin['ID_fonction'];
                setcookie('Login', $_POST['Login'],time()+300,'/');
                setcookie('ID_utilisateur',$donneesLogin['ID_utilisateur'],time()+300,'/');
                setcookie('Fonction',$IDFonction,time()+300,'/');
            }
        }
    }
}
?>

<?php 
$page = "moncompte";
require("../Nav/header.php");
?>

<!------------------------------------------------------------------------------------------------------------------------->

        <main>
            <div class="container">
                <?php 
                
                if(isset($_COOKIE['Login'])){
                    echo "<div class='row'> 
                            <p> Vous etes deja connecté ! </p>
                        </div>";
                }else if(isset($_POST['Login'])){
                    if(!$MDPCheck){
                        if(!$LoginCheck){
                            echo "<p> Le Login n'est pas valide ! </p>";
                        }else{
                            echo "<p> Le mot de passe n'est pas valide ! </p>";
                        }
                    }else if($MDPCheck && $LoginCheck){
                        echo "<div class='row'> 
                          <p> Felecitation vous voila connecté ! </p>
                        </div>";
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
                <?php
                }
                ?>
            </div>
          </main>
<!------------------------------------------------------------------------------------------------------------------------->

<?php require("../Nav/footer.php"); ?>