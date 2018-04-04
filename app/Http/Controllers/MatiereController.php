<?php

namespace App\Http\Controllers;

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
        $m->intitule = $request->titre;
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
        //
    }

    /**
     * Retourne la liste des matières pour une classe spécifiée
     * 
     * @param int $classe_id
     */
    public function showForSpecificClasse($classe_id)
    {
        $enseigner = Enseigner::where('classe_id', $classe_id)->get();
        
        if ($enseigner->count() != null) {
            $classes = Classe::all();
            
            return view('dashboard.enseigner.show', compact('enseigner', 'classes'));
        }
        else {
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
