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

    public function index()
    {
        $classes = Classe::all();

        return view('dashboard.classes.index', compact('classes'));
    }

    public function create()
    {
        $niveaux = Niveau::all();     

        return view('dashboard.classes.create', compact('niveaux'));
    }

    public function store(StoreClasseRequest $request)
    {
        $classe = new Classe();
        $classe->cla_intitule = $request->cla_intitule;
        $classe->niveau_id = $request->niveau;

        $classe->save();

        return Redirect::route('classe.index')
                ->with('status', $classe->cla_intitule . ' enregistré !');
    }


    public function show($id)
    {
        $c = Classe::find($id);
        return response()->json($c, 200);
    }


    public function edit($id)
    {
        $c = Classe::find($id);   
        $niveaux = Niveau::all();
    
        return view('dashboard.classes.edit', compact('c', 'niveaux'));
    }


    public function update(UpdateClasseRequest $request, $id)
    {
        $c = Classe::find($id);
        $c->niveau_id = $request->niveau;
        $c->cla_intitule = $request->cla_intitule;
        $c->save();

        return Redirect::route('classe.index')->with('status', 'Modifié avec succès !');
    }


    public function destroy($id)
    {
        Classe::find($id)->delete();

        return Redirect::route('classe.index')
                ->with('status', 'Une classe a été supprimé avec succès !');
    }
}
