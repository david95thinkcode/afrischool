<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Jour;
use App\Models\Horaire;
use App\Models\Classe;
use App\Models\Enseigner;
use Illuminate\Http\Request;
use App\Http\Requests\StoreHoraireRequest;
use App\Http\Requests\HoraireGotoSecondStepRequest;
use Illuminate\Support\Facades\Redirect;
class HoraireController extends Controller
{

    public function search()
    {
        $enseigner_classes = Enseigner::all()->toArray();
        $classes = [];

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
        return view('dashboard.emploi-du-temps.search', compact('classes'));
    }

    /**
     * Retourne l'emploie du temps complet d'une classe donnée
     */
    public function showAllForClasse($classe)
    {
        $c = Classe::findorFail($classe);
        $horaires = DB::table('enseigner')
                    ->where('classe_id', $classe)
                    ->join('matieres', 'enseigner.matiere_id', '=', 'matieres.id')
                    ->join('classes', 'enseigner.classe_id', '=', 'classes.id')
                    ->join('professeurs', 'enseigner.professeur_id', '=', 'professeurs.id')
                    ->join('horaires', 'horaires.enseigner_id', '=', 'enseigner.id')
                    ->select('horaires.jour_id', 'horaires.debut', 'horaires.fin', 'matieres.intitule', 'professeurs.prof_nom', 'professeurs.prof_prenoms')
                    ->get();
        
        $horairesByDay = [];
        $horairesByDay['lundi'] = $horaires->where('jour_id', '=', 1);
        $horairesByDay['mardi'] = $horaires->where('jour_id', '=', 2);
        $horairesByDay['mercredi'] = $horaires->where('jour_id', '=', 3);
        $horairesByDay['jeudi'] = $horaires->where('jour_id', '=', 4);
        $horairesByDay['vendredi'] = $horaires->where('jour_id', '=', 5);
        $horairesByDay['samedi'] = $horaires->where('jour_id', '=', 6);
        $horairesByDay['dimanche'] = $horaires->where('jour_id', '=', 7);
        
        return view('dashboard.emploi-du-temps.show-for-classe', compact('c', 'horairesByDay'));
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
        // TODO: finir le controle de doublon et désactiver les comment marks
        // Controle doublon
        $action;
        // $collection = DB::table('horaires')
        //             ->where('jour_id', '=', $request->jour)
        //             ->join('enseigner', 'enseigner.id', '=', 'horaires.enseigner_id')
        //             ->where('enseigner.classe_id', '=', $request->classe)
        //             ->select('horaires.debut', 'horaires.fin')
        //             ->get();
        // dd($collection);
        // $exists = $collection->where('debut', '=', $request->debut);
        
        // dd($exists);
        // if (count($exists) > 0) {
        //     $action = "Impossible d'ajouter ce programme !";
        // }
        // else {
            
            $h = new Horaire();
            $h->debut = $request->debut;
            $h->fin = $request->fin;
            $h->jour_id = $request->jour;
            $h->enseigner_id = $request->enseigner;
            $h->save();
            $action = Redirect::route('emploi-du-temps.afficher', ['classe' => $request->classe])->with('status', 'Ajouté avec succès !');

        // }

        return $action;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Horaire  $horaire
     * @return \Illuminate\Http\Response
     */
    public function show($horaire)
    {
        //
    }

    // Recoit une classe comme donnée en post 
    // et redirige vers la page de cosnultation de l'emploi du temps de cette classe
    public function showHoraires(HoraireGotoSecondStepRequest $req)
    {
        $c = Classe::findorFail($req->classe);
        return Redirect::route('emploi-du-temps.afficher', ['classe' => $req->classe]);
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
