<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScoolariteRequest;
use Illuminate\Http\Request;
use DB;
use App\Traits\TraitSms;
use App\Traits\TraiteText;
use App\Models\Classe;
use App\Http\Requests\StoreInscriptionRequest;
use App\Http\Requests\SearchInscriptionRequest;
use App\Http\Requests\ReinsciptionRequest;
use App\Http\Requests\ParentRequest;
use App\Models\ParentEleve;
use App\Models\Eleve;
use App\Models\AnneeScolaire;
use App\Models\Inscription;
use Illuminate\Support\Facades\Redirect;

class InscriptionController extends Controller
{
    use TraitSms, TraiteText;
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
        session()->forget('eleve');
        session()->put('eleve',
            $req->only(['nom', 'prenoms', 'date_naissance', 'sexe', 'ancien',
                'ecole_provenance', 'classe', 'redoublant']));

        return Redirect::route('eleve.parent.index');
    }

    public function indexParent()
    {
        return view('inscriptions.info-parent');
    }

    public function sessionParent(ParentRequest $req)
    {
        session()->forget('parent');
        session()->put('parent',
            $req->only(['person_a_contacter_nom', 'person_a_contacter_tel', 'person_a_contacter_lien',
                'nom_parent', 'prenoms_parent', 'sexe_parent', 'tel_parent', 'mail_parent']));

        return Redirect::route('eleve.scolarite.index');
    }

    public function indexScolarite()
    {
        $annee_scolaires =  AnneeScolaire::all();
        return view('inscriptions.scolarite', compact('annee_scolaires'));
    }

    public function sessionScolarite(ScoolariteRequest $req)
    {
        $mobileFiltrer = $this->deleteSpace(session('parent.tel_parent'));
        $tel_parent = $this->deleteIndicatif($mobileFiltrer);
        $parent = $this->storeParent(session('parent.nom_parent'), session('parent.prenoms_parent'),
            session('parent.sexe_parent'), $tel_parent,
            session('parent.mail_parent'));

        $eleve = $this->storeEleve($parent->id, session('eleve.nom'), session('eleve.prenoms'),
            session('eleve.sexe'), session('eleve.date_naissance'), session('eleve.ancien'),
            session('eleve.redoublant'), session('eleve.ecole_provenance'),
            session('parent.person_a_contacter_nom'), session('parent.person_a_contacter_tel'),
            session('parent.person_a_contacter_lien'));

        $inscription = $this->storeScolarite($eleve->id, session('eleve.classe'), $req->annee_scolaire,
            $req->montant_verser, $req->montant_scolarite, $req->date_inscription);
        $anneedebut = \Carbon\Carbon::parse($inscription->anneescolaire->an_date_debut)->format('Y');
        $anneefin = \Carbon\Carbon::parse($inscription->anneescolaire->an_date_fin)->format('Y');
        $message = $inscription->montant_verse.' fcfa a été payé par '
            .$eleve->nom.' '.$eleve->prenoms." pour l'annee scolaire "
            .$anneedebut.' - '.$anneefin.' reste '.$inscription->reste." fcfa";
        $numero =  '229'.$parent->par_tel;
        $ecole = env('SCHOOL_NAME', 'AfrikaSchool');
        $this->senderParent($ecole, $numero, $message);

        return Redirect::route('inscriptions.create')->with('status', 'Elève inscrit avec succès !');
    }

    /**
     * Formulaire de saisie de scolarité
     */
    public function indexAncien($id)
    {
        session()->forget('eleve');
        session()->put('eleve', $id);
        $annee_scolaires =  AnneeScolaire::all();
        $classes = Classe::all();
        return view('inscriptions.paiement', compact('annee_scolaires', 'classes'));
    }

    /**
     * Reincription d'ancien élève
     */
    public function paiement(ReinsciptionRequest $req)
    {
        $eleve = Eleve::findOrFail(session('eleve'));
        $inscription = $this->storeScolarite($eleve->id, $req->classe, $req->annee_scolaire,
            $req->montant_verser, $req->montant_scolarite, $req->date_inscription);

        if($inscription->reste == 0)
        {
            $inscription->est_solder = true;
            $inscription->save();
        }

        $anneedebut = \Carbon\Carbon::parse($inscription->anneescolaire->an_date_debut)->format('Y');
        $anneefin = \Carbon\Carbon::parse($inscription->anneescolaire->an_date_fin)->format('Y');
        $message = $inscription->montant_verse.' fcfa a été payé par '
            .$eleve->nom.' '.$eleve->prenoms." pour l'annee scolaire "
            .$anneedebut.' - '.$anneefin.' reste '.$inscription->reste." fcfa";
        $numero =  '229'.$eleve->parents->par_tel;
        $ecole = env('SCHOOL_NAME', 'AfrikaSchool');
        $this->senderParent($ecole, $numero, $message);

        return Redirect::route('inscriptions.create')->with('status', 'Elève inscrit avec succès !');
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

    public function storeEleve($parent_id, $nom, $prenom, $sexe, $date, $ancien, $redoublant, $ecole, $pac_nom, $pac_tel, $pac_lien) {

        $eleve = new Eleve();

        if ($ancien == 1) {
            $eleve->ancien = true;
        } else {
            $eleve->ancien == true;
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

    public function storeScolarite($eleve, $classe, $anne_scolaire, $verser, $scolarite, $date_inscription)
    {
        $inscription = new Inscription();
        $inscription->eleve_id = $eleve;
        $inscription->classe_id = $classe;
        $inscription->annee_scolaire_id = $anne_scolaire;
        $inscription->montant_scolarite = $scolarite;
        $inscription->montant_verse = $verser;
        $inscription->reste = $scolarite - $verser;
        $inscription->date_inscription = $date_inscription;

        $inscription->save();

        return $inscription;
    }
}
