<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Salaire\GetSalaireDetailsRequest;
use App\Models\PresenceProfesseur;

class SalaireController extends Controller
{
    public function index() {
        return view('comptabilite/salaire-index');
    }

    public function getSalaireDetails(GetSalaireDetailsRequest $req) {
        
        $p = PresenceProfesseur::where('real_professeur_id', $req->prof)
            ->whereYear('date', $req->year)
            ->whereMonth('date', $req->month)
            ->get();
        
        


        $returnable = new \StdClass();
        $returnable->datas = $p;

        // todo: calcul salaire 


        return response()->json($returnable, 200);
    }

    public function dashboard() {
        return view('comptabilite/salaire-dashboard');
    }
}
