<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Niveau;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreNiveauRequest;
use App\Http\Requests\UpdateNiveauRequest;

class NiveauController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $niveaux = Niveau::all();

        return view('dashboard.niveaux.index', compact('niveaux'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.niveaux.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNiveauRequest $req)
    {

        $n = new Niveau();
        $n->niv_libelle = $req->niv_libelle;
        $n->niv_description = $req->niv_description;
        $n->save();

        return Redirect::route('niveaux.create')
                ->with('status', $n->niv_libelle . ' enregistré !');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $niveau = Niveau::findOrFail($id);

        return view('dashboard.niveaux.edit', compact('niveau'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNiveauRequest $req, $id)
    {
        $n = Niveau::findOrFail($id);
        $n->niv_libelle = $req->niv_libelle;
        $n->niv_description = $req->niv_description;
        $n->save();

        return Redirect::route('niveaux.index')
                ->with('status', $n->niv_libelle . ' modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Niveau::find($id)->delete();

        return Redirect::route('niveaux.index')
                ->with('status', ' Un cours a été supprimé avec succès !');
    }
}
