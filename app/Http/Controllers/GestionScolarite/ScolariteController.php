<?php

namespace App\Http\Controllers\GestionScolarite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Inscription;
use App\Http\Requests\Scolarite\GetScolariteStateRequest;
use App\Models\PaiementScolarite;
use App\CustomClasses\ComptabiliteScolarite\EleveScolariteState;

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
        // dd($req);
        $returnableResponse = null;

        switch ($req->type) {
            case 'i':
                $returnableResponse = $this->getStateForInscription($req->key);
                break;
            case 'c':
                # code...
                break;
            case 's':
                # code...
                break;
            default:
                abort(500);
                break;
        }

        return response()->json($returnableResponse, 200);
    }

    /**
     * Récupérer L'état de scolarité d'un inscript donné
     * 
     * @param  [integer] $inscription 
     * @return \App\CustomClasses\EleveScolariteState 
     */
    private function getStateForInscription($inscription) {

        $eleve = Inscription::with('eleve')->findOrFail($inscription);

        $state = new EleveScolariteState($eleve);
        $state->setPaid(PaiementScolarite::where('inscription_id', $eleve->id)->sum('montant'));
                
        return $state;
    }

}
