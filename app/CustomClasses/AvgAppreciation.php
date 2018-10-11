<?php

namespace App\CustomClasses;

class AvgAppreciation
{
    public function __construct() {  }

    /**
     * Retourne une appréciation en fonction de la 
     * note reçue
     */
    public static function getAppreciation($note) {
        $a = 'Aucune appréciation';

        if ($note >= 10 && $note <= 11) {
            $a = 'Passable';
        } else if ($note >= 12 && $note <= 13) {
            $a = 'Assez Bien';
        } else if ($note >= 14 && $note <= 15) {
            $a = 'Bien';
        } else if ($note >= 16 && $note <= 17) {
            $a = 'Très Bien';
        } else if ($note >= 18 && $note <= 20) {
            $a = 'Excellent';
        }

        return $a;
    }
}
