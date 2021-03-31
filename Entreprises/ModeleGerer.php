<?php
// Nous créons une classe « Personnage ».
class entreprise{
    private $_NomEntreprise;
    private $_NbStagiaire;

    private $_Num;
    private $_Rue;
    private $_Ville;
    private $_CodePostale;
    private $_Pays;

    private $_Secteur;
    private $_ID_Secteur;

            
    
    function __construct($NomEntreprise, $NbStagiaire, $NumRue, $Rue, $Ville, $CP, $Pays, $Secteur){
        $this -> _setNomEntreprise($NomEntreprise);
        $this -> _setNbStagiaire($NbStagiaire);
        $this -> _setNum($NumRue);
        $this -> _setRue($Rue);
        $this -> _setVille($Ville);
        $this -> _setCodePostale($CP);
        $this -> _setPays($Pays);
        $this -> _setSecteur($Secteur);
    }

//--Accesseur------------------------------------------------------------------------------------
    public function _getNomEntreprise(){ return $this->_NomEntreprise;}
    public function _getNbStagiare(){ return $this->_NbStagiare;}
    public function _getNum(){ return $this->_Num;}
    public function _getRue(){ return $this->_Rue;}
    public function _getVille(){ return $this->_Ville;}
    public function _getCodePostale(){ return $this->_CodePostale;}
    public function _getPays(){ return $this->_Pays;}
    public function _getSecteur(){ return $this->_Secteur;}
    public function _getIDSecteur(){ return $this->_ID_Secteur;}


//--------------------------------------------------------------------------------------
//--Mutateur------------------------------------------------------------------------------------

    public function _setNomEntreprise($NomEntreprise){
        $this->_NomEntreprise = strtoupper($NomEntreprise);
    }
    public function _setNbStagiaire($NbStagiaire){
        $this->_NbStagiaire = $NbStagiaire;
    }
    public function _setNum($NumRue){
        $this->_Num = $NumRue;
    }
    public function _setRue($Rue){
        $this->_Rue = $Rue;
    }
    public function _setVille($Ville){
        $this->_Ville = strtoupper($Ville);
    }
    public function _setCodePostale($CP){
        $this->_CodePostale = $CP;
    }
    public function _setPays($Pays){
        $this->_Pays = strtoupper($Pays);
    }
    public function _setSecteur($Secteur){
        $this->_Secteur = $Secteur;
    }
    public function _setIDSecteur($IDSecteur){
        $this->_ID_Secteur = $IDSecteur;
    }

//---------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------

    public function _SelectIDSecteurEntreprise($Secteur){
        $requeteSecteurID ="( SELECT ID_secteur FROM secteur WHERE Secteur_activite LIKE '$Secteur')";
        return $requeteSecteurID;
    }
    public function _InsertEntreprise($connexion){
        $NomEntreprise = $this->_NomEntreprise;
        $NbStagiaire = $this->_NbStagiaire;
        $NumRue = $this->_Num;
        $Rue = $this->_Rue;
        $Ville = $this->_Ville;
        $CP = $this->_CodePostale;
        $Pays = $this->_Pays;
        $Secteur = $this->_Secteur;

        $IDsecteur = self::_SelectIDSecteurEntreprise($Secteur);

        $requete = "INSERT INTO entreprise(Nom, NB_stagiaires_CESI, Numero_rue, Rue, Ville, Code_Postal, Pays) 
                    VALUES('$NomEntreprise','$NbStagiaire','$NumRue','$Rue','$Ville','$CP','$Pays');";
        $connexion->exec($requete);


        $requeteEntrepriseID ="( SELECT ID_entreprise FROM entreprise ORDER BY ID_entreprise DESC LIMIT 1)";
        $requeteTravaille = "INSERT INTO travaille(ID_secteur, ID_entreprise) 
                                VALUES($IDsecteur, $requeteEntrepriseID);";
        $connexion->exec($requeteTravaille);
    }
    public function _VericationEntrepriseExiste($connexion){
        $entrepriseExistedeja = false;
        $nomEntreprise = $this->_NomEntreprise;
        $nbStagiaire = $this->_NbStagiaire;
        $numRue = $this->_Num;
        $rue = $this->_Rue;
        $ville = $this->_Ville;
        $codePostal = $this->_CodePostale;
        $pays = $this->_Pays;
        $Secteur = $this->_Secteur;

        
        $requeteEntrepriseExiste =" SELECT * FROM entreprise ORDER BY ID_entreprise;";
        $reponseEntrepriseExiste = $connexion->query($requeteEntrepriseExiste);
        while($donneesEntrepriseExiste = $reponseEntrepriseExiste->fetch()){
            $deeNom = $donneesEntrepriseExiste['Nom'];
            $deeNumero_rue = $donneesEntrepriseExiste['Numero_rue'];
            $deeRue = $donneesEntrepriseExiste['Rue'];
            $deeVille = $donneesEntrepriseExiste['Ville'];
            $deeCode_postal = $donneesEntrepriseExiste['Code_postal'];
            $deePays = $donneesEntrepriseExiste['Pays'];
            if($deeNom == $nomEntreprise  && $deeNumero_rue == $numRue && $deeRue == $rue && $deeVille == $ville && $deeCode_postal == $codePostal && $deePays == $pays){
                $entrepriseExistedeja = true;
            }
        }
        return $entrepriseExistedeja;
    }
}
