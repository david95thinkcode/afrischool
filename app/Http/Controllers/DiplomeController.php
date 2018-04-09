<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diplome;
use App\Models\Professeur;
use App\Http\Requests\StoreDiplomeRequest;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UpdateDiplomeRequest;
use Illuminate\Support\Facades\DB;

class DiplomeController extends Controller
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
        //
    }

    /**
     * 
     */
    public function createFromProf($id_prof)
    {
        $prof = Professeur::findOrFail($id_prof);
        return view('dashboard.diplomes.create', compact('prof'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDiplomeRequest $req)
    {
        $diplome = new Diplome();
        $diplome->professeur_id = $req->professeur;
        $diplome->dip_intitule = $req->dip_intitule;
        $diplome->dip_ecole = $req->dip_ecole;
        $diplome->dip_specialite = $req->dip_specialite;
        $diplome->dip_niveau = $req->dip_niveau;
        $diplome->dip_date_obtention = $req->dip_date_obtention;
        $diplome->save();

        return Redirect::route('professeurs.show', ['id' => $diplome->professeur_id])
                ->with('info', 'Diplome ajouté avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $diplome = DB::table('diplomes')
                ->where('diplomes.id', '=', $id)
                ->join('professeurs', 'diplomes.professeur_id', '=', 'professeurs.id')
                ->get()
                ->first();

        dd($diplome);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $diplome = Diplome::findOrFail($id);
        return view('dashboard.diplomes.edit', compact('diplome'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDiplomeRequest $req, $id)
    {
        $diplome = Diplome::findOrFail($id);
        $diplome->dip_intitule = $req->dip_intitule;
        $diplome->dip_ecole = $req->dip_ecole;
        $diplome->dip_specialite = $req->dip_specialite;
        $diplome->dip_niveau = $req->dip_niveau;
        $diplome->dip_date_obtention = $req->dip_date_obtention;
        $diplome->save();

        return Redirect::route('professeurs.show', ['id' => $diplome->professeur_id])
                ->with('status', 'Diplome modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prof = Diplome::findOrFail($id)->professeur_id;
        Diplome::findOrFail($id)->delete();

        return Redirect::route('professeurs.show', ['id' => $prof])
            ->with('info', 'Un diplôme de ce professeur a été retiré avec succès');
    }
}
