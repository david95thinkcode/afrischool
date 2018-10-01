<?php

namespace App\Http\Controllers;

use App\Models\Depenses;
use App\Models\Inscription;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;

class ComptabiliteController extends Controller
{

    public function index()
    {
        $solde = Inscription::with(['eleve', 'classe'])->whereYear('date_inscription', '=', date('Y'))->get();
        $depense = Depenses::whereYear('created_at', '=', date('Y'))->get();

        return view('comptabilite.index', compact('solde', 'depense'));
    }

    public function indexDepenses()
    {
        $depenses = Depenses::all();
        $dep = Depenses::first();
        if(empty($dep))
        {
            Depenses::create(['libelle' => 'saisir libelle', 'montant' => 0]);
            $depenses = Depenses::all();
            return view('comptabilite.indexDepenses', compact('depenses'));
        }
        return view('comptabilite.indexDepenses', compact('depenses'));
    }

    public function storeDepenses(Request $req)
    {
        if ($req->ajax()) {
            $pk = $req->pk;
            $colonne = $req->name;
            $value = $req->value;
            Depenses::where('id', $pk)->update([$colonne => $value]);
    
            $dep = Depenses::orderBy('id', 'desc')->first();
    
            if($pk == $dep->id){
                Depenses::create(['libelle' => 'saisir libelle', 'montant' => 0]);
                return response()->json(['code' => 'new'], 200);
            }
    
            return response()->json(['code' => 200], 200);
        } 
        else {
            $d = new Depenses;
            $d->libelle = $req->name;
            $d->montant = $req->value;
            $d->save();

            Flashy::success("Enregistré");
            return back();
        }
    }

    public function showDepense()
    {
        $depenses = Depenses::whereYear('created_at', '=', date('Y'))
            ->where('montant', '<>', 0)
            ->get();

        return view('comptabilite.showDepenses', compact('depenses'));
    }

    public function periodeDepense(Request $req)
    {
        $depenses = Depenses::where('created_at', '>=', $req->datedebut)
            ->where('created_at', '<=', $req->datefin)
            ->where('montant', '<>', 0)
            ->get();

        return view('comptabilite.showDepenses', compact('depenses'));
    }
}
