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
use Illuminate\Support\Facades\Redirect;

class NoteController extends Controller
{

    public function selectType()
    {
        return view('dashboard.notes.selecttype');
    }

    public function createcollege()
    {
        $classes = Classe::all();
        $trimestres = Trimestre::all();
        $anneeScolaires = AnneeScolaire::all();
        return view('dashboard.notes.create-first-step', compact('classes', 'trimestres', 'anneeScolaires'));
    }
    public function createprimaire()
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

        return Redirect::route('reload.note');
    }

    public function store(Request $req)
    {
        $pk = $req->pk;
        $value = $req->value;
        Note::where('id', $pk)->update(['not_note' => $value]);

        $note = Note::find($pk);
        $noter = Note::where(['eleve_id' => $note->eleve_id,
            'types_evaluation_id' => session('types_evaluation_id'),
            'trimestre_id' => session('trimestre'),
            'classe_id' => session('classe'),
            'matiere_id' => session('matiere'),
            'annee_scolaire_id' => session('annee_scolaire')])
            ->orderBy('id', 'desc')->first();
        if($pk == $noter->id){

            Note::create([
                'types_evaluation_id' => $noter->types_evaluation_id,
                'trimestre_id' => $noter->trimestre_id,
                'matiere_id' => $noter->matiere_id,
                'classe_id' => $noter->classe_id,
                'annee_scolaire_id' => $noter->annee_scolaire_id,
                'eleve_id' => $noter->eleve_id,
            ]);

            return response()->json(['code' => 'new'], 200);
        }

        return response()->json(['code' => 200], 200);
    }

    public function createNewLigne($eleve)
    {
        Note::create(['eleve_id' => $eleve,
            'types_evaluation_id' => session('types_evaluation_id'),
            'trimestre_id' => session('trimestre'),
            'classe_id' => session('classe'),
            'matiere_id' => session('matiere'),
            'annee_scolaire_id' => session('annee_scolaire')]);
        return Redirect::route('reload.note');
    }

    public function indexclass()
    {
        $classes = Classe::all();
        return view('dashboard.notes.index-class', compact('classes'));
    }

    public function reload()
    {
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
}
