<?php

namespace App\Http\Controllers;

use App\Models\Professeur;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProfesseurRequest;
use Illuminate\Support\Facades\Redirect;

class ProfesseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $professeurs = Professeur::all();
        return view('dashboard.professeurs.index', compact('professeurs'));
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
        $prof->nom = $request->nom;
        $prof->prenoms = $request->prenoms;
        $prof->tel = $request->tel;
        $prof->email = $request->email;

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
    public function show(Professeur $professeur)
    {
        //
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
        $prof->nom = $request->nom;
        $prof->prenoms = $request->prenoms;
        $prof->tel = $request->tel;
        $prof->email = $request->email;

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
