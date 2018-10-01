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
use App\Models\PaiementScolarite;
use Illuminate\Support\Facades\Auth;

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
        $classe = (int) session('eleve.classe');
        $montant_scolarite = Classe::findOrFail($classe)->mt_scolarite;

        return view('inscriptions.scolarite', compact('annee_scolaires', 'montant_scolarite'));
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
            
        $mt_verser = (is_null($req->montant_verser)) ? 0 : $req->montant_verser;
        
        $inscription = $this->storeScolarite($eleve->id, session('eleve.classe'), $req->annee_scolaire,
            $mt_verser, $req->montant_scolarite, $req->date_inscription);
        $anneedebut = \Carbon\Carbon::parse($inscription->anneescolaire->an_date_debut)->format('Y');
        $anneefin = \Carbon\Carbon::parse($inscription->anneescolaire->an_date_fin)->format('Y');
        $message = $mt_verser.' fcfa a été payé par '
            .$eleve->nom.' '.$eleve->prenoms." pour l'annee scolaire "
            .$anneedebut.' - '.$anneefin.' reste '.$inscription->montant_restant." fcfa";
        $numero =  '229'.$parent->par_tel;
        $ecole = env('SCHOOL_NAME', 'AfrikaSchool');
        $this->senderParent($ecole, $numero, $message);

        return Redirect::route('inscriptions.show', ['inscription' => $inscription->id])
            ->with('status', 'Elève inscrit avec succès !');
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
        $mt_verser = (is_null($req->montant_verser)) ? 0 : $req->montant_verser;
        
        $eleve = Eleve::findOrFail(session('eleve'));
        $inscription = $this->storeScolarite($eleve->id, $req->classe, $req->annee_scolaire,
            $mt_verser, $req->montant_scolarite, $req->date_inscription);

        if($inscription->montant_restant == 0)
        {
            $inscription->est_solder = true;
            $inscription->save();
        }

        $anneedebut = \Carbon\Carbon::parse($inscription->anneescolaire->an_date_debut)->format('Y');
        $anneefin = \Carbon\Carbon::parse($inscription->anneescolaire->an_date_fin)->format('Y');
        $message = $mt_verser.' fcfa a été payé par '
            .$eleve->nom.' '.$eleve->prenoms." pour l'annee scolaire "
            .$anneedebut.' - '.$anneefin.' reste '.$inscription->reste." fcfa";
        $numero =  '229'.$eleve->parents->par_tel;
        $ecole = env('SCHOOL_NAME', 'AfrikaSchool');
        $this->senderParent($ecole, $numero, $message);

        return Redirect::route('inscriptions.show', ['inscription' => $inscription->id])
            ->with('status', 'Elève inscrit avec succès !');
    }

    /**
     * Reçoit une classe en paramètre et retourne la vue correspondante
     */
    public function searchForClasse(SearchInscriptionRequest $req)
    {
        return Redirect::route('inscriptions.classe.show', ['classe' => $req->classe]);
    }

    /**
     * Retourne une collection d'inscription pour une classe donnée
     * @param integer $classe_id
     */
    public function showForClasse($classe_id)
    {
        $inscriptions = Inscription::with('classe', 'eleve')
            ->where('classe_id', $classe_id)->get();

        if ($inscriptions->count() != 0) {            
            $concernedClasse = $inscriptions[0]->classe;
            return view('inscriptions.show', compact('inscriptions', 'concernedClasse'));
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
        $inscription = DB::table('inscriptions')
            ->where('inscriptions.id', '=', $id)
            ->join('classes', 'inscriptions.classe_id', '=', 'classes.id')
            ->join('eleves', 'inscriptions.eleve_id', '=', 'eleves.id')
            ->join('parents', 'eleves.id', '=', 'parents.id')
            ->get()
            ->first();

            // dd($inscription);
        return view('inscriptions.eleve-detail', compact('inscription'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inscription = DB::table('inscriptions')
            ->where('inscriptions.id', '=', $id)
            ->join('classes', 'inscriptions.classe_id', '=', 'classes.id')
            ->join('eleves', 'inscriptions.eleve_id', '=', 'eleves.id')
            ->join('parents', 'eleves.id', '=', 'parents.id')
            ->get()
            ->first();
        $classes = Classe::all();

        return view('inscriptions.edit-eleve', compact('inscription', 'classes'));
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
        $eleve = Eleve::find($id);
        $eleve->nom = $req->nom;
        $eleve->prenoms = $req->prenoms;
        $eleve->sexe = $req->sexe;
        $eleve->date_naissance = $req->date_naissance;

        if ($req->ancien == 1) {$eleve->ancien = true;}else{$eleve->ancien == false;$eleve->ecole_provenance = $req->ecole_provenance;}

        if ($req->redoublant == 1) {$eleve->redoublant = true;}else{$eleve->redoublant = false;}
        $eleve->save();

        return Redirect::route('inscriptions.edit',['id' => $id])->with('status', 'Informations élève modifiés avec succès !');
    }

    public function indexInfoParent($id)
    {
        $inscription = DB::table('inscriptions')
            ->where('inscriptions.id', '=', $id)
            ->join('classes', 'inscriptions.classe_id', '=', 'classes.id')
            ->join('eleves', 'inscriptions.eleve_id', '=', 'eleves.id')
            ->join('parents', 'eleves.id', '=', 'parents.id')
            ->get()
            ->first();

        return view('inscriptions.edit-parent', compact('inscription'));
    }

    public function updateInfoParent(Request $req, $id)
    {
        $parent = ParentEleve::find($id);
        $parent->par_nom = $req->nom_parent;
        $parent->par_prenoms = $req->prenoms_parent;
        $parent->par_sexe = $req->sexe_parent;
        $parent->par_tel = $req->tel_parent;
        $parent->par_email = $req->mail_parent;

        $parent->save();
        return Redirect::route('parent.info',['id' => $id])->with('status', 'Informations parent modifiés avec succès !');
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
        $inscription->montant_scolarite = (is_null($scolarite))?0:$scolarite;
        $inscription->montant_verse = 0;
        $inscription->reste = 0;
        $inscription->date_inscription = $date_inscription;
        $inscription->save();
        
        // Store Paiement
        if (!is_null($verser)) {
            $paiement = new PaiementScolarite();
            $paiement->montant = $verser;
            $paiement->tranche_scolarite_id = 1;
            $paiement->user_id = Auth::user()->id;
            $paiement->inscription_id = $inscription->id;
            $paiement->save();
        }
        
        // Un petit dernier contrôle
        if ($paiement->montant == $inscription->montant_scolarite) {
            $inscription->est_solder = true;
            $inscription->save();
        }

        return $inscription;
    }
}
