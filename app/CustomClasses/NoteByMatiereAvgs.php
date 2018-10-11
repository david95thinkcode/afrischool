<?php

namespace App\CustomClasses;

/**
 * Représente les moyennes pour les objects
 *  NoteByMatiere
 */
class NoteByMatiereAvgs
{
    const CODE_INTERROGATION = 1;
    const CODE_DEVOIR = 2;
    const CODE_EXAMEN = 3;

    public $interrogation;
    public $devoir;
    public $examen;
    public $general;

    public function __construct() { }    

    public function setInterro($moyenne)
    {
        $this->interrogation = $moyenne;
    }

    public function setDevoir($moyenne)
    {
        $this->devoir = $moyenne;
    }

    public function setExam($moyenne)
    {
        $this->examen = $moyenne;
    }

    public function setGeneral($moyenne)
    {
        $this->general = $moyenne;
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

    /**
     * Retourne la moyenne
     * pour le type d'évaluation dont l'ID
     * est recu en paramètre
     * 
     * @param integer $type Type evaluation ID
     * @return mixed 
     */
    public function getByTypeEvaluationId($type) {
        $avg = null;

        switch ($type) {
            case self::CODE_INTERROGATION:
                $avg = $this->interrogation;
                break;
            case self::CODE_DEVOIR:
                $avg = $this->devoir;
                break;
            case self::CODE_EXAMEN:
                $avg = $this->examen;
                break;
            default:
                # code...
                break;
        }

        return $avg;
    }
}
