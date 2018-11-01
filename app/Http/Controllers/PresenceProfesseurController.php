<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProfesseurPresenceRequest;
use Carbon\Carbon;
use App\Models\PresenceProfesseur;
use App\Models\Professeur;
use App\Models\Horaire;
use Illuminate\Support\Facades\Auth;

class PresenceProfesseurController extends Controller
{

    public function __construct() {
        
    }

    public function store(StoreProfesseurPresenceRequest $req) {
        
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

        $presence->save();
        
        return response()->json($presence, 200);
    }
}
