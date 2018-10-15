<?php

namespace App\CustomClasses;

class AboutEleve
{
    /**
     * Identifiant dans la table " inscriptions "
     */
    public $matricule;
    public $eleveKey;
    public $eleveNom;
    public $elevePrenoms;
    public $sex;

    /**
     * @param integer $inscriptionID
     * @param integer $eleveID
     */
    public function __construct($inscriptionID, $eleveID) 
    {
        $this->matricule = $inscriptionID;
        $this->eleveKey = $eleveID;
    }
    
    public function setNom ($nom) {
        $this->eleveNom = $nom;
    }
    
    public function setPrenom ($prenom) {
        $this->elevePrenoms = $prenom;
    }
    
    public function setSex ($sexe) {
        $this->sex = $sexe;
    }

    public function getNom() {
        return $this->eleveNom;
    }
    
    public function getSex() {
        return $this->sex;
    }

    public function getPrenom() {
        return $this->elevePrenoms;
    }

    /**
     * Retourne l'identifiant de l'élève
     */
    public function getEleve() {
        return $this->eleveKey;
    }

    /**
     * Retourne l'identifiant de l'inscription de l'élève
     */
    public function getMatricule() {
        return $this->matricule;
    }

}
