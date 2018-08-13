<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Redirect;
use App\Models\AnneeScolaire;
use App\Models\Classe;
use App\Models\Horaire;
use App\Models\Inscription;
use App\Models\Enseigner;
use App\Http\Requests\AbsenceLastStepRequest;
use App\Http\Requests\AbsenceSecondStepRequest;
use App\Http\Requests\AbsenceFirstStepRequest;
use App\Models\Absence;

class AbsenceController extends Controller
{

    public function index()
    {
        return view('dashboard.absences.index');
    }
    

    public function show(Request $req)
    {
        dd($req);
        
        return view('dashboard.absences.show');
    }
    
    public function selectDateAndClasse()
    {
        $anneeScolaires = AnneeScolaire::all();
        $classes = Classe::all();

        return view('dashboard.absences.create-first-step', compact('anneeScolaires', 'classes'));
    }

    public function selectMatiere(AbsenceFirstStepRequest $req)
    {        
        $mats = [];
        $jourID = Carbon::parse($req->date)->dayOfWeek;
        $matieres = Enseigner::with('matiere')
            ->where([
                [ 'annee_scolaire_id', $req->anneeScolaire ],
                [ 'classe_id', $req->classe ]
            ])->get();            
            
        if ($matieres->isNotEmpty()) {
            session(['absences.jourID' => $jourID]);
            foreach ($matieres as $key => $value) {
                $horaires = Horaire::where('enseigner_id', $value->id)->get();                
                
                // NB : Une même matière peut être enseignée à plusieurs horaires différents
                foreach ($horaires as $hkey => $h) {
                    if ($this->areEqualDays($req->date, $h)) {
                        array_push($mats, $value);
                        session(['absences.classe' => $req->classe]);
                        session(['absences.anneeScolaire' => $req->anneeScolaire]);
                    }                    
                }    
            }
            return view('dashboard.absences.create-second-step', compact('mats'));
        }
        else {
            abort(404);
        }
        
    }

    public function selectAbsence(AbsenceSecondStepRequest $req)
    {
        // Afficher les élèves inscrits dans cette classe dans des checkbox(s)
        // La vue doit retourner les élèves sélectionner dans la méthode store       

        $classe = session()->get('absences.classe');
        $year = session()->get('absences.anneeScolaire');

        $eleves = Inscription::with('eleve')
            ->where([
                ['classe_id', $classe],
                ['annee_scolaire_id', $year],
            ])
            ->get();
        
        if ($eleves->isEmpty()) {
            return ('Aucun éléve inscrit dans cette classe');
        }
        else {
            $classe = session()->get('absences.classe');   
            session(['absences.enseignerID' => $req->enseignerID]);

            return view('dashboard.absences.create-last-step', compact('eleves'));
        }
            
    }

    public function store(AbsenceLastStepRequest $req)
    {
        $j = session()->get('absences.jourID');
        $e = session()->get('absences.enseignerID');
        $concernedHoraire = Horaire::where([
            [ 'enseigner_id', $e],
            [ 'jour_id', $j]
        ])->first();

        if ($concernedHoraire != null) {
            foreach ($req->eleve as $matricule) {
                $a = new Absence();
                $a->horaire_id = $concernedHoraire->id;
                $a->inscription_id = $matricule;
                $a->save();
            }
            $this->clearUsedSessionVariables();

            return Redirect::route('absences.index')
            ->with('status', 'Absences enregistrées avec succès');
        }
        else {
            abort(404);
        }
    }

    public function list(Request $req)
    {

    }
    
    private function areEqualDays($date, Horaire $horaire)
    {
        try {
            $d = Carbon::parse($date);
            return ($d->dayOfWeek == $horaire->jour_id);
        }
        catch (\Exception $e) {
            abort(404);
            return 'Exception : ' . get_class($e) . ' => ' . $e->getMessage();
        }
    }

    private function clearUsedSessionVariables()
    {
        session()->forget('absences');
    }
}
