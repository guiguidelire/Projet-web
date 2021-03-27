<?php
// Nous créons une classe « Personnage ».
class utilisateur{
    private $_Nom;
    private $_Prenom;
    private $_Login;
    private $_password;

    private $_centre;
    private $_ID_centre;

    private $_fonction;
    private $_ID_fonction;

    private $_promotion;
    private $_ID_promotion;
            
    
    function __construct($Nom, $Prenom, $Promotion, $Centre, $Fonction){
        $this -> _setNom($Nom);
        $this -> _setPrenom($Prenom);
        $this -> _CreationLogin();
        $this -> _CreationPassword();
        $this -> _setPromotion($Promotion);
        $this -> _setCentre($Centre);
        $this -> _setFonction($Fonction);
    }
    public function _getUtilisateur()
    {
        return $_Nom;
    }
    public function _getNom(){ return $this->_Nom;}
    public function _getPrenom(){ return $this->_Prenom;}
    public function _getLogin(){ return $this->_Login;}
    public function _getPassword(){ return $this->_password;}
    public function _getIDCentre(){ return $this->_IDCentre;}
    public function _getCentre(){ return $this->_Centre;}
    public function _getIDFonction(){ return $this->_IDFonction;}
    public function _getFonction(){ return $this->_Fonction;}
    public function _getIDPromotion(){ return $this->_IDPromotion;}
    public function _getPromotion(){ return $this->_Promotion;}
//--------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------

    public function _setNom($Nom){
        $this->_Nom = self::_TransformNom($Nom);
    }
    public function _setPrenom($Prenom){
        $this->_Prenom = self::_TransformPrenom($Prenom);
    }
    public function _setLogin($Login){
        $this->_Login = $Login;
    }
    public function _setPassword($Password){
        $this->_Password = $Password;
    }
    public function _setIDCentre($IDCentre){
        $this->_IDCentre = $IDCentre;
    }
    public function _setCentre($Centre){
        $this->_Centre = $Centre;
    }
    public function _setIDFonction($IDFonction){
        $this->_IDFonction = $IDFonction;
    }
    public function _setFonction($Fonction){
        $this->_Fonction = $Fonction;
    }
    public function _setIDPromotion($IDPromotion){
        $this->_IDPromotion = $IDPromotion;
    }
    public function _setPromotion($Promotion){
        $this->_Promotion = $Promotion;
    }
//---------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------
    public function _SelectIDPromotionUtilisateur($Promotion){
        $requetePromotionID ="( SELECT ID_promotion FROM promotion WHERE Promotion LIKE '$Promotion')";
        return $requetePromotionID;
    }
    public function _SelectIDCentreUtilisateur($centre){
        $requeteCentreID ="( SELECT ID_centre FROM centre WHERE Nom_centre LIKE '$centre')";
        return $requeteCentreID;
    }
    public function _SelectIDFonctionUtilisateur($Fonction){
        $requeteFonctionID ="( SELECT ID_fonction FROM role WHERE Fonction LIKE '$Fonction')";
        return $requeteFonctionID;
    }
    public function _InsertUtilisateur($connexion){
        $nom = $this->_Nom;
        $Prenom = $this->_Prenom;
        $Login = $this->_Login;
        $password = $this->_Password;
        $centre = $this->_Centre;
        $Fonction = $this->_Fonction;
        $Promotion = $this->_Promotion;
        $IDCentre = self::_SelectIDCentreUtilisateur($centre);
        $IDFonction = self::_SelectIDFonctionUtilisateur($Fonction);
        $IDPromotion = self::_SelectIDPromotionUtilisateur($Promotion);
        $requete = "INSERT INTO utilisateur(Nom, Prenom, `Login`,mdp, ID_centre, ID_fonction, ID_promotion) 
                    VALUES('$nom','$Prenom','$Login','$password',$IDCentre,$IDFonction,$IDPromotion);";
        $connexion->exec($requete);
    }
//------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------
    public function _CreationLogin(){
        $nom = $this->_Nom;
        $Prenom = $this->_Prenom;
        $nomTableau = str_split($nom, $length = 1);
        $PrenomTableau = str_split($Prenom, $length = 1);
        $Login = strtoupper($PrenomTableau[0]).$PrenomTableau[1].$PrenomTableau[2].$nom;
        self::_setLogin($Login);
    }
    public function _CreationPassword(){
        $nom = $this->_Nom;
        $Prenom = $this->_Prenom;
        $nomTableau = str_split($nom, $length = 1);
        $PrenomTableau = str_split($Prenom, $length = 1);
        $Password = $PrenomTableau[0].$PrenomTableau[1].rand(10,99).strtoupper($nomTableau[0].$nomTableau[1]).rand(10,99).'&*';
        self::_setPassword($Password);
    }
    public function _TransformPrenom($Prenom){
        $Prenom = strtolower($Prenom);
        $PrenomTableau = str_split($Prenom, $length = 1);
        $PrenomTableau[0] = strtoupper($PrenomTableau[0]);
        $Prenom = "";
        foreach($PrenomTableau as $lettre){
            $Prenom .= $lettre;
        }
        return $Prenom;
    }
    public function _TransformNom($Nom){
        $Nom = strtoupper($Nom);
        return $Nom;
    }
}
