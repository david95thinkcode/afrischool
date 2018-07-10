<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCriteresBulletinRequest;
use App\Http\Controllers\Controller;
use App\Models\AnneeScolaire;
use App\Models\Classe;
use App\Models\Inscription;
use App\Models\Trimestre;

class BulletinController extends Controller
{
    //
    // etape1
    public function index()
    {
        return view('dashboard.bulletins.step-1');
    }

    public function SelectCriteres($niveau)
    {
        $attribute = '';
        switch ($niveau) {
            case 'PRM':
                $attribute = 'estPrimaire';
                break;
            case 'CLG':
                $attribute = 'estCollege';
                break;
            default:
                abort(404);
                break;
        }
        session()->put('classe.niveau', $niveau);
        $years = AnneeScolaire::all();
        $classes = Classe::where($attribute, true)->get();
        
        return view('dashboard.bulletins.step-2', compact('years', 'classes'));
    }

    public function ListEleves(StoreCriteresBulletinRequest $req)
    {
        $niveau = session()->get('classe.niveau');
        session()->put('classe.nom', Classe::findOrFail($req->classe)->first()->cla_intitule);
        session()->put('anneescolaire', AnneeScolaire::findorFail($req->anneeScolaire)->first()->an_description);
        $eleves = Inscription::with('eleve')
            ->where([
                ['classe_id', $req->classe],
                ['annee_scolaire_id', $req->anneeScolaire]
            ])
            ->get();
        $trimestres = Trimestre::all();

        return view('dashboard.bulletins.step-3', compact('eleves', 'trimestres'));
    }

    
    public function ShowByTrimestre($idTrimestre, $matricule)
    {
        // le matricule est le numéro de l'élève dan la table inscription

        $eleve = Inscription::with('eleve')
            ->where('id', $matricule)
            ->first();

        if ($eleve != null) {
            dd($eleve);
        }
        else {
            abort(404);
        }
    }
    

    /**
     * Retourne la moyenne générale
     *
     * @param [type] $notesArray
     * @return void
     */
    public function CalculMoyenneGene($notesArray)
    {

    }
}
