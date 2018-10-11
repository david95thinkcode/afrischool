<?php

namespace App\CustomClasses;

class NoteByMatiere
{
    const CODE_INTERROGATION = 1;
    const CODE_DEVOIR = 2;
    const CODE_EXAMEN = 3;

    public $key;
    public $label;
    public $eleve;
    public $coef;
    public $isCollege;
    public $notes = [];
    public $avgs;
    public $sums;
    public $points; // note coefficiée
    public $appreciation;

    public function __construct($matiere_key, $matiere_intitule, $isCollegeClasse) 
    {
        $this->key = $matiere_key;
        $this->label = $matiere_intitule;
        $this->isCollege = $isCollegeClasse;
        $this->avgs = new NoteByMatiereAvgs();
        $this->sums = new NoteByMatiereSum();
    }
    
    /**
     * Ajoute un élément au tableau des notes
     */
    public function addNote($data) {
        array_push($this->notes, $data);
    }

    public function setCoef($coefficient)
    {
        $this->coef = (int) $coefficient;
    }

    public function getNotes()
    {
        return $this->notes;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getAvgs()
    {
        return $this->avgs;
    }

    public function getSums()
    {
        return $this->sums;
    }

    public function getCoef()
    {
        return $this->coef;
    }

    public function setEleve(AboutEleve $eleve)
    {
        $this->eleve = $eleve;
    }

    public function getEleve() {
        return $this->eleve;
    }

    /**
     * Fais le calcul des moyennes
     */
    public function calculateAvgs()
    {
        $this->calculateInterroAvg();
        $this->calculateDevoirAvg();
        $this->calculateExamAvg();
        $this->calculateGeneralAvg();
    }

    /**
     * Calcul la moyenne générale et la 
     * note coefficiée
     * 
     * LE PRIMAIRE
     * La moyenne de la matière se trouve dans 
     * $avgs->getDevoir()
     * 
     * LE COLLEGE
     * Contrairement au cas du primaire, ici la moyenne 
     * de la matière se calcule en diviant par 3 la somme 
     * entre la moyenne d'interrogation et la somme des notes de devoir
     * 
     */
    public function calculateGeneralAvg()
    {
        $generalAvg = 0;

        if ($this->isCollege) {
            $generalAvg = $this->avgs->getInterro() + $this->sums->getDevoir() / 3;
        } else {
            $generalAvg = $this->avgs->getDevoir();
        }
        
        $this->avgs->setGeneral($generalAvg);        
        
        // Caluclons la note coefficiée 
        // Elle se calcul en multpipliant par le coefficient la moyenne générale
        $this->points = $this->getAvgs()->getGeneral() * $this->getCoef();

        // Récupérons le message d'apréciation
        $this->appreciation = AvgAppreciation::getAppreciation($this->avgs->getGeneral());
    }

    private function calculateInterroAvg()
    {
        $avg = 0;
        $sum = 0;
        $conceredNotes = [];
        
        if ($this->NotesIsNotEmpty()) {
            
            foreach ($this->notes as $key => $value) {
                if ($value->types_evaluation_id == self::CODE_INTERROGATION)
                    array_push($conceredNotes, $value);
            }

            if (count($conceredNotes) > 0) {
                foreach ($conceredNotes as $key => $n) {
                    $sum += $n->not_note;
                }
                $avg = ($sum == 0) ? 0 : $sum / count($conceredNotes);
            }
        }
        $this->sums->setInterro($sum);
        $this->avgs->setInterro($avg);
    }

    private function calculateDevoirAvg()
    {
        $sum = 0;
        $avg = 0;
        $conceredNotes = [];

        if ($this->NotesIsNotEmpty()) {
            foreach ($this->notes as $key => $value) {
                if ($value->types_evaluation_id == self::CODE_DEVOIR)
                    array_push($conceredNotes, $value);
            }

            if (count($conceredNotes) > 0) {
                foreach ($conceredNotes as $key => $n) {
                    $sum += $n->not_note;
                }
                $avg = ($sum == 0) ? 0 : $sum / count($conceredNotes);
            }
        }
        $this->sums->setDevoir($sum);
        $this->avgs->setDevoir($avg);
    }
        
    public function calculateExamAvg()
    {
        $avg = 0;
        $sum = 0;
        $conceredNotes = [];
        
        if ($this->NotesIsNotEmpty()) {

            foreach ($this->notes as $key => $value) {
                if ($value->types_evaluation_id == self::CODE_EXAMEN)
                    array_push($conceredNotes, $value);
            }

            if (count($conceredNotes) > 0) {
                foreach ($conceredNotes as $key => $n) {
                    $sum += $n->not_note;
                }
                $avg = ($sum == 0) ? 0 : $sum / count($conceredNotes);
            }
        }
        $this->sums->setExam($sum);
        $this->avgs->setExam($avg);
    }


    /**
     * @return boolean
     */
    private function NotesIsNotEmpty()
    {
        return (count($this->notes) > 0) ? true : false;
    }
}
