<?php

namespace App\Http\Controllers;

use App\Models\AnneeScolaire;
use Illuminate\Http\Request;
use App\Models\Professeur;
use App\Models\Matiere;
use App\Models\Classe;
use App\Models\Enseigner;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreEnseignerRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AbsenceFirstStepRequest;
use Carbon\Carbon;
use App\Http\Requests\FetchEnseignerCnD;
use App\Models\Horaire;

class EnseignerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Classe::all();
        $matieres = Matiere::all();
        $profs = Professeur::all();
        $scolarite =  AnneeScolaire::all();

        return view('dashboard.enseigner.create', compact('classes', 'scolarite', 'matieres', 'profs'));
    }

    public function store(StoreEnseignerRequest $request)
    {
        $e = new Enseigner();
        $currentAnneeScolaire = AnneeScolaire::where('an_ouverte', true)
            ->orderBy('an_date_fin', 'desc')
            ->first();
        $exists = $this->exists($request->matiere, $request->classe, $currentAnneeScolaire->id);
        
        if (!$exists) {
            $e->classe_id = $request->classe;
            $e->matiere_id = $request->matiere;
            $e->professeur_id = $request->professeur;
            $e->coefficient = ($request->coefficient)?$request->coefficient:1;
            $e->annee_scolaire_id = $currentAnneeScolaire->id;
            $e->save();

            return Redirect::route('matiere.show.classe', ['classe' => $e->classe_id])
                    ->with('status', 'Enregistré !');
        }
        else {
            return redirect()
                    ->action('EnseignerController@create')
                    ->with('danger', 'La matière que vous avez sélectionné est déjà assignée à la classe');
        }
    }

    public function edit($id)
    {
        $ens = Enseigner::findOrfail($id);
        $classes = Classe::all();
        $matieres = Matiere::all();
        $profs = Professeur::all();
        $scolarite =  AnneeScolaire::all();

        return view('dashboard.enseigner.edit', compact('ens', 'classes', 'scolarite', 'matieres', 'profs'));
    }

    public function update(StoreEnseignerRequest $req, $id)
    {
        $e = Enseigner::findOrFail($id);
        $exists = $this->exists($req->matiere, $req->classe);
        if (!$exists) {
            $e->classe_id = $req->classe;
            $e->matiere_id = $req->matiere;
            $e->professeur_id = $req->professeur;
            $e->coefficient = $req->coefficient;
            $e->save();
            return Redirect::route('matiere.show.classe', ['classe' => $e->classe_id])
                ->with('status', 'Enregistré !');
        }else {
            return redirect()
                ->action('EnseignerController@edit', ['id' => $id])
                ->with('danger', 'La matière que vous essayez d\'assigner était déjà assignée à la classe');
        }
    }

    public function createAnneeScolaire(Request $req)
    {
        $an = new AnneeScolaire();

        $an->an_description = $req->description;
        $an->an_date_debut = $req->datedebut;
        $an->an_date_fin = $req->datefin;
        $an->an_ouverte = 1;
        $an->save();

        return Redirect::back();
    }

    public function destroy($id)
    {
        $classe = Enseigner::findOrFail($id)->classe_id;
        Enseigner::find($id)->delete();

        return Redirect::route('matiere.show.classe', compact('classe'))
                ->with('info', 'Une matière a été retirée avec succès');
    }

    public function exists($matiere, $classe, $anneescolaireID)
    {
        $exists = Enseigner::where([
            ['classe_id', '=', $classe],
            ['matiere_id', '=', $matiere],
            ['annee_scolaire_id', '=', $anneescolaireID]
        ])->get();

        if ($exists->count() == 0)  {
            $status = false;
        } else {
            $status = true;
        }

        return $status;
    }

    /**
     * Retourne la liste des matières pour une classe spécifiée
     *
     * @param integer $classe
     * @return 
     */
    public function getForClasse($classe)
    {
        $enseigner = DB::table('enseigner')
                    ->where('classe_id', '=', $classe)
                    ->join('classes', 'enseigner.classe_id', '=', 'classes.id')                    
                    ->join('professeurs', 'enseigner.professeur_id', '=', 'professeurs.id')
                    ->join('matieres', 'enseigner.matiere_id', '=', 'matieres.id')
                    ->select('*', 'enseigner.id as enseigner_key')
                    // ->select('enseigner.id', 'enseigner.coefficient', 'enseigner.professeur_id', 'classes.cla_intitule', 'matieres.intitule', 'professeurs.prof_nom', 'professeurs.prof_prenoms')
                    ->get();

        return response()->json($enseigner, 200);
    }

    /**
     * Retournes les occurences de Enseigner (Matières enseignées)
     * dans une classe donnée à une date donnée
     * 
     * @param AbsenceFirstRequest
     * @return JSON
     */
    public function getForClasseAndDate(FetchEnseignerCnD $req)
    {
        $a = isset($req->anneeScolaire) ? $req->annneeScolaire : AnneeScolaire::where('an_ouverte', true)->first()->id;
        $j = Carbon::parse($req->date)->dayOfWeek;
        $returnableEnseigner = [];
        $ensID = [];

        // Matieres enseignées
        $me = Enseigner::with('matiere')->where([
            [ 'annee_scolaire_id', $a],
            [ 'classe_id', $req->classe ]
        ])->get();
            
        // Récupérons les id de tous les enseigner à vérifier dans horaire
        foreach ($me as $key => $e) { array_push($ensID, $e->id); }
    
        // Recherche des horaires pour les matières trouvées du jour $j
        $concernedHoraire = Horaire::where('jour_id', $j)
            ->whereIn('enseigner_id', $ensID)
            ->get();
        
        // Trie des enseigner à retourner
        foreach ($concernedHoraire as $hkey => $hvalue) {
            foreach ($me as $ekey => $evalue) {
                if ($hvalue->enseigner_id == $evalue->id) array_push($returnableEnseigner, $evalue);
            }
        }

        return response()->json($returnableEnseigner, 200);
    }
}
