<?php

namespace App\Http\Controllers;

use App\Models\Depenses;
use App\Models\Inscription;
use Illuminate\Http\Request;

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
            Depenses::create(['libelle' => 'saisir libelle']);
            $depenses = Depenses::all();
            return view('comptabilite.indexDepenses', compact('depenses'));
        }
        return view('comptabilite.indexDepenses', compact('depenses'));
    }

    public function storeDepenses(Request $req)
    {
        $pk = $req->pk;
        $colonne = $req->name;
        $value = $req->value;
        Depenses::where('id', $pk)->update([$colonne => $value]);

        $dep = Depenses::orderBy('id', 'desc')->first();

        if($pk == $dep->id){
            Depenses::create();
            return response()->json(['code' => 'new'], 200);
        }

        return response()->json(['code' => 200], 200);
    }

    public function showDepense()
    {
        $depenses = Depenses::whereYear('created_at', '=', date('Y'))
            ->where('montant', '<>', null)
            ->get();

        return view('comptabilite.showDepenses', compact('depenses'));
    }
}
