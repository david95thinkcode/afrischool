<?php

namespace App\Http\Controllers;

use App\Models\Jour;
use App\Models\Horaire;
use App\Models\Classe;
use App\Models\Enseigner;
use Illuminate\Http\Request;
use App\Http\Requests\StoreHoraireRequest;
use App\Http\Requests\HoraireGotoSecondStepRequest;

class HoraireController extends Controller
{

    /**
     * Retourne l'emplie du temps d'une classe données
     */
    public function showForClasse($classe)
    {
        return('En cours de dev...');
    }

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
        $enseigner_classes = Enseigner::all()->toArray();
        $classes = [];
        
        // Stocker chaque classe dans le array " $classes "
        // tout en évitant d'ajouter celles qui se répètent
        foreach ($enseigner_classes as $item) {
            $exists = false;
            foreach ($classes as $classe) {
                if ($classe['id'] == $item['classe_id']) {
                    $exists = true;
                }
            }            
            if (!$exists) {
                $classe_data = [];
                $classe_data['id'] = $item['classe_id'];
                $classe_data['datas'] = Classe::findorFail($item['classe_id']);
                array_push($classes, $classe_data);
            }
        }
        return view('dashboard.emploi-du-temps.create-first-step', compact('classes'));
    }

    /**
     * Retourne la seconde étape pour ajouter un horaire
     */
    public function createSecondStep(HoraireGotoSecondStepRequest $req)
    {
        $classe = Classe::findorFail($req->classe);
        $enseigner = $classe->enseigner;
        $jours = Jour::all();
        $matieres = [];

        foreach ($enseigner as $ens_item) {
            $matiere_data = [
                'enseigner_id' => $ens_item->id,
                'datas' => $ens_item->matiere
            ];
            array_push($matieres, $matiere_data);
        }

        return view('dashboard.emploi-du-temps.create-second-step', compact('classe','matieres','enseigner','jours'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHoraireRequest $request)
    {
        $h = new Horaire();
        $h->debut = $request->debut;
        $h->fin = $request->fin;
        $h->jour_id = $request->jour;
        $h->enseigner_id = $request->enseigner;
        $h->save();

        return ("DONE");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Horaire  $horaire
     * @return \Illuminate\Http\Response
     */
    public function show(Horaire $horaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Horaire  $horaire
     * @return \Illuminate\Http\Response
     */
    public function edit(Horaire $horaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Horaire  $horaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Horaire $horaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Horaire  $horaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Horaire $horaire)
    {
        //
    }
}
