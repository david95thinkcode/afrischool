<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Matiere;
use App\Models\Classe;;
use App\Models\Professeur;
use App\Models\Eleve;

class DashboardController extends Controller
{
    public function Home() {
        $count;
        $count['mat'] = Matiere::count();
        $count['classes'] = Classe::count();
        $count['prof'] = Professeur::count();
        $count['eleves'] = Eleve::count();
        
        return view('welcome', compact('count'));
    }
    
}
