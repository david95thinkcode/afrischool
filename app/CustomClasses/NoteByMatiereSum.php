<?php

namespace App\CustomClasses;


class NoteByMatiereSum
{

    public $interrogation;
    public $devoir;
    public $examen;
    public $general;

    public function __construct() { 
        $this->setInterro(0);
        $this->setDevoir(0);
        $this->setExam(0);
    }    

    public function setInterro($somme)
    {
        $this->interrogation = $somme;
    }

    public function setDevoir($somme)
    {
        $this->devoir = $somme;
    }

    public function setExam($somme)
    {
        $this->examen = $somme;
    }

    public function setGeneral($somme)
    {
        $this->general = $somme;
    }

    public function getInterro()
    {
        return $this->interrogation;
    }

    public function getDevoir()
    {
        return $this->devoir;
    }

    public function getExam()
    {
        return $this->examen;
    }

    public function getGeneral()
    {
        return $this->general;
    }
}
