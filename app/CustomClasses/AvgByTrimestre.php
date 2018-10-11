<?php

namespace App\CustomClasses;

class AvgByTrimestre
{
    const NUMBER_OF_TRIMESTRE = 3;
    
    public $first;
    
    public $second;
    
    public $third;
    
    /**
     * Moyenne générale à l'issu des 3 trimestres de
     */
    public $final;
    
    public $notes;
    
    public $finalMatiereStats = [];
    
    public $description = [];

    public function __construct(NoteByTrimestre $notes) 
    {
        $this->notes = $notes;
        $this->calculate();
        $this->fillDescription();
    }
    
    private function calculate() 
    {
        $this->calcultateFirst();
        $this->calcultateSecond();
        $this->calcultateThird();
        $this->populateFinalAttribute();
        $this->calculateMatieresStats();
    }

    /**
     * Calcule la moyenne finale
     * La moyenne finale se détermine en additionnant toutes les 
     * moyennes des trimestres puis en la divisant
     * par le nombre de trimestre qui est 3
     * 
     */
    private function populateFinalAttribute()
    {
        $sum = 0;
        $sum += $this->getFirst() + $this->getSecond() + $this->getFinal();
        $this->final = $sum / self::NUMBER_OF_TRIMESTRE;
    }

    public function getFirst() {
        return $this->first;
    }

    public function getSecond() {
        return $this->second;
    }

    public function getThird() {
        return $this->third;
    }
    

    /**
     * Retourne la moyenne générale à l'issu des trois trimestres
     * @return integer;
     */
    public function getFinal() {
        return $this->final;
    }

    /**
     * Calcule la moyenne finale de chaque matière
     * et les rends accessible dans la propriété : 
     * $finalMatiereStats
     * 
     */
    private function calculateMatieresStats()
    {        
        foreach ($this->notes->getFirst() as $key => $value) {
            $avgs = 0;
            $sums = 0;

            $sums += $value->getAvgs()->getGeneral();
            $sums += $this->notes->getSecond()[$key]->getAvgs()->getGeneral();
            $sums += $this->notes->getThird()[$key]->getAvgs()->getGeneral();
            $avgs = $sums / self::NUMBER_OF_TRIMESTRE;
            
            $f = new MatieresFinalStats();
            $f->setKey($key);
            $f->setLabel($value->getLabel());
            $f->setSum($sums);
            $f->setAvg($avgs);
            $this->pushToStats($f);
        }
    }

    private function pushToStats(MatieresFinalStats $m) {
        array_push($this->finalMatiereStats, $m);
    }

    /**
     * Calcule la moyenne générale du 1er trimestre
     */
    private function calcultateFirst() {
        $avgSums = 0;

        foreach ($this->notes->getFirst() as $key => $value) {
            $avgSums += $value->getAvgs()->getGeneral();
        }
        $this->first = $avgSums;
    }

    /**
     * Calcule la moyenne générale du 2e trimestre
     */
    private function calcultateSecond() {
        $avgSums = 0;
        foreach ($this->notes->getSecond() as $key => $value) {
            $avgSums += $value->getAvgs()->getGeneral();
        }

        $this->second = $avgSums;
    }
    
    /**
     * Calcule la moyenne générale du 3e trimestre
     */
    private function calcultateThird() {
        $avgSums = 0;
        foreach ($this->notes->getThird() as $key => $value) {
            $avgSums += $value->getAvgs()->getGeneral();
        }

        $this->third = $avgSums;
    }

    /**
     * Ajoute une description à l'objet
     */
    private function fillDescription() {

        $text = [
            "first" => "moyenne générale du premier trimestre \n",
            "second" => "mouyenne générale du 2e trimestre \n",
            "third" => "moyenne générale du troisième trimestre \n",
            "final" => "moyenne finale à l'issue des trois trimestres\n",
            "notes" => "notes des matières par trimestre \n",
            "finalMatiereStats" => "moyenne générale de chaque matière à l'issue des trois trimestres \n"
        ];
        $this->description = $text;
    }
}
