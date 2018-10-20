<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Jour;
use App\Http\Requests\SearchEmploiDuTempsByDay;
use Carbon\Carbon;
use App\Models\Horaire;

class EmploiDuTempsController extends Controller
{

    /**
     * Retourne les horaires d'un jour donne
     *
     * @param SearchEmploiDuTempsByDay $req
     * @return JSON
     */
    public function getForDay(SearchEmploiDuTempsByDay $req) 
    {
        $day = Carbon::parse($req->day);
        
        $horaires = Horaire::with('enseigner')->where([
            ['jour_id', $day->dayOfWeek]
        ])->get();

        return response()->json($horaires, 200);
    }

    /**
     * Retourne en JSON l'ensemble des horaires de la
     * classe reçue en paramètre
     * 
     * @param integer $classe
     * @return JSON
     * 
     */
    public function getForClasse($classe)
    {
        $returnable = [];

        $jours = Jour::all();
        $horaires = DB::table('horaires')
        ->join('enseigner', 'horaires.enseigner_id', 'enseigner.id')
        ->join('classes', 'enseigner.classe_id', 'classes.id')
        ->where('classes.id', '=', $classe)
        ->join('jours', 'horaires.jour_id', 'jours.id')
        ->join('matieres', 'enseigner.matiere_id', 'matieres.id')
        ->select('*', 'horaires.id as horaire_key')
        ->orderBy('horaires.debut', 'ASC')
        ->get();

        // Creating returnable datas
        for ($day = 1; $day < 8; $day++) {
            $datas = $horaires->where('jour_id', $day);
            
            $returnable[$day] = new \StdClass();
            $returnable[$day]->day = ''; // contient nom du jour concerné
            $returnable[$day]->datas = []; // contient des occurences de $horaires
            
            if (count($datas) >= 1) {
                $returnable[$day]->day = $datas->first()->nom; 
                foreach ($datas as $dkey => $dval) {
                    array_push($returnable[$day]->datas, $dval);
                }
            }
            else {
                $returnable[$day]->day = $jours->where('id', $day)->first()->nom; 
            }

        }

        return response()->json($returnable, 200);
    }
    

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
