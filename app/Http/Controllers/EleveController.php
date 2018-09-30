<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classe;
use App\Models\Eleve;
use App\Models\Inscription;
use App\Traits\TraitSms;
use Illuminate\Support\Facades\Redirect;
use App\Models\TrancheScolarite;
use App\Http\Requests\Scolarite\StorePaiementScolariteRequest;
use App\Models\PaiementScolarite;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EleveController extends Controller
{
    use TraitSms;

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @param string type : nouveau / ancien
     */
    public function create($type)
    {
        $NOUVEL_ELEVE = 'nouveau';
        $ANCIEN_ELEVE = 'ancien';
        $vue = '';

        switch ($type) {
            case $NOUVEL_ELEVE:
                $classes = Classe::all();
                return view('inscriptions.info-eleve', compact('classes'));
                break;
            case $ANCIEN_ELEVE:
                $anciens = Eleve::where('ancien', true)->get();
                return view('inscriptions.select_ancien', compact('anciens'));
                break;
            default:
                abort(404);
                break;
        }

        $classes = Classe::all();
        return view($vue, compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function listeInsolder()
    {
        $debiteurs = Inscription::with('eleve')->where('est_solder', false)->get();        
        return view('scolarite.eleve_non_solde', compact('debiteurs'));
    }

    /**
     * @param integer $inscrit [Représente le numéro d'inscription de l'élève]
     * @param integer $eleve   [Id de l'élève dans la table eleves]
     * @return 
     */
    public function indexsolderScolarite($inscrit, $eleve)
    {
        $tranches = TrancheScolarite::all();
        $reste = Inscription::findOrFail($inscrit)->montant_restant;

        session()->forget('inscrit');
        session()->forget('eleve');
        session()->put('inscrit', $inscrit);
        session()->put('eleve', $eleve);
        return view('scolarite.paiement', compact('tranches', 'reste'));
    }

    public function solderScolarite(StorePaiementScolariteRequest $req)
    {
        $inscrit = Inscription::findOrFail(session('inscrit'));
        $reste = $inscrit->montant_restant;
        
        if ($reste > 0) {
            if (!($this->SamePaiyementIsAlreadyStoredToday($req->montant_verser, $req->tranche, $inscrit->id))) {
                $paiement = $this->storePaiement($req->montant_verser, $req->tranche, $inscrit->id);
            }
            // Est-ce que la scolarité est entièrement payée ?
            if ($inscrit->montant_restant == 0) {
                $inscrit->est_solder = true;
                $inscrit->save();
            };

            // Formation et expédition du message au parent
            $eleve = Eleve::findOrFail(session('eleve'));
            $message = $req->montant_verser.' fcfa ont été payé par '
            .$eleve->nom.' '.$eleve->prenoms.". Reste: ". $reste . " fcfa";
            $numero = '229' . $eleve->parent->par_tel;
            $ecole = env('SCHOOL_NAME', 'AfrikaSchool');
            $this->senderParent($ecole, $numero, $message);
            
            return Redirect::route('eleve.reste.versement')->with('status', 'Paiement enregistré avec succès !');
        }
        else {
            dd("Nous ne pouvons enregistrer ce paiement car n'avez rien a payer normalement");
        }
    }

    /**
     * @param integer $montant
     * @param integer $tranche
     * @param integer $inscription
     * @return \App\Models\PaiementScolarite;
     */
    private function storePaiement($montant, $tranche, $inscription)
    {
        $p = new PaiementScolarite();
        $p->montant = $montant;
        $p->tranche_scolarite_id = $tranche;
        $p->inscription_id = $inscription;
        $p->user_id = Auth::user()->id;
        $p->save();

        return $p;
    }

    /**
     * Retourne true si ce paiemment a déjà été enregistré aujourd'hui
     * @param integer $montant
     * @param integer $tranche
     * @param integer $inscription
     * @return Boolean
     */
    private function SamePaiyementIsAlreadyStoredToday($montant, $tranche, $inscription)
    {
        $paid = PaiementScolarite::where([
            ['montant', $montant],
            ['tranche_scolarite_id', $tranche],
            ['inscription_id', $inscription]
        ])->first();
        
        if (is_null($paid)) return false;

        return ((Carbon::today())->toDateString()) == ($paid->created_at->toDateString());
    }

    public function storeScolarite($eleve, $classe, $anne_scolaire, $verser, $scolarite, $reste, $date_inscription)
    {
        $inscription = new Inscription();
        $inscription->eleve_id = $eleve;
        $inscription->classe_id = $classe;
        $inscription->annee_scolaire_id = $anne_scolaire;
        $inscription->montant_scolarite = $scolarite;
        $inscription->montant_verse = $verser;
        $inscription->reste = $reste;
        $inscription->date_inscription = $date_inscription;

        $inscription->save();

        return $inscription;
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {

    }

    public function update(Request $req)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
