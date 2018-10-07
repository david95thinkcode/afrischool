<?php

namespace App\Http\Controllers\GestionScolarite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Inscription;

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
}
