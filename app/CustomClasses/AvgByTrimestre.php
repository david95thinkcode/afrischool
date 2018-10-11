<?php

namespace App\CustomClasses;

class AvgByTrimestre
{
    public $first;

    public $second;

    public $third;

    public $notes;

    public $finalMatiereStats = [];

    public function __construct(NoteByTrimestre $notes) 
    {
        $this->notes = $notes;
        $this->calculate();
    }
    
    private function calculate() 
    {
        $this->calcultateFirst();
        $this->calcultateSecond();
        $this->calcultateThird();
        $this->calculateMatieresStats();
    }

    /**
     * Calcule la moyenne finale des matières
     */
    private function calculateMatieresStats()
    {
        $numberOfTrimestre = 3;
        
        foreach ($this->notes->getFirst() as $key => $value) {
            $avgs = 0;
            $sums = 0;

            $sums += $value->getAvgs()->getGeneral();
            $sums += $this->notes->getSecond()[$key]->getAvgs()->getGeneral();
            $sums += $this->notes->getThird()[$key]->getAvgs()->getGeneral();
            $avgs = $sums / $numberOfTrimestre;
            
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

    private function calcultateFirst() {
        $avgSums = 0;

        foreach ($this->notes->getFirst() as $key => $value) {
            $avgSums += $value->getAvgs()->getGeneral();
        }
        // dd($this->notes->getSecond()[0]->getAvgs());
        $this->first = $avgSums;
    }
    
    private function calcultateSecond() {
        $avgSums = 0;
        foreach ($this->notes->getSecond() as $key => $value) {
            $avgSums += $value->getAvgs()->getGeneral();
        }

        $this->second = $avgSums;
    }
    
    private function calcultateThird() {
        $avgSums = 0;
        foreach ($this->notes->getThird() as $key => $value) {
            $avgSums += $value->getAvgs()->getGeneral();
        }

        $this->third = $avgSums;
    }
}
