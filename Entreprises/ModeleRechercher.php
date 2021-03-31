
<?php
class recherche{
    private $_ServerName = 'localhost';
    private $_DBName = 'bdd_cesi_stage';
    private $_Username = 'root';
    private $_Password = '';

    private $_searchName;
    private $_searchPlace;
    private $_searchSecteur;

    public function __construct($SN, $SP, $SS){
        $this->_setSearchName($SN);
        $this->_setSearchPlace($SP);
        $this->_setSearchSecteur($SS);
    }

    public function _getSearchName(){return $this->_searchName;}
    public function _getSearchPlace(){return $this->_searchPlace;}
    public function _getSearchSecteur(){return $this->_searchSecteur;}

    public function _setSearchName($var){$this->_searchName = $var;}
    public function _setSearchPlace($var){$this->_searchPlace = $var;}
    public function _setSearchSecteur($var){$this->_searchSecteur = $var;}

    public function _getBdd(){
        try{
            $conn = new PDO("mysql:host=$this->_ServerName;dbname=$this->_DBName", $this->_Username, $this->_Password);
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
    public function _requeteRecherche($conn){
        $requete =" SELECT entreprise.Nom, secteur.Secteur_activite, entreprise.Ville, entreprise.ID_entreprise
                    FROM entreprise
                    INNER JOIN travaille ON travaille.ID_entreprise = entreprise.ID_entreprise 
                    INNER JOIN secteur ON travaille.ID_secteur = secteur.ID_secteur";
        $test = 0;
        if($this->_searchSecteur !== NULL || $this->_searchPlace!== NULL || $this->_searchName!== NULL){
            $requete =" $requete WHERE";
            if($this->_searchSecteur !== NULL){
                $requete =" $requete secteur.Secteur_activite LIKE '$this->_searchSecteur%'";
                $test = 1;
            }
            if($this->_searchPlace !== NULL){
                if($test == 1){
                    $requete = " $requete AND";
                }
                $requete = " $requete entreprise.Ville LIKE '$this->_searchPlace%'";
                $test =1;
            }
            if($this->_searchName !== NULL){
                if($test == 1){
                    $requete = " $requete AND";
                }
                $requete = " $requete entreprise.Nom LIKE '$this->_searchName%'";
            }
            $requete = " $requete GROUP BY entreprise.Ville";
        }
        $reponse = $conn->query($requete);
        return $reponse;
    }
    public function _requeteTouteEntreprises($conn){
        $requete =" SELECT Nom, Secteur_activite, entreprise.Ville, entreprise.ID_entreprise
                    FROM entreprise
                    INNER JOIN travaille ON travaille.ID_entreprise = entreprise.ID_entreprise 
                    INNER JOIN secteur ON travaille.ID_secteur = secteur.ID_secteur 
                    ORDER BY entreprise.Ville
                    DESC LIMIT 12";
        $reponse = $conn->query($requete);
        return $reponse;
    }
}
?>