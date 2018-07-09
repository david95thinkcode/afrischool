<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Niveau;
use App\Models\Professeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreClasseRequest;
use App\Http\Requests\UpdateClasseRequest;

class ClasseController extends Controller
{
    const COLLEGE_ID = 'CLG';
    const PRIMAIRE_ID = 'PRM';
    const UNIVERSITE_ID = 'UNV';
    const NIVEAUCLASSE = [
        self::PRIMAIRE_ID => "Primaire",
        self::COLLEGE_ID => "Collège",
        self::UNIVERSITE_ID => "Université"
    ];

    public function index()
    {
        $numberOfClasses = [
            self::PRIMAIRE_ID => Classe::where('estPrimaire', true)->count(),
            self::COLLEGE_ID => Classe::where('estCollege', true)->count(),
            self::UNIVERSITE_ID => Classe::where('estUniversite', true)->count()
        ];
        return view('dashboard.classes.index', compact('numberOfClasses'));
    }

    public function create()
    {    
        $typedeclasse = self::NIVEAUCLASSE;
        return view('dashboard.classes.create', compact('typedeclasse'));
    }

    public function store(StoreClasseRequest $request)
    {
        $classe = new Classe();
        $classe->cla_intitule = $request->cla_intitule;
        $classe->cla_description = $request->cla_description;
        switch ($request->niveau) {
            case self::PRIMAIRE_ID:
                $classe->estPrimaire = true;
                break;
            case self::COLLEGE_ID:
                $classe->estCollege = true;
                break;
            case self::UNIVERSITE_ID:
                $classe->estUniversite = true;
                break;    
            default:
                # code...
                break;
        }
        $classe->save();

        return Redirect::route('classe.index')
                ->with('status', $classe->cla_intitule . ' enregistré !');
    }


    public function show($id)
    {
        $c = Classe::find($id);
        return response()->json($c, 200);
    }

    public function listclasse($niveau)
    {
        switch ($niveau) {
            case self::PRIMAIRE_ID:
                $classes = Classe::where('estPrimaire', true)->get();
                break;
            case self::COLLEGE_ID:
                $classes = Classe::where('estCollege', true)->get();
                break;
            case self::UNIVERSITE_ID:
                $classes = Classe::where('estUniversite', true)->get();
                break; 
            default:
                $classes = null;
                break;
            }
        $message = self::NIVEAUCLASSE[$niveau];
            
        return view('dashboard.classes.list', compact('classes', 'message'));
    }

    public function edit($id)
    {
        $classe = Classe::findOrFail($id);
        $typedeclasse = self::NIVEAUCLASSE;
        return view('dashboard.classes.edit', compact('classe', 'typedeclasse'));
    }


    public function update(UpdateClasseRequest $request, $id)
    {
        $classe = Classe::find($id);
        $classe->cla_intitule = $request->cla_intitule;
        $classe->cla_description = $request->cla_description;
        switch ($request->niveau) {
            case self::PRIMAIRE_ID:
                $classe->estPrimaire = true;
                break;
            case self::COLLEGE_ID:
                $classe->estCollege = true;
                break;
            case self::UNIVERSITE_ID:
                $classe->estUniversite = true;
                break;    
            default:
                # code...
                break;
        }
        $classe->save();

        return Redirect::route('classe.index')->with('status', 'Modifié avec succès !');
    }


    public function destroy($id)
    {
        Classe::find($id)->delete();

        return Redirect::route('classe.index')
                ->with('status', 'Une classe a été supprimé avec succès !');
    }
}
