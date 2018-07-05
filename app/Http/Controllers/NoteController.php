<?php

namespace App\Http\Controllers;

use App\Models\Matiere;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNoteFirstStepRequest;
use App\Http\Requests\StoreNoteLastStepRequest;
use Illuminate\Support\Facades\DB;
use App\Models\TypeEvaluation;
use App\Models\Trimestre;
use App\Models\Enseigner;
use App\Models\Classe;
use App\Models\Eleve;
use App\Models\AnneeScolaire;
use App\Models\Note;
use App\Models\Inscription;

class NoteController extends Controller
{

    public function create()
    {
        $classes = Classe::all();
        $trimestres = Trimestre::all();
        $anneeScolaires = AnneeScolaire::all();
        return view('dashboard.notes.create-first-step', compact('classes', 'trimestres', 'anneeScolaires'));
    }

    /**
     * Retourne la dernière vue pour enregistrer les notes
     */
    public function goToSecondStep(StoreNoteFirstStepRequest $req)
    {
        $typeEv;
        $classe = Classe::findOrFail($req->classe);
        $trimestre = Trimestre::findOrFail($req->trimestre);
        $annee_scolaire = AnneeScolaire::findOrFail($req->anneeScolaire);
        session(['classe' => $classe->id]);
        session(['libelleClasse' => $classe->cla_intitule]);
        session(['trimestre' => $trimestre->id]);
        session(['annee_scolaire' => $annee_scolaire->id]);
        if ($classe->estPrimaire) {
            $typeEv = TypeEvaluation::where('id', 2)
            ->orWhere('id', 3)
            ->get();
        } else {
            $typeEv = TypeEvaluation::all();
        }
        $matieres = Enseigner::with('matiere')->where(['classe_id' => $classe->id, 'annee_scolaire_id' => $req->anneeScolaire])->get();
        
        return view('dashboard.notes.create-second-step', compact('classe', 'trimestre', 'typeEv', 'matieres', 'eleves'));
    }

    public function lastStep(Request $req){
        session(['matiere' => $req->matiere]);
        $matiere = Matiere::findOrFail($req->matiere);
        session(['libelleMatiere' => $matiere->intitule]);
        $typeEvaluation = TypeEvaluation::findOrFail($req->typeEv);
        session(['types_evaluation_id' => $req->typeEv]);
        session(['libelleEvaluation' => $typeEvaluation->tev_libelle]);
        $eleves = Inscription::with('eleve')
            ->where(['inscriptions.classe_id' => session('classe'),
                'inscriptions.annee_scolaire_id' => session('annee_scolaire')])
            ->get();


        $notes = Note::where(['trimestre_id' => session('trimestre'),
                    'classe_id' => session('classe'),
                    'matiere_id' => session('matiere'),
                    'annee_scolaire_id' => session('annee_scolaire')])
            ->get();

        return view('dashboard.notes.create-last-step', compact('eleves', 'notes'));
    }

    public function store(Request $req)
    {

        $note = Note::where(['eleve_id' =>$req->pk,
            'types_evaluation_id' => session('types_evaluation_id'),
            'trimestre_id' => session('trimestre'),
            'classe_id' => session('classe'),
            'matiere_id' => session('matiere'),
            'annee_scolaire_id' => session('annee_scolaire')])->first();

        if(is_null($note) ){
            Note::create([
                'types_evaluation_id' => session('types_evaluation_id'),
                'trimestre_id' => session('trimestre'),
                'matiere_id' => session('matiere'),
                'classe_id' => session('classe'),
                'annee_scolaire_id' => session('annee_scolaire'),
                'eleve_id' => $req->pk,
                'not_note' => $req->value,
            ]);

            return response()->json(['code' => 'new'], 200);
        }else{

            $note->not_note = $req->value;
            $note->save();
            return response()->json(['code' => 'new'], 200);
        }

    }

}
