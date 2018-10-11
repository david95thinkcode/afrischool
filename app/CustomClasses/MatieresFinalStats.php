<?php

namespace App\CustomClasses;

/**
 * Détails globaux finaux des matières
 * à la fin de l'année
 */
class MatieresFinalStats
{
    public $key;
    public $label;
    public $avg;
    public $sum;

    public function __construct() 
    {

    }

    public function setKey($key) {
        $this->key = $key;
    }

    public function setLabel($label) {
        $this->label = $label;
    }

    public function setSum($sum) {
        $this->sum = $sum;
    }

    public function setAvg($avg) {
        $this->avg = $avg;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getLabel()
    {
        return $this->label;
    }
    
    
}
