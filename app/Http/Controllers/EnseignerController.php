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
        $e = new Enseigner();
        $exists = $this->exists($request->matiere, $request->classe);

        if (!$exists) {
            $e->classe_id = $request->classe;
            $e->matiere_id = $request->matiere;
            $e->professeur_id = $request->professeur;
            $e->coefficient = $request->coefficient;
            $e->save();

            return Redirect::route('matiere.show.classe', ['classe' => $e->classe_id])
                    ->with('status', 'Enregistré !');
        }
        else {
            return redirect()
                    ->action('EnseignerController@create')
                    ->with('danger', 'La matière que vous avez sélectionné était déjà assignée à la classe');
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
        $ens = Enseigner::findOrfail($id);
        $classes = Classe::all();
        $matieres = Matiere::all();
        $profs = Professeur::all();
        
        //dd($ens);
        return view('dashboard.enseigner.edit', compact('ens', 'classes', 'matieres', 'profs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreEnseignerRequest $req, $id)
    {
        $e = Enseigner::findOrFail($id);
        $exists = $this->exists($req->matiere, $req->classe);

        if (!$exists) {
            $e->classe_id = $req->classe;
            $e->matiere_id = $req->matiere;
            $e->professeur_id = $req->professeur;
            $e->coefficient = $req->coefficient;
            $e->save();

            return Redirect::route('matiere.show.classe', ['classe' => $e->classe_id])
                    ->with('status', 'Enregistré !');
        }
        else {
            return redirect()
                    ->action('EnseignerController@edit', ['id' => $id])
                    ->with('danger', 'La matière que vous essayez d\'assigner était déjà assignée à la classe');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $classe = Enseigner::findOrFail($id)->classe_id;
        Enseigner::find($id)->delete();

        return Redirect::route('matiere.show.classe', compact('classe'))
                ->with('info', 'Une matière a été retirée avec succès');
    }

    /**
     * Retourne true si une ligne de enseigner est trouvée
     * dont les attributs correspondent aux paramètres reçus
     * @param $matiere
     * @param $classe
     */
    public function exists($matiere, $classe)
    {   
        // Ne pas enregistrer si la même matière est déjà assignée à une classe
        // TODO :: ajouter un controle sur l'année scolaire en cours également
        // ->where('annee_scolaire_id', AnneeScolaire::where('an_ouverte', true))

        $status;
        $exists = Enseigner::where('classe_id', $classe)
                    ->get()
                    ->where('matiere_id', $matiere);
        
        if ($exists->count() == 0)  {
            $status = false;
        } else {
            $status = true;
        }

        return $status;
    }
}
