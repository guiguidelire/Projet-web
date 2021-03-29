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

    function star($nb_star){
        for ($i = 1; $i <= 5; $i++) {
            if($nb_star >= 1){?>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                </svg>
                <?php
                $nb_star = $nb_star-1;
            }
            else if($nb_star >= 0.5){?>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-half" viewBox="0 0 16 16">
                <path d="M5.354 5.119L7.538.792A.516.516 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.537.537 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.519.519 0 0 1-.146.05c-.341.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.171-.403.59.59 0 0 1 .084-.302.513.513 0 0 1 .37-.245l4.898-.696zM8 12.027c.08 0 .16.018.232.056l3.686 1.894-.694-3.957a.564.564 0 0 1 .163-.505l2.906-2.77-4.052-.576a.525.525 0 0 1-.393-.288L8.002 2.223 8 2.226v9.8z"/>
                </svg>
                <?php
                $nb_star = $nb_star-0.5;
            }
            else{?>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                </svg>
            <?php
            }
        }
    }

    function recherche($searchNom, $searchLocalisation){
        $requete = "SELECT * FROM entreprise 
                    INNER JOIN travaille ON entreprise.ID_entreprise = travaille.ID_entreprise
                    INNER JOIN secteur ON travaille.ID_secteur = secteur.ID_secteur
                    LEFT JOIN offres_stages ON entreprise.ID_entreprise = offres_stages.ID_entreprise
                    LEFT JOIN evaluer ON evaluer.ID_entreprise = entreprise.ID_entreprise 
                    WHERE entreprise.Nom LIKE '$searchNom%' AND entreprise.Ville LIKE '$searchLocalisation%'
                    ORDER BY entreprise.Ville
                    DESC LIMIT 1";
        return $requete;
    }

    function Moyenne($searchNom, $searchLocalisation){
        $requete = "SELECT AVG(`Ambiance`) AS avgAmbiance, AVG(`Accueil_entreprise`) AS avgAccueil_entreprise, 
                    AVG(`Accompagnement_etudiants`) AS avgAccompagnement_etudiants, AVG(`Taux_apprentissage`) AS avgTaux_apprentissage, 
                    `Nom`, `NB_stagiaires_CESI`, `Numero_rue`, `Rue`, `Ville`, `Code_postal`, `Pays`, `Secteur_activite`,
                    `Description`, `NB_place`, `Remuneration`, `Date_offre`, `Duree_stage`, entreprise.ID_entreprise 
                    FROM entreprise 
                    INNER JOIN travaille ON entreprise.ID_entreprise = travaille.ID_entreprise
                    INNER JOIN secteur On travaille.ID_secteur = secteur.ID_secteur
                    INNER JOIN evaluer ON evaluer.ID_entreprise = entreprise.ID_entreprise
                    LEFT JOIN offres_stages ON entreprise.ID_entreprise = offres_stages.ID_entreprise 
                    WHERE entreprise.Nom LIKE '$searchNom%' AND entreprise.Ville LIKE '$searchLocalisation%'
                    ORDER BY entreprise.Ville";
        return $requete;
    }
    function vote($searchNom, $searchLocalisation, $conn, $ID_utilisateur){
        $requete2 = "SELECT * FROM entreprise 
                    LEFT JOIN evaluer ON evaluer.ID_entreprise = entreprise.ID_entreprise 
                    WHERE entreprise.Nom LIKE '$searchNom%' AND entreprise.Ville LIKE '$searchLocalisation%'
                    ORDER BY entreprise.Ville";
                    $reponse = $conn->query($requete2);
        while($donnees = $reponse->fetch()){
            if($ID_utilisateur == $donnees['ID_utilisateur']){
                $vote = true;
                break;
            }else{
                $vote = false;
            }
        }
        return $vote;
    }

    function InsertInto($ID_entreprise, $ID_utilisateur, $Ambiance, $Accueil_entreprise, $Accompagnement_etudiants, $Taux_apprentissage, $conn){
        $send = "INSERT INTO evaluer(`ID_entreprise`, `ID_utilisateur`, `Ambiance`, `Accueil_entreprise`, `Accompagnement_etudiants`, `Taux_apprentissage`) 
                VALUES('$ID_entreprise', $ID_utilisateur, $Ambiance, $Accueil_entreprise, $Accompagnement_etudiants, $Taux_apprentissage);";
        $conn->exec($send);
    }

    function ListeEntreprise($searchNom, $searchLocalisation, $conn){
        $requete = "SELECT * FROM entreprise 
                    RIGHT JOIN offres_stages ON entreprise.ID_entreprise = offres_stages.ID_entreprise
                    WHERE entreprise.Nom LIKE '$searchNom%' AND entreprise.Ville LIKE '$searchLocalisation%'
                    ORDER BY entreprise.Ville";
        $reponse = $conn->query($requete);
        return $reponse;
    }

?>