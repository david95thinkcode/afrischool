<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProfesseurPresenceRequest;
use Carbon\Carbon;
use App\Models\PresenceProfesseur;
use App\Models\Professeur;
use App\Models\Horaire;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SearchPresenceProfesseur;

class PresenceProfesseurController extends Controller
{

    public function __construct()
    {

    }

    public function store(StoreProfesseurPresenceRequest $req)
    {

        $horaire = Horaire::findOrFail($req->horaire);
        $prof = Professeur::findOrFail($req->prof);
        $presence = new PresenceProfesseur();

        $date = Carbon::parse($req->date);

        $presence->date = $date->toDateString();
        $presence->horaire_id = $horaire->id;
        $presence->real_professeur_id = $prof->id;
        // $presence->marked_by = Auth::user();
        $presence->marked_by = 1;

        // Determination de a dureee si non renseignée dans la request
        if (!isset($req->duree)) {
            $start = Carbon::parse($horaire->debut);
            $end = Carbon::parse($horaire->fin);
            $duree = $end->diffInMinutes($start);
            $presence->duree = $duree;
        } else {
            $presence->duree = $req->duree;
        }

        if (!($this->isAlreadyExists($presence->horaire_id, $presence->real_professeur_id, $presence->date, $presence->duree))) {
            $presence->save();
        }

        return response()->json($presence, 200);
    }


    public function Exists(SearchPresenceProfesseur $req)
    {

    }
    /**
     * Retourne true si une occurence de presence professeur
     * avec les parametre existe deja dans la base de données
     *
     * @param integer $horaireID
     * @param integer $professeurID
     * @param [type] $date
     * @param integer $duree
     * @return boolean
     */
    private function isAlreadyExists($horaireID, $professeurID, $date, $duree)
    {
        $results = PresenceProfesseur::where([
            ['horaire_id', $horaireID],
            ['real_professeur_id', $professeurID],
            ['duree', $duree],
            ['date', $date]
        ])->get();

        return $results->isNotEmpty();
    }
}
