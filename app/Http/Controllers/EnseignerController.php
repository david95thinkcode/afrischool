<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professeur;
use App\Models\Matiere;
use App\Models\Classe;
use App\Models\Enseigner;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreEnseignerRequest;

class EnseignerController extends Controller
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
        $classes = Classe::all();
        $matieres = Matiere::all();
        $profs = Professeur::all();

        return view('dashboard.enseigner.create', compact('classes', 'matieres', 'profs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEnseignerRequest $request)
    {
        // Ne pas enregistrer si le même cours est déjà assigné à dans une classe
        
        $e = new Enseigner();
        $exists = Enseigner::where('classe_id', $request->classe)
                    ->get()
                    ->where('matiere_id', $request->matiere);
        
        if ($exists != null) {
            $e->classe_id = $request->classe;
            $e->matiere_id = $request->matiere;
            $e->professeur_id = $request->professeur;
            $e->coefficient = $request->coefficient;
            $e->save();

            return Redirect::route('matiere.show.classe', ['classe' => $e->classe_id])
                    ->with('status', 'Enregistré !');
        }
        else {
            
        }
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
