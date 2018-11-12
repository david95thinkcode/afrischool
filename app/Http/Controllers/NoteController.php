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
    const COLLEGE_ID = 'CLG';
    const PRIMAIRE_ID = 'PRM';
    const UNIVERSITE_ID = 'UNV';
    const NIVEAUCLASSE = [
        self::PRIMAIRE_ID => "Primaire",
        self::COLLEGE_ID => "Collège",
        self::UNIVERSITE_ID => "Université"
    ];

    /**
     * Step 1 pour ajouter une note
     */
    public function selectType()
    {
        return view('dashboard.notes.selecttype');
    }

    /**
     * Step 2 pour ajouter une note
     */
    public function selectNiveau($niveau)
    {
        switch ($niveau) {
            case self::PRIMAIRE_ID:
                $classes = Classe::where('estPrimaire', true)->get();
                break;
            case self::COLLEGE_ID:
                $classes = Classe::where('estCollege', true)->get();
                break;
            case self::UNIVERSITE_ID:
                $classes = Classe::where('estUniversite', true)->get();
                break;
            default:
                $classes = null;
                break;
        }
        $trimestres = Trimestre::all();
        $anneeScolaires = AnneeScolaire::all();
        return view('dashboard.notes.create-first-step', compact('classes', 'trimestres', 'anneeScolaires'));
    }

    /**
     * Step 3 pour ajouter une note
     */
    public function goToSecondStep(StoreNoteFirstStepRequest $req)
    {
        $classe = Classe::findOrFail($req->classe);
        $trimestre = Trimestre::findOrFail($req->trimestre);
        $annee_scolaire = AnneeScolaire::findOrFail($req->anneeScolaire);
        session()->forget('classe');
        session()->forget('libelleClasse');
        session()->forget('trimestre');
        session()->forget('annee_scolaire');
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

    /**
     * Step 4 pour ajouter une no
     * Retourne la dernière vue pour enregistrer les notes
     */
    public function lastStep(Request $req){
        $matiere = Matiere::findOrFail($req->matiere);
        $typeEvaluation = TypeEvaluation::findOrFail($req->typeEv);

        session()->forget('matiere');
        session()->forget('libelleMatiere');
        session()->forget('types_evaluation_id');
        session()->forget('libelleEvaluation');
        session(['matiere' => $req->matiere]);
        session(['libelleMatiere' => $matiere->intitule]);
        session(['types_evaluation_id' => $req->typeEv]);
        session(['libelleEvaluation' => $typeEvaluation->tev_libelle]);

        return Redirect::route('reload.note');
    }

    public function store(Request $req)
    {
        $pk = $req->pk;
        $value = $req->value;
        Note::where('id', $pk)->update(['not_note' => $value]);

        if(!is_null($req->value) && is_double($req->value)){

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
            'annee_scolaire_id' => session('annee_scolaire'),
            'types_evaluation_id' => session('types_evaluation_id') ]);
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
            'annee_scolaire_id' => session('annee_scolaire'),
            'types_evaluation_id' => session('types_evaluation_id')])

            ->get();

        return view('dashboard.notes.create-last-step', compact('eleves', 'notes'));
    }
}
