<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCriteresBulletinRequest;
use App\Http\Controllers\Controller;
use App\Models\AnneeScolaire;
use App\Models\Classe;
use App\Models\Enseigner;
use App\Models\Inscription;
use App\Models\Trimestre;
use App\Models\Note;
use App\Models\Matiere;

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
        session()->forget('classe.nom');
        session()->forget('classe.niveau');
        session()->forget('anneescolaire');

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
        session()->put('niveau', $niveau);
        $years = AnneeScolaire::all();
        $classes = Classe::where($attribute, true)->get();
        
        return view('dashboard.bulletins.step-2', compact('years', 'classes'));
    }

    public function ListEleves(StoreCriteresBulletinRequest $req)
    {
        $niveau = session()->pull('niveau'); //netoyage de la variable de session
        
        $trimestres = Trimestre::all();
        $year = AnneeScolaire::findOrFail($req->anneeScolaire)->toArray();
        $classe = Classe::findOrFail($req->classe)->toArray();
        session()->put('anneescolaire', $year);        
        session()->put('classe', $classe);
        
        $eleves = Inscription::with('eleve')
            ->where([
                ['classe_id', $req->classe],
                ['annee_scolaire_id', $req->anneeScolaire]
            ])
            ->get();

        return view('dashboard.bulletins.step-3', compact('eleves', 'trimestres'));
    }

    
    public function ShowByTrimestre($idTrimestre, $matricule)
    {
        // le matricule est le numéro de l'élève dans la table inscription
        
        
        $notesBrutes = [];
        $notesOrdonnes = [];
        $moyennesByMat = [];
        $moyenneGenerale;

        $eleve = Inscription::with('eleve')
            ->where('id', $matricule)
            ->first();

        if ($eleve != null) {
            // matière enseignées dans la classe
            $matEnseignees = Enseigner::with('matiere')
            ->where([
                ['classe_id', $eleve->classe_id],
                ['annee_scolaire_id', session()->get('anneescolaire.id')]
            ])
            ->get()
            ->toArray();

            // les notes de chaque matière
            foreach ($matEnseignees as $key => $m) {
                $note = Note::where([
                    ['annee_scolaire_id', $eleve->annee_scolaire_id],
                    ['eleve_id', $eleve->eleve_id],
                    ['classe_id', $eleve->classe_id],
                    ['trimestre_id', $idTrimestre],
                    ['matiere_id', $m['matiere_id']]
                ])
                ->get()
                ->toArray();
                array_push($notesBrutes, $note);
            }
            
            $notesOrdonnes = $this->OrdonnerNotes($notesBrutes, $matEnseignees);

            dd($notesBrutes);

            // TODO: ordonnons le tableau de notesbrutes

            // TODO: Calculons les moyennes par matière

            // TODO: Obtenons la moyenne générale

        }
        else {
            abort(404);
        }
    }
    

    private function OrdonnerNotes($notesBruteArray, $EnseignerArrays)
    {
        $distinctsMatieres = [];
        $orderedNotes = [];

        // Remplissage $distinctsMatieres
        foreach ($EnseignerArrays as $key => $e) {
            
            if (count($distinctsMatieres) == 0) {
                array_push($distinctsMatieres, $e['matiere_id']);
            } else {
                
                $found = false; // devient 
                foreach ($distinctsMatieres as $matiereID) {
                    if ($e['matiere_id'] == $matiereID) {
                        $found = true;
                    }
                }
                if (!$found) {
                    array_push($distinctsMatieres, $e['matiere_id']);
                }                
            }
        }

        // ordering notes
        // chaque collection de note de notesbrutes
        foreach ($notesBruteArray as $key => $noteCollection) {
            
            $matiereID; // identifiant de la matière
            $matiere = Matiere::findOrFail($matiereID);
            $classifiedNoteByMatiere = [
                'interrogation' => [],
                'devoir' => [],
                'examen' => []
            ];

            /** structuration des notes d'une matière dans un tableau
             * du genre
             * [
             *      'interrogation => [
             *                          [ 'note_not' => 12 ],
             *                          [ 'note_not' => 11 ],
             *                        ]
             * ]
             */ 
            foreach ($noteCollection as $k => $v) {  
                $matiereID = $v['matiere_id'];
                // var_dump($matiereID);
                switch ($v['types_evaluation_id']) {
                    case 1:
                        array_push($classifiedNoteByMatiere['interrogation'], $v);
                        break;
                    case 2:
                        array_push($classifiedNoteByMatiere['devoir'], $v);
                        break;
                    case 3:
                        array_push($classifiedNoteByMatiere['examen'], $v);
                        break;
                    default:
                        # code...
                        break;
                }
            }
            
            $orderedNotes[$matiere->intitule] = []; // très important
            array_push($orderedNotes[$matiere->intitule], $classifiedNoteByMatiere);
    
        }
        dd($orderedNotes);

        return $orderedNotes;
    }
    
    private function CalculerChaqueMoyenne($notesOrdonnesArray)
    {

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
