<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Matiere;
use App\Models\Classe;
use App\Models\Enseigner;
use App\Http\Requests\StoreMatiereRequest;
use Illuminate\Support\Facades\Redirect;
use App\Models\Professeur;
use App\Http\Requests\SearchEnseignerClasseRequest;

class MatiereController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matieres = Matiere::all();

        return view('dashboard.matieres.index', compact('matieres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.matieres.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMatiereRequest $request)
    {
        $m = new Matiere();
        $m->intitule = $request->intitule;
        $m->save();

        return Redirect::route('matieres.index')
                ->with('status', 'Enregistré avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mat = Matiere::findorFail($id);
        $ens = $mat->enseigner;

        return view('dashboard.matieres.show', compact('mat', 'ens'));
    }

    /**
     * Retourne la liste des matières pour une classe spécifiée
     *
     * @param int $classe_id
     */
    public function showForSpecificClasse($classe_id)
    {
        $enseigner = DB::table('enseigner')
                    ->where('classe_id', '=', $classe_id)
                    ->join('classes', 'enseigner.classe_id', '=', 'classes.id')                    
                    ->join('professeurs', 'enseigner.professeur_id', '=', 'professeurs.id')
                    ->join('matieres', 'enseigner.matiere_id', '=', 'matieres.id')
                    ->select('enseigner.id', 'enseigner.coefficient', 'enseigner.professeur_id', 'classes.cla_intitule', 'matieres.intitule', 'professeurs.prof_nom', 'professeurs.prof_prenoms')
                    ->get();
        
        if ($enseigner->count() != null) {            
            $classes = Classe::all();
            return view('dashboard.enseigner.show', compact('enseigner', 'classes'));
        }else {
            $classe = Classe::find($classe_id);
            return view('dashboard.enseigner.show-empty', compact('classe'));
        }
    }

    /**
     * POST
     */
    public function searchForClasse(SearchEnseignerClasseRequest $req)
    {
        return Redirect::route('matiere.show.classe', ['classe' => $req->classe]);
    }

    /**
     * Affiche toutes les matière avec classes
     */
    public function showAllWithClasse()
    {
        $enseigner = Enseigner::all();
        $classes = Classe::all();

        return view('dashboard.enseigner.index', compact('enseigner', 'classes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Respopnse
     */
    public function edit($id)
    {
        $m = Matiere::findorFail($id);

        return view('dashboard.matieres.edit', compact('m'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreMatiereRequest $request, $id)
    {
        $m = Matiere::findorFail($id);
        $m->intitule = $request->intitule;
        $m->save();

        return Redirect::route('matieres.edit', compact('m'))
                ->with('id', $m->id)
                ->with('status', 'Enregistré avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
