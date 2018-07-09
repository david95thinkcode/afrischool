<?php

namespace App\Http\Controllers;

use App\Models\AnneeScolaire;
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
        $scolarite =  AnneeScolaire::all();

        return view('dashboard.enseigner.create', compact('classes', 'scolarite', 'matieres', 'profs'));
    }

    public function store(StoreEnseignerRequest $request)
    {
        $e = new Enseigner();
        $exists = $this->exists($request->matiere, $request->classe);

        if (!$exists) {
            $e->classe_id = $request->classe;
            $e->matiere_id = $request->matiere;
            $e->professeur_id = $request->professeur;
            $e->coefficient = ($request->coefficient)?$request->coefficient:1;
            $e->annee_scolaire_id = $request->anneescolaire;
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

    public function edit($id)
    {
        $ens = Enseigner::findOrfail($id);
        $classes = Classe::all();
        $matieres = Matiere::all();
        $profs = Professeur::all();
        $scolarite =  AnneeScolaire::all();

        return view('dashboard.enseigner.edit', compact('ens', 'classes', 'scolarite', 'matieres', 'profs'));
    }

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

    public function createAnneeScolaire(Request $req)
    {
        $an = new AnneeScolaire();

        $an->an_description = $req->description;
        $an->an_date_debut = $req->datedebut;
        $an->an_date_fin = $req->datefin;
        $an->an_ouverte = 1;
        $an->save();

        return Redirect::back();
    }

    public function destroy($id)
    {

        $classe = Enseigner::findOrFail($id)->classe_id;
        Enseigner::find($id)->delete();

        return Redirect::route('matiere.show.classe', compact('classe'))
                ->with('info', 'Une matière a été retirée avec succès');
    }

    public function exists($matiere, $classe)
    {   
        // Ne pas enregistrer si la même matière est déjà assignée à une classe
        // TODO :: ajouter un controle sur l'année scolaire en cours également
        // ->where('annee_scolaire_id', AnneeScolaire::where('an_ouverte', true))

        $status = true;
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
