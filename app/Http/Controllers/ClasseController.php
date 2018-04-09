<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Niveau;
use App\Models\Professeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreClasseRequest;
use App\Http\Requests\UpdateClasseRequest;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Classe::all();

        return view('dashboard.classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $niveaux = Niveau::all();     

        return view('dashboard.classes.create', compact('niveaux'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClasseRequest $request)
    {
        $classe = new Classe();
        $classe->cla_intitule = $request->cla_intitule;
        $classe->niveau_id = $request->niveau;

        $classe->save();

        return Redirect::route('classe.index')
                ->with('status', $classe->cla_intitule . ' enregistré !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $c = Classe::find($id);
        return response()->json($c, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $c = Classe::find($id);   
        $niveaux = Niveau::all();
    
        return view('dashboard.classes.edit', compact('c', 'niveaux'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClasseRequest $request, $id)
    {
        $c = Classe::find($id);
        $c->niveau_id = $request->niveau;
        // // $c->cla_intitule = $request->cla_intitule;
        $c->save();

        return Redirect::route('classe.index')->with('status', 'Modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Classe::find($id)->delete();

        return Redirect::route('classe.index')
                ->with('status', 'Une classe a été supprimé avec succès !');
    }
}
