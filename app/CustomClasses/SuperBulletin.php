<?php

namespace App\CustomClasses;

use App\Models\Inscription;


/**
 * Objet représentant le bulletin d'un individu
 */
class SuperBulletin
{
    const NUMBER_OF_TRIMESTRE = 3;
    
    public $eleve;

    public $ranges; 
    
    public $points; 

    public $appreciations;

    public $avg; // AVGBYTRIMESTRE OBJECT
    
    public $friendsAvg = [];

    public $effectif;

    public $description;
    
    public function __construct($avgByTrimestreObject) 
    {
        if ((!$avgByTrimestreObject instanceof AvgByTrimestre)) 
        {
            throw new \Exception('Bad instanciation of SuperBulletin Object : The parameter should be an AvgByTrimestre Object');
        } 
        else {
            $this->avg = $avgByTrimestreObject;
            $this->ranges = new RangeByTrimestre();
            $this->points = new PointByTrimestre();
            $this->appreciations = new AppreciationByTrimestre();
            $this->fillDescription();
        }
    }

    public function getEleve() {
        return $this->eleve;
    }

    public function setEleve(Inscription $inscription)
    {
        $this->eleve = $inscription;
    }

    /**
     * @param AvgByTrimestre $friendAvgByTrimestreObject
     * @return mixed
     */
    public function addFriendAvg($friendAvgByTrimestreObject)
    {
        if ($friendAvgByTrimestreObject instanceof AvgByTrimestre) {
            array_push($this->friendsAvg, $friendAvgByTrimestreObject);
        } else {
            throw new \Exception('Trying to add unhautorized object type : The parameter should be an AvgByTrimestre Object');
        }
    }

    /**
     * Fais toutes les opérations
     * afin de rendre toutes les données
     * disponbles dans l'objet
     */
    public function finish()
    {
        if (!($this->eleve instanceof Inscription)) {
            throw new \Exception("Can't run because the method setEleve(InscriptionObject) is never used !");
        }
        else {
            $this->calculateRanges();
            $this->calculateSums();
            $this->populateEffectif();
            $this->appreciate();
        }
    }

    private function appreciate() 
    {
        $this->appreciations->setFirst(AvgAppreciation::getAppreciation($this->avg->getFirst()));
        $this->appreciations->setSecond(AvgAppreciation::getAppreciation($this->avg->getSecond()));
        $this->appreciations->setThird(AvgAppreciation::getAppreciation($this->avg->getThird()));
        $this->appreciations->setFinal(AvgAppreciation::getAppreciation($this->avg->getFinal()));
    }

    private function calculateSums () 
    {
        // foreach ($this->friendsAvg as $key => $value) {
        //     $this->points->setFirst($this->points->getFirst() + $value)
        //     array_push($firstAveragesOfFriends, $value->getFirst());
        //     array_push($secondAveragesOfFriends, $value->getSecond());
        //     array_push($thirdAveragesOfFriends, $value->getThird());
        //     array_push($finalAveragesOfFriends, $value->getFinal());
        // }
    }

    private function populateEffectif() 
    {
        $this->effectif = count($this->friendsAvg) + 1;
    }

    private function calculateRanges() 
    {
        $firstAveragesOfFriends = [];
        $secondAveragesOfFriends = [];
        $thirdAveragesOfFriends = [];
        $finalAveragesOfFriends = [];

        // Récupérons les moyennes de chaque trimestre pour ses camarades
        foreach ($this->friendsAvg as $key => $value) {
            array_push($firstAveragesOfFriends, $value->getFirst());
            array_push($secondAveragesOfFriends, $value->getSecond());
            array_push($thirdAveragesOfFriends, $value->getThird());
            array_push($finalAveragesOfFriends, $value->getFinal());
        }

        // Prevents against false returning of getRange() method
        array_push($firstAveragesOfFriends, $this->avg->getFirst());
        array_push($secondAveragesOfFriends, $this->avg->getSecond());
        array_push($thirdAveragesOfFriends, $this->avg->getThird());
        array_push($finalAveragesOfFriends, $this->avg->getFinal());

        // Attribution des rangs
        $this->ranges->setFirst($this->getRange($this->avg->getFirst(), $firstAveragesOfFriends));
        $this->ranges->setSecond($this->getRange($this->avg->getSecond(), $secondAveragesOfFriends));
        $this->ranges->setThird($this->getRange($this->avg->getThird(), $thirdAveragesOfFriends));
        $this->ranges->setFinal($this->getRange($this->avg->getFinal(), $finalAveragesOfFriends));
    }

    /**
     * Retourne le rang correspondant à une
     * moyenne reçue en paramètre dans un lot de
     * moyennes
     *
     * @param float $avg 
     * @param array $avgArray
     * @return int
     */
    private function getRange($avg, $avgArray)
    {        
        $range = 1;

        if (count($avgArray) > 0) {
            rsort($avgArray);
            $range = array_search($avg, $avgArray);
            $range ++; // important
        }
        
        return $range;
    }  

    /**
     * Ajoute une description à l'objet
     */
    private function fillDescription() {

        $this->description = [
            "eleve"         => "Contient les informations sur l'élève dont le bulletin est élaboré",
            "ranges"        => "Les rangs par trimestre \n",
            "points"        => "Le total de points obtenus\n",
            "appreciations" => "Les appreciations obtenus pour chaque trimestre\n",
            "avg"           => "Les moyennes par trimestre de l'élève\n",
            "effectif"      => "Le nombre total d'élèves de la classe\n",
            "friendsAvg"    => "Les moyennes par trimestres des autres camarades de classe",
        ];
    }
}

class RangeByTrimestre extends ByTrimestreStats { }

class PointByTrimestre extends ByTrimestreStats { }

class AppreciationByTrimestre extends ByTrimestreStats { }