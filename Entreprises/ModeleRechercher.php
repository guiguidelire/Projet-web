
<?php
function getBdd(){
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
    return $conn;
}
function requeteRecherche($searchNom, $searchLocalisation, $searchSecteur,$conn){
    $requete =" SELECT entreprise.Nom, secteur.Secteur_activite, entreprise.Ville, entreprise.ID_entreprise
                FROM entreprise
                INNER JOIN travaille ON travaille.ID_entreprise = entreprise.ID_entreprise 
                INNER JOIN secteur ON travaille.ID_secteur = secteur.ID_secteur";
    $test = 0;
    if($searchSecteur != NULL || $searchLocalisation!= NULL || $searchNom!= NULL){
        $requete =" $requete WHERE";
        if($searchSecteur != NULL){
            $requete =" $requete secteur.Secteur_activite LIKE '$searchSecteur%'";
            $test = 1;
        }
        if($searchLocalisation!= NULL){
            if($test == 1){
                $requete = " $requete AND";
            }
            $requete = " $requete entreprise.Ville LIKE '$searchLocalisation%'";
            $test =1;
        }
        if($searchNom!= NULL){
            if($test == 1){
                $requete = " $requete AND";
            }
            $requete = " $requete entreprise.Nom LIKE '$searchNom%'";
        }
        $requete = " $requete GROUP BY entreprise.Ville";
    }
    $reponse = $conn->query($requete);
    return $reponse;
}
function requeteTouteEntreprises($conn) {
    $requete =" SELECT Nom, Secteur_activite, entreprise.Ville, entreprise.ID_entreprise
                FROM entreprise
                INNER JOIN travaille ON travaille.ID_entreprise = entreprise.ID_entreprise 
                INNER JOIN secteur ON travaille.ID_secteur = secteur.ID_secteur 
                ORDER BY entreprise.Ville
                DESC LIMIT 12";
    $reponse = $conn->query($requete);
    return $reponse;
    }

?>