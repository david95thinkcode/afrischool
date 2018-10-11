<?php

namespace App\CustomClasses;

class ByTrimestreStats
{
    public $first;
    
    public $second;
    
    public $third;

    public $final;

    public function __construct() { }
    

    public function setFirst($avg) {
        $this->first = $avg;
    }

    public function setSecond ($avg) {
        $this->second = $avg;
    }

    public function setThird($avg) {
        $this->third = $avg;
    }

    public function setFinal($avg) {
        $this->final = $avg;
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
}