<?php
// Nous créons une classe « Personnage ».
class offre{
    private $_Duree;
    private $_Debut;
    private $_NbPlace;
    private $_Remuneration;
    private $_NomEntreprise;
    private $_Description;
    private $_Promotions = array();
    private $_IDPromotions = array();

    private $_Competences = array();
    private $_IDCompetences = array();

            
    
    function __construct($Duree, $Debut, $NbPlace, $Remuneration, $Nom, $Description, $Promotion, $Competences){
        $this -> _setDuree($Duree);
        $this -> _setDebut($Debut);
        $this -> _setNbPlace($NbPlace);
        $this -> _setRemuneration($Remuneration);
        $this -> _setNomEntreprise($Nom);
        $this -> _setDescription($Description);
        $this -> _setPromotions($Promotion);
        $this -> _setCompetences($Competences);
    }

//--Accesseur------------------------------------------------------------------------------------
    public function _getDuree(){ return $this->_Duree;}
    public function _getDebut(){ return $this->_Debut;}
    public function _getNbPlace(){ return $this->_NbPlace;}
    public function _getRemuneration(){ return $this->_Remuneration;}
    public function _getNomEntreprise(){ return $this->_NomEntreprise;}
    public function _getDescription(){ return $this->_Description;}
    public function _getPromotions(){ return $this->_Promotions;}
    public function _getCompetences(){ return $this->_Competences;}


//--------------------------------------------------------------------------------------
//--Mutateur------------------------------------------------------------------------------------

    public function _setDuree($Duree){
        $this->_Duree = $Duree;
    }
    public function _setDebut($Debut){
        $this->_Debut = $Debut;
    }
    public function _setNbPlace($NbPlace){
        $this->_NbPlace = $NbPlace;
    }
    public function _setRemuneration($Remuneration){
        $this->_Remuneration = $Remuneration;
    }
    public function _setNomEntreprise($Nom){
        $this->_NomEntreprise = strtoupper($Nom);
    }
    public function _setDescription($Description){
        $this->_Description = $Description;
    }
    public function _setPromotions($Promotions){
        array_push($this->_Promotions, $Promotions);
    }
    public function _setCompetences($Competences){
        $this->_Competences[] = $Competences;
    }

//---------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------

    public function _SelectIDPromotionOffre($Promotion){
        $requetePromotionD ="( SELECT ID_promotion FROM promotion WHERE Promotion LIKE '$Promotion)";
        return $requetePromotionID;
    }
    public function _SelectIDCompetenceOffre($Competence){
        $requeteCompetenceID ="( SELECT ID_competences FROM competences WHERE competences LIKE '$Competence')";
        return $requeteCompetenceID;
    }

//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
    public function _InsertOffre($connexion){
        $duréeStage = $this-> _Duree;
        $dateDebutStage = $this-> _Debut;
        $nbPlace = $this-> _NbPlace;
        $remuneration = $this-> _Remuneration;
        $creationOffreEntreprise = $this->  _NomEntreprise;
        $descriptionStageCreation = $this-> _Description;

        $requeteOffre = "INSERT INTO offres_stages(Duree_stage, Date_offre, NB_place, Remuneration, ID_entreprise, `Description`) 
                            VALUES('$duréeStage','$dateDebutStage','$nbPlace','$remuneration',(
                                SELECT ID_entreprise FROM entreprise 
                                WHERE Nom LIKE '$creationOffreEntreprise'
                            ),'$descriptionStageCreation');";
        $connexion->exec($requeteOffre); 
    }

    public function _InsertConcerne($connexion,$Promotions){
        foreach($Promotions as $promotionConcerne){
            $requeteOffreConcerne = "INSERT INTO concerne(ID_promotion, ID_offre)
                                    VALUES(self::_SelectIDPromotionOffre($promotionConcerne),(SELECT ID_offre FROM offres_stages ORDER BY ID_offre DESC LIMIT 1));";
            $connexion->exec($requeteOffreConcerne); 
        }
    }
        
    public function _InsertNecessite($connexion,$Competences){
        foreach($Competences as $competenceNecessite){
            $requeteOffreNecessite = "INSERT INTO necessite(ID_competences, ID_offre)
                                    VALUES(self::_SelectIDCompetenceOffre($competenceNecessite),(SELECT ID_offre FROM offres_stages ORDER BY ID_offre DESC LIMIT 1));";
            $connexion->exec($requeteOffreNecessite); 
        }
    }

//---------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------
    public function _VericationEntrepriseExiste($connexion){
        $entrepriseExiste = false;
        $nomEntreprise = $this->_NomEntreprise;

        $requeteEntreprise ="SELECT Nom FROM entreprise";
        $reponseEntreprise = $connexion->query($requeteEntreprise);

        while($donneesEntreprise = $reponseEntreprise->fetch()){
            if($donneesEntreprise['Nom']==$nomEntreprise){
                $entrepriseExiste = true;
            }
        }   
        return $entrepriseExiste;
    }
}
