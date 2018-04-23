<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProfesseurRequest;
use Illuminate\Support\Facades\Redirect;
use App\Models\Classe;
use App\Models\Professeur;
use App\Http\Requests\SearchProfesseurAboutClasseRequest;

class ProfesseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Classe::all();
        return view('dashboard.professeurs.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.professeurs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfesseurRequest $request)
    {
        $prof = new Professeur();
        $prof->prof_nom = $request->prof_nom;
        $prof->prof_prenoms = $request->prof_prenoms;
        $prof->prof_tel = $request->prof_tel;
        $prof->prof_email = $request->prof_email;
        $prof->prof_sexe = $request->prof_sexe;
        $prof->prof_date_naissance = $request->prof_date_naissance;
        $prof->prof_nationalite = $request->prof_nationalite;
        $prof->save();

        return Redirect::route('professeurs.index')
                ->with('status', 'Enregistré !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Professeur  $professeur
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $p = Professeur::findorFail($id);

        return view('dashboard.professeurs.show', compact('p'));
    }

    /**
     * Retourne une collection de professeurs pour une classe donnée
     */
    public function list(SearchProfesseurAboutClasseRequest $req)
    {
        $classe = Classe::findOrFail($req->classe);
        $ens = DB::table('enseigner')
                ->where('classe_id', '=', $classe->id)
                ->join('professeurs', 'enseigner.professeur_id', '=', 'professeurs.id')
                ->join('matieres', 'enseigner.matiere_id', '=', 'matieres.id')
                ->select('enseigner.id', 'enseigner.professeur_id', 'professeurs.prof_nom', 'professeurs.prof_prenoms', 
                    'professeurs.prof_tel', 'professeurs.prof_email', 'professeurs.prof_nationalite', 'matieres.intitule')
                ->get();

        return view('dashboard.professeurs.list', compact('classe', 'ens'));
    }

    /**
     * Retourne tous les professeurs
     */
    public function listAll()
    {
        $professeurs = Professeur::all();

        return view('dashboard.professeurs.list-all', compact('professeurs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Professeur  $professeur
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prof = Professeur::find($id);

        return view('dashboard.professeurs.edit', compact('prof'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Professeur  $professeur
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProfesseurRequest $request, $id)
    {
        $prof = Professeur::findorFail($id);
        $prof->prof_nom = $request->prof_nom;
        $prof->prof_prenoms = $request->prof_prenoms;
        $prof->prof_tel = $request->prof_tel;
        $prof->prof_email = $request->prof_email;
        $prof->prof_sexe = $request->prof_sexe;
        $prof->prof_date_naissance = $request->prof_date_naissance;
        $prof->prof_nationalite = $request->prof_nationalite;
        $prof->save();

        return Redirect::route('professeurs.index')
                ->with('status', 'Modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Professeur  $professeur
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        (Professeur::findorFail($id))->delete();

        return Redirect::route('professeurs.index')
                ->with('status', 'Supprimé avec succès !');

    }
}
