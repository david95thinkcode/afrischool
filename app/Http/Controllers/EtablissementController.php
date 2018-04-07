<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Adresse;
use App\Models\CategorieEts;
use App\Models\Etablissement;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEtablissementRequest;
use App\Http\Requests\UpdateEtablissementRequest;

class EtablissementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = Etablissement::all();

        return view('dashboard.etablissements.index', compact('schools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = CategorieEts::all();

        return view('dashboard.etablissements.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEtablissementRequest $request)
    {
        $ets = new Etablissement();

        $ets->raison_sociale = $request->raison_sociale;
        $ets->sigle = $request->sigle;
        $ets->directeur = $request->directeur;
        $ets->tel = $request->tel;
        $ets->email = $request->email;
        $ets->site_web = $request->site_web;
        $ets->categorie_ets_id = $request->categorie_ets;
        $ets->adresse_id = $this->storeAdresse($request->pays, $request->ville, $request->quartier)->id;
        $ets->save();

        return Redirect::route('etablissements.index')->with('status', 'Enregistré !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Etablissement  $etablissement
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ecole = DB::table('etablissements')
                ->where('etablissements.id', '=', $id)
                ->join('categorie_ets', 'etablissements.categorie_ets_id', '=', 'categorie_ets.id')
                ->join('adresses', 'etablissements.adresse_id', '=', 'adresses.id')
                ->get()
                ->first();

        return view('dashboard.etablissements.show', compact('ecole'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $etablissement_id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ets = Etablissement::findorFail($id);
        $categories = CategorieEts::all();

        return view('dashboard.etablissements.edit', compact('ets', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Etablissement  $etablissement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEtablissementRequest $request, $id)
    {
        $ets = Etablissement::findorFail($id);

        $ets->raison_sociale = $request->raison_sociale;
        $ets->sigle = $request->sigle;
        $ets->directeur = $request->directeur;
        $ets->tel = $request->tel;
        $ets->email = $request->email;
        $ets->site_web = $request->site_web;
        $ets->categorie_ets_id = $request->categorie_ets;
        $ets->adresse_id = $this->storeAdresse($request->pays, $request->ville, $request->quartier)->id;
        $ets->save();

        return Redirect::route('etablissements.index')->with('status', 'Mofications enregistrées !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Etablissement  $etablissement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        (Etablissement::find($id))->delete();

        return Redirect::route('etablissements.index')->with('status', 'Supprimé !');
    }

    /**
     * Active un établissement
     */
    public function activate($id)
    {
        $ets = Etablissement::findorFail($id);
        $ets->activer = true;
        $ets->save();

        return Redirect::route('etablissements.index')
            ->with('status', $ets->raison_sociale . ' vient d\'être activé');
    }

    /**
     * Enregistre une adresse dont elle reçoit les paramètre
     * puis la retourne
     */
    public function storeAdresse($pays, $ville, $quartier)
    {
        $adresse = new Adresse();
        $adresse->pays = $pays;
        $adresse->ville = $ville;
        $adresse->quartier = $quartier;
        $adresse->save();

        return $adresse;
    }

}
