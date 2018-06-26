<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ParentEleve;
use App\Models\Eleve;
use App\Models\Note;
use App\Models\Trimestre;

class ConsultationController extends Controller
{
    public function choose()
    {
        // Appelée après connexion du parent
        // Affiche ses enfants

        // TODO: Récupérer l'identifiant du parent connecté
        $parent = ParentEleve::findOrFail(1); // par défaut en attendant fin du TODO
        $enfants = Eleve::where('parent_id', $parent->id)->get();

        return view('parents-dashboard.index', compact('enfants'));
    }
    
    public function home()
    {
        
    }
    
    public function notes($ideleve)
    {
        $enfant = Eleve::findOrFail($ideleve);
        $notes = Note::with('matiere', 'evaluation')->where('eleve_id', $enfant->id)->get();
        $trimestres = Trimestre::all();

        return view('parents-dashboard.enfant-note', compact('enfant', 'notes', 'trimestres'));
    }

    public function absence($ideleve)
    {

    }

    public function scolarite($ideleve)
    {
        $enfant = Eleve::findOrFail($ideleve);
        dd($enfant);
    }
}
