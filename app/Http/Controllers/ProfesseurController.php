<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProfesseurRequest;
use Illuminate\Support\Facades\Redirect;
use App\Models\Classe;
use App\Models\Professeur;
use App\Http\Requests\SearchProfesseurAboutClasseRequest;
use App\Models\Enseigner;
use App\Http\Requests\SearchProfesseurRequest;

class ProfesseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Classe::all();
        return view('dashboard.professeurs.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.professeurs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfesseurRequest $request)
    {
        $prof = new Professeur();
        $prof->prof_nom = $request->prof_nom;
        $prof->prof_prenoms = $request->prof_prenoms;
        $prof->prof_tel = $request->prof_tel;
        $prof->prof_email = $request->prof_email;
        $prof->prof_sexe = $request->prof_sexe;
        $prof->prof_date_naissance = $request->prof_date_naissance;
        $prof->prof_nationalite = $request->prof_nationalite;
        $prof->save();

        return Redirect::route('professeurs.index')
                ->with('status', 'Enregistré !');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $p = Professeur::with('diplomes')
            ->where('id', $id)
            ->first();
        $enseigner = Enseigner::with('classe')
            ->where('professeur_id', $p->id)
            ->get();

        return view('dashboard.professeurs.show', compact('p', 'enseigner'));
    }

    /**
     * Retourne les professeurs pour une classe donnée
     * @param Request $req
     * @return view
     */
    public function listProfesseur(SearchProfesseurAboutClasseRequest $req)
    {
        $sorted = [];
        $classe = Classe::findOrFail($req->classe);
        $ens = DB::table('enseigner')
                ->where('classe_id', '=', $classe->id)
                ->join('professeurs', 'enseigner.professeur_id', '=', 'professeurs.id')
                ->join('matieres', 'enseigner.matiere_id', '=', 'matieres.id')
                ->get();
        
        // CLASSONS UN PEU LE CONTENU DANS UN NOUVEAU TABLEAU 
        foreach ($ens as $key => $row) {            
            if (!isset($sorted[$row->professeur_id])) {
                $m = [];
                array_push($m, $row->intitule);
                $sorted[$row->professeur_id] = [
                    'id' => $row->professeur_id,
                    'datas' => $row,
                    'matieres' => $m
                ];
            } else {
                array_push($sorted[$row->professeur_id]['matieres'], $row->intitule);
            }
        }
        return view('dashboard.professeurs.list-with-matiere', compact('classe', 'sorted'));
    }

    /**
     * Affiche la liste des résultats d'une recherche 
     * de professeur
     * @param 
     * @return 
     */
    public function searchResults(SearchProfesseurRequest $req)
    {
        $classes = Classe::all();
        $msg = 'Résultats des recherches';

        if (isset($req->classe)) {
            $professeurs = DB::table('enseigner')
                ->where('classe_id', $req->classe)
                ->join('classes', 'enseigner.classe_id', '=', 'classes.id')
                ->join('professeurs', 'enseigner.professeur_id', '=', 'professeurs.id')
                ->where('professeurs.prof_nom', 'like', '%'.$req->keyword.'%')
                ->orWhere('professeurs.prof_prenoms', 'like', '%'.$req->keyword.'%')
                ->get();            
        }
        else {
            $professeurs = Professeur::where('prof_nom', 'like', '%'.$req->keyword.'%')
                ->orWhere('prof_prenoms', 'like', '%'. $req->keyword .'%')
                ->get();
        }

        // TODO: géré les doubons
        // suppression des doublons
        // foreach ($professeurs as $key => $value) {
            // if ($value->professeur_id ==)
        // }

        // Formation du message
        if (count($professeurs)) {
            $msg = $msg . ' - classe : '.$professeurs[0]->cla_intitule . ' ; ';
            $msg = $msg . "professeur : ' ". $req->keyword . " '";
        } else {
            $msg = $msg . ' : AUCUN RESULTAT TROUVE';
        }

        return view('dashboard.professeurs.list-all', compact('msg', 'classes', 'professeurs'));
    }

    /**
     * Retourne tous les professeurs
     */
    public function listAll()
    {
        $professeurs = Professeur::all();
        $classes = Classe::all();

        return view('dashboard.professeurs.list-all', compact('professeurs', 'classes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prof = Professeur::find($id);

        return view('dashboard.professeurs.edit', compact('prof'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProfesseurRequest $request, $id)
    {
        $prof = Professeur::findorFail($id);
        $prof->prof_nom = $request->prof_nom;
        $prof->prof_prenoms = $request->prof_prenoms;
        $prof->prof_tel = $request->prof_tel;
        $prof->prof_email = $request->prof_email;
        $prof->prof_sexe = $request->prof_sexe;
        $prof->prof_date_naissance = $request->prof_date_naissance;
        $prof->prof_nationalite = $request->prof_nationalite;
        $prof->save();

        return Redirect::route('professeurs.index')
                ->with('status', 'Modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Professeur::findorFail($id)->delete();

        return Redirect::route('professeurs.index')->with('status', 'Supprimé avec succès !');
    }
    
    /**
     * Returns all model as JSON resource
     *
     * @return void
     */
    public function fetch() {
        return response()->json(Professeur::all(), 200);
    }
}
