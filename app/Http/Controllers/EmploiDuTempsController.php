<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmploiDuTempsController extends Controller
{
    /**
     * Retourne l'emploi du temps d'un professeur dont l'id est fournie
     * 
     * @param integer $id [Identifiant du professeur]
     * @return JSON
     * 
     */
    public function getForProfesseur($id)
    {
        $horaires = DB::table('enseigner')
                    ->where('professeur_id', $id)
                    ->join('matieres', 'enseigner.matiere_id', '=', 'matieres.id')
                    ->join('classes', 'enseigner.classe_id', '=', 'classes.id')
                    ->join('professeurs', 'enseigner.professeur_id', '=', 'professeurs.id')
                    ->join('horaires', 'enseigner.id', '=', 'horaires.enseigner_id')
                    ->join('jours', 'jours.id', '=', 'horaires.jour_id')
                    ->get();
        
        $st = [];

        // Ordering ...
        foreach ($horaires as $hkey => $hval) {
            if (isset($st[$hval->jour_id])) {
                array_push($st[$hval->jour_id]['datas'], $hval);
            }
            else {
                // label : string 
                // datas : array of collection items
                $d = [
                    'label' => $hval->nom,
                    'datas' => []
                ];
                array_push($d['datas'], $hval);
                $st[$hval->jour_id] = $d;
            }            
        }
        
        return response()->json($st, 200);
    }
}
