<?php

namespace App\CustomClasses;

use App\CustomClasses\NoteByMatiere;

class NoteByTrimestre
{
    public $first = [];

    public $second = [];

    public $third = [];

    public function __construct() {}

    public function getFirst() {
        return $this->first;
    }

    public function getSecond() {
        return $this->second;
    }

    public function getThird() {
        return $this->third;
    }

    public function pushToFirst(NoteByMatiere $notes)
    {
        array_push($this->first, $notes);
    }
    
    public function pushToSecond(NoteByMatiere $notes)
    {
        array_push($this->second, $notes);
    }
    
    public function pushToThird(NoteByMatiere $notes)
    {
        array_push($this->third, $notes);
    }
}
