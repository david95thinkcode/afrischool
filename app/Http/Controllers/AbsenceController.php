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
use App\Http\Requests\SearchAbsenceRequest;

class AbsenceController extends Controller
{

    public function __construct() 
    {
        // $this->middleware("auth.role('surveillant')");

        // $this->middleware('direction')
        //     ->except('selectDateAndClasse');
    }

    public function index()
    {
        return view('dashboard.absences.index');
    }

    public function search()
    {
        $classes = Classe::all();

        return view('dashboard.absences.search', compact('classes'));
    }
    

    /**
     * Retourne les absences d'une période donnée
     * dans une classe donnée
     *
     * @param SearchAbsenceRequest $req
     * @return void
     */
    public function show(SearchAbsenceRequest $req)
    {
        $classe = null;
        $filtredAbsences = [];
        $absences = Absence::with('horaire')->where('date', $req->date)->get();
        
        foreach ($absences as $key => $aValue) {
            
            // Est-ce que de l'horaire est comprise dans la plage 
            // de la période sélectionné ?
            if ((strtotime($aValue->horaire->debut)) >= ((strtotime($req->from_time))) 
                && ((strtotime($aValue->horaire->fin)) <= (strtotime($req->to_time)))) 
            {
                // matière enseignée à l'horaire de l'absence en cours
                $mEnseigner = Enseigner::with('classe', 'matiere')
                    ->where('id', $aValue->horaire->enseigner_id)
                    ->first();
    
                // la matière est-elle enseignée dans la classe sélectionnée ?
                if ($mEnseigner->classe_id == $req->classe) 
                {
                    $eleve = Inscription::with('eleve')
                        ->where('id', $aValue->inscription_id)
                        ->first();
                    $data = [
                        'horaire'       =>  $aValue,
                        'enseigner'     =>  $mEnseigner,
                        'inscription'   =>  $eleve
                    ];
                    array_push($filtredAbsences, $data);
                    
                    // Nécessaire pour détails de la vue 
                    if ((!isset($classe)) || (is_null($classe))) {
                        $classe = $mEnseigner->classe;
                    }
                }
            }
        }

        if (is_null($classe)) {
            $classe = Classe::find($req->classe)->first();
        }

        $details = [
            'date'    => Carbon::parse($req->date)->format('d-m-Y'),
            'classe'  => $classe,
            'periode' => $req->from_time . ' - '. $req->to_time,
        ]; 
        
        return view('dashboard.absences.show', compact('filtredAbsences', 'details'));
    }

    // step 1
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
            session(['absences.date' => $req->date]);

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


    /**
     * Store Absence Model inside DB
     *
     * @param AbsenceLastStepRequest $req
     * @return void
     */
    public function store(AbsenceLastStepRequest $req)
    {
        $j = session()->get('absences.jourID');
        $d = session()->get('absences.date');
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
                $a->date = $d;
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

    // PRIVATE METHODS
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
