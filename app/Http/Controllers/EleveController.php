<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classe;
use App\Models\Eleve;
use App\Models\Inscription;
use App\Traits\TraitSms;
use Illuminate\Support\Facades\Redirect;

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

    public function indexsolderScolarite($inscrit, $eleve)
    {
        session()->forget('inscrit');
        session()->forget('eleve');
        session()->put('inscrit', $inscrit);
        session()->put('eleve', $eleve);
        return view('scolarite.paiement');
    }

    public function solderScolarite(Request $req)
    {
        $inscrit = Inscription::findOrFail(session('inscrit'));

        $rules = ['montant_verser' => "required|numeric|max:$inscrit->reste"];

        $customMessages = [
            'montant_verser.required' => 'Veuillez indiquez le mondant versé.',
            'montant_verser.max' => "Le montant versé ne doit pas être supérieur au $inscrit->reste fcfa restant"
        ];

        $this->validate($req, $rules, $customMessages);

        $reste = $inscrit->reste - $req->montant_verser;

        $inscription = $this->storeScolarite($inscrit->eleve_id, $inscrit->classe_id,
        $inscrit->annee_scolaire_id, $req->montant_verser, $inscrit->montant_scolarite,
            $reste, $inscrit->date_inscription);

        if($inscription->reste == 0)
        {
            $inscription->est_solder = true;
            $inscription->save();
        }

        $inscrit->est_solder = true;
        $inscrit->save();

        $eleve = Eleve::findOrFail(session('eleve'));
        $message = $inscription->montant_verse.' fcfa a été payé par '
        .$eleve->nom.' '.$eleve->prenoms." reste ".$inscription->reste." fcfa";
        $numero = '229' . $eleve->parents->par_tel;
        $ecole = env('SCHOOL_NAME', 'AfrikaSchool');
        $this->senderParent($ecole, $numero, $message);

        return Redirect::route('eleve.reste.versement')->with('status', 'Scolarité soldé avec succès !');
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
