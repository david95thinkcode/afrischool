<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ParentEleve;
use App\Models\Eleve;
use App\Models\Note;
use App\Models\Trimestre;
use App\Models\Matiere;
use App\Models\Enseigner;
use App\Models\AnneeScolaire;

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
    
    /**
     * Retourne les notes de l'enfant sur une vue
     */
    public function notes($ideleve)
    {
        $matiereWithNotes = [];
        $anneScolaire = AnneeScolaire::where('an_ouverte', true)->first();
        $trimestres = Trimestre::all();
        $enfant = Eleve::with(['inscription' => function($query) use ($anneScolaire) {
            $query->where('annee_scolaire_id', $anneScolaire->id); }])
            ->where('id', $ideleve)
            ->first();
        
        // Récup les matières enseignées dans la classe de l'éléève
        $matieresEnseignes = Enseigner::where([
            ['classe_id', '=', $enfant->inscription[0]->classe_id], 
            ['annee_scolaire_id', $anneScolaire->id]
            ])->get();        
        
        // Récup les notes de chaque matières pour l'élève
        foreach ($matieresEnseignes as $m) {
            $n = Matiere::with(['notes' => function($query) use ($enfant) {
                $query->where('eleve_id', $enfant->id); }])
                ->where('id', $m->id)
                ->first();
            array_push($matiereWithNotes, $n);
        }
        
        return view('parents-dashboard.enfant-note', compact('enfant', 'matiereWithNotes', 'trimestres'));
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