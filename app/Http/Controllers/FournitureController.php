<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Fourniture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class FournitureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fournitures = Fourniture::with('classe')->get();
        if(!Auth::user()->hasRole('authenticated')){
            return view('fournitures.indextab', compact('fournitures'));
        }
        return view('fournitures.index', compact('fournitures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Classe::get();
        $fournitures = Fourniture::with('classe')->get();
        return view('fournitures.create', compact('classes', 'fournitures'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $this->validate($req, [
            'libelle' => 'required|string',
            'classe_id' => 'required'
        ],
            [
                'libelle.required'=> 'La fourniture est obligatoire'
            ]
        );

        $fourniture = Fourniture::where('libelle', 'like', $req->libelle)->first();

        if(!is_null($fourniture) && $fourniture->classe_id == $req->classe_id){
            return Redirect::back()
                ->with('danger', 'fourniture déjà existant');
        }

        Fourniture::create($req->except('_token'));

        return Redirect::back()
            ->with('status', 'fourniture ajoutée avec succès');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classes = Classe::get();
        $fourniture = Fourniture::find($id);
        return view('fournitures.update', compact('fourniture','classes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $this->validate($req, [
            'libelle' => 'required|string',
            'classe_id' => 'required'
        ],
            [
                'libelle.required'=> 'La fourniture est obligatoire'
            ]
        );

        $fourniture = Fourniture::where('libelle', 'like', $req->libelle)->first();

        if(!is_null($fourniture) && $fourniture->classe_id == $req->classe_id){
            return Redirect::back()
                ->with('danger', 'fourniture déjà existante');
        }

        Fourniture::where('id', $id)->update([
            'libelle' => $req->libelle,
            'classe_id' =>   $req->classe_id
        ]);

        return Redirect::route('fourniture.create')
            ->with('status', 'fourniture modifer avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Fourniture::find($id)->delete();

        return Redirect::back()
            ->with('status', 'fourniture supprimée avec succès');

    }
}
