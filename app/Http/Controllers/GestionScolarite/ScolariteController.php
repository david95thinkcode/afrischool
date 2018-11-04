<?php

namespace App\Http\Controllers\GestionScolarite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Inscription;
use App\Http\Requests\Scolarite\GetScolariteStateRequest;
use App\Models\PaiementScolarite;
use App\CustomClasses\ComptabiliteScolarite\EleveScolariteState;
use App\CustomClasses\ComptabiliteScolarite\ClasseScolariteState;
use Illuminate\Support\Facades\DB;
use App\CustomClasses\ComptabiliteScolarite\SchoolScolariteState;

class ScolariteController extends Controller
{
    public function indexInsolder()
    {
        $debiteurs = Inscription::with('eleve')->where('est_solder', false)->get();     
        $sorted = [];
        
        if ($debiteurs->isNotEmpty()) {            
            foreach ($debiteurs as $key => $d) { // Classons les débiteurs par classe
                if (!isset($sorted[$d->classe_id])) {
                    $sorted[$d->classe_id] = [];
                    $sorted[$d->classe_id]['debiteurs'] = [];
                    $sorted[$d->classe_id]['classe'] = Classe::findOrFail($d->classe_id); 
                }
                array_push($sorted[$d->classe_id]['debiteurs'], $d);
            }
        }
        
        return view('scolarite.eleve_non_solde', compact('sorted'));
    }

    public function listerInsolder(Request $req)
    {
        $classe = Classe::findOrFail($req->classe);
        $debiteurs = Inscription::with('eleve')->where([
                        ['est_solder', false],
                        ['classe_id', $req->classe]
                    ])->get();     
        
        return view('scolarite.insoldes-search-result', compact('debiteurs', 'classe'));
    }

    public function getScolariteState(GetScolariteStateRequest $req)
    {
        $returnableResponse = null;

        switch ($req->type) {
            case 'i':
                if (!is_null($req->key)) {
                    $returnableResponse = $this->getStateForInscription($req->key);
                } else {
                    return response(400, 400);
                }
                break;
            case 'c':
                if (!is_null($req->year)){
                    $returnableResponse = $this->getStateForClass($req->key, $req->year);
                } else {
                    return response(400, 400);
                }
                break;
            case 's':
                if (!is_null($req->year)){
                    $returnableResponse = $this->getStateForSchool($req->year);
                } else {
                    return response(400, 400);
                }
                break;
            default:
                abort(500);
                break;
        }

        return response()->json($returnableResponse, 200);
    }

   
    private function getStateForInscription($inscription) {

        $eleve = Inscription::with('eleve')->findOrFail($inscription);

        $state = new EleveScolariteState($eleve);
        $state->setPaid(PaiementScolarite::where('inscription_id', $eleve->id)->sum('montant'));
                
        return $state;
    }

    /**
     * Récupérer L'état de scolarité d'une classe 
     * d'une année donné
     * 
     * @param  [integer] $inscription 
     * @return \App\CustomClasses\ClasseScolariteState 
     */
    private function getStateForClass($classe, $anneescolaire) 
    {
        $cash = 0;
        $paid = 0;

        $inscrits = Inscription::where([
            ['annee_scolaire_id', $anneescolaire],
            ['classe_id', $classe]
        ])->get();
        
        if (!($inscrits->isNotEmpty())) return null; 

        foreach ($inscrits as $key => $i) {
            $es = $this->getStateForInscription($i->id);
            $cash += $es->getCash();
            $paid += $es->getPaid();
        }
        $state = new ClasseScolariteState(Classe::findOrFail($classe));
        $state->setCash($cash);
        $state->setPaid($paid);
        $state->finish();
        
        return $state;
    }


    private function getStateForSchool($anneescolaire)
    {
        $cash = 0;
        $paid = 0;
        $distinctClasses = [];
        
        // Récupérons uniquement les classes où il y eu des inscription cette année
        $classes = DB::table('inscriptions')
        ->where('annee_scolaire_id', $anneescolaire)
        ->select('classe_id')->get();
        
        if (!($classes->isNotEmpty())) return null;
        
        $state = new SchoolScolariteState();

        foreach ($classes as $key => $c) {
            
            // On travaillera avec les classes tout en évitant les doublons
            if ((count($distinctClasses) == 0) || (array_search($c->classe_id, $distinctClasses) == false)) 
            {
                array_push($distinctClasses, $c->classe_id);
                $classeState = $this->getStateForClass($c->classe_id, $anneescolaire);
                $cash += $classeState->getCash();
                $paid += $classeState->getPaid();
                $state->pushToClasses($classeState);                
            }
        }
        
        $state->setCash($cash);
        $state->setPaid($paid);
        $state->finish();

        return $state;
    }

}
