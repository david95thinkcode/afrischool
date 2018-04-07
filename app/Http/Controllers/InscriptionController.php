<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Classe;
use App\Http\Requests\StoreInscriptionRequest;
use App\Models\ParentEleve;
use App\Models\Eleve;
use App\Models\Inscription;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\SearchInscriptionRequest;

class InscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $inscriptions = Inscription::all();
      $classes = Classe::all();

      return view('inscriptions.index', compact('inscriptions', 'classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('inscriptions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInscriptionRequest $req)
    {
        $parent = $this->storeParent($req->nom_parent, $req->prenoms_parent, $req->sexe_parent, $req->tel_parent, $req->mail_parent);
        $eleve = $this->storeEleve($parent->id, $req->nom, $req->prenoms, $req->sexe, $req->date_naissance, $req->ancien, $req->redoublant, $req->ecole_provenance, $req->person_a_contacter_nom, $req->person_a_contacter_tel, $req->person_a_contacter_lien);

        $inscription = new Inscription();
        $inscription->eleve_id = $eleve->id;
        $inscription->classe_id = $req->classe;

        $inscription->save();

        return Redirect::route('inscriptions.index')->with('status', 'Elève inscrit avec succès !');
    }

    /**
     * Reçoit une classe en paramètre et retourne la vue correspondante
     */
    public function searchForClasse(SearchInscriptionRequest $req)
    {
        return Redirect::route('inscriptions.classe.show', ['classe' => $req->classe]);
    }

    /**
     * Retourne sur une collection d'inscription pour une classe donnée
     */
    public function showForClasse($classe_id)
    {
        $inscriptions = Inscription::where('classe_id', $classe_id)->get();

        if ($inscriptions->count() != 0) {
            $classes = Classe::all();

            return view('inscriptions.show', compact('inscriptions', 'classes'));
        }
        else {
            $classe = Classe::find($classe_id);

            return view('inscriptions.show-empty', compact('classe'));
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
      $ins = DB::table('inscriptions')
            ->where('inscriptions.id', '=', $id)
            ->join('classes', 'inscriptions.classe_id', '=', 'classes.id')
            ->join('eleves', 'inscriptions.eleve_id', '=', 'eleves.id')
            ->join('parents', 'eleves.id', '=', 'parents.id')
            ->get()
            ->first();

        dd($ins);
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

    /**
     *
     */
    public function storeEleve($parent_id, $nom, $prenom, $sexe, $date, $ancien, $redoublant, $ecole, $pac_nom, $pac_tel, $pac_lien) {

        $eleve = new Eleve();

        if ($ancien == 1) {
            $eleve->ancien = true;
        } else {
            $eleve->ancien == false;
            $eleve->ecole_provenance = $ecole;
        }

        if ($redoublant == 1) {
            $eleve->redoublant = true;
        } else {
            $eleve->redoublant = false;
        }

        $eleve->nom = $nom;
        $eleve->prenoms = $prenom;
        $eleve->sexe = $sexe;
        $eleve->date_naissance = $date;
        $eleve->person_a_contacter_nom = $pac_nom;
        $eleve->person_a_contacter_tel = $pac_tel;
        $eleve->person_a_contacter_lien = $pac_lien;
        $eleve->parent_id = $parent_id;

        $eleve->save();

        return $eleve;
    }

    /**
     *
     */
    public function storeParent($nom, $prenom, $sexe, $tel, $email)
    {
        $parent = new ParentEleve();
        $parent->par_nom = $nom;
        $parent->par_prenoms = $prenom;
        $parent->par_sexe = $sexe;
        $parent->par_tel = $tel;
        $parent->par_email = $email;

        $parent->save();

        return $parent;
    }
}
