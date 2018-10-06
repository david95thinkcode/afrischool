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
        $classes = Classe::all();
        return view('dashboard.emploi-du-temps.search', compact('classes'));
    }

    /**
     * Retourne l'emploi du temps complet d'une classe donnée
     * @param integer $classe
     * @return 
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
                    ->select('horaires.id as horaire_id', 'horaires.jour_id', 'horaires.debut', 'horaires.fin', 'matieres.intitule', 'professeurs.prof_nom', 'professeurs.prof_prenoms')
                    ->get();
        // dd($horaires);
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
        $classes = Classe::all();    
        return view('dashboard.emploi-du-temps.create-first-step', compact('classes'));
    }
    
    /**
     * Retourne les classes pour lesquelles
     * au moins une matière est déjà enseignée donc
     * une classe éligible pour l'ajout de l'horaire d'une matière
     * consitituant l'emploi du temps
     * 
     * @param null
     * @return array $classes;
     */
    private function getHorairableClasses()
    {
        $enseigner_classes = Enseigner::all()->toArray();
        $classes = [];
        
        // Stocker chaque classe dans le array " $classes "
        // tout en évitant d'ajouter celles qui se répètent
        foreach ($enseigner_classes as $item) {
            $exists = false;
            foreach ($classes as $classe) {
                $exists = $classe['id'] == $item['classe_id'] ? true : $exists;
            }            
            if (!$exists) {
                $classe_data = [];
                $classe_data['id'] = $item['classe_id'];
                $classe_data['datas'] = Classe::findorFail($item['classe_id']);
                array_push($classes, $classe_data);
            }
        }

        return $classes;
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
        // On vérifie que l'horaire en cours d'enregistrement...
        // n'interfère pas ou ne s'infiltre pas dans une plage horaire
        // déjà attribuée.
        // Par exemple : 
        // On ne peut pas enregistrer une matière le jeudi qui commence
        // de 8h à 11h alors qu'il y a déjà une matière qui occupait la plage de
        // 10h à 12 le jeudi dans cette même classe

        $detailedEnseigner = Enseigner::findOrFail($request->enseigner);
        $horairesAtribues = Horaire::with('enseigner')->where('jour_id', $request->jour)->get();
        
        foreach ($horairesAtribues as $key => $horaire) {

            if ($horaire->enseigner->classe_id == $detailedEnseigner->classe_id) {
                
                if (!(((strtotime($request->debut)) >= (strtotime($horaire->fin))) 
                || ((strtotime($request->fin)) <= (strtotime($horaire->debut))))) 
                {
                    $msg = "Horaire non atribuable car cette plage horaire interfère avec celle d'une autre matière";
                    return Redirect::route('horaire.second-step.go')->with('warning', $msg);
                }
            }
        }
        
        $h = new Horaire();
        $h->debut = $request->debut;
        $h->fin = $request->fin;
        $h->jour_id = $request->jour;
        $h->enseigner_id = $request->enseigner;
        $h->save();

        return Redirect::route('emploi-du-temps.afficher', ['classe' => $request->classe])
            ->with('status', 'Ajouté avec succès !');
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
    public function destroy($id)
    {
        $horaire = Horaire::findOrFail($id);
        $classe =  $horaire->enseigner->classe;
        $horaire->delete();
        
        return Redirect::route('emploi-du-temps.afficher', ['classe' => $classe])
                ->with('status', ' Un programme a été retiré avec succès !');;
    }
}
