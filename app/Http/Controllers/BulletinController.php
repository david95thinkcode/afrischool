<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCriteresBulletinRequest;
use App\Models\AnneeScolaire;
use App\Models\Classe;
use App\Models\Enseigner;
use App\Models\Inscription;
use App\Models\Matiere;
use App\Models\Note;
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
                ['annee_scolaire_id', $req->anneeScolaire],
            ])
            ->get();

        return view('dashboard.bulletins.step-3', compact('eleves', 'trimestres'));
    }

    public function ShowByTrimestre($idTrimestre, $matricule)
    {
        // le matricule est le numéro de l'élève dans la table inscription
        $view = '';
        $notesBrutes = [];
        $notesOrdonnes = [];
        $moyennesByMat = [];
        $moyenneGenerale;

        $eleve = Inscription::with('eleve')
            ->where('id', $matricule)
            ->first();

        if ($eleve != null) {
            // matière enseignées dans la classe
            $matEnseignees = Enseigner::with('matiere', 'professeur')
                ->where([
                    ['classe_id', $eleve->classe_id],
                    ['annee_scolaire_id', session()->get('anneescolaire.id')],
                ])
                ->get();

            // les notes de chaque matière
            foreach ($matEnseignees as $key => $m) {
                $note = Note::where([
                    ['annee_scolaire_id', $eleve->annee_scolaire_id],
                    ['eleve_id', $eleve->eleve_id],
                    ['classe_id', $eleve->classe_id],
                    ['trimestre_id', $idTrimestre],
                    ['matiere_id', $m['matiere_id']],
                ])
                    ->get();

                if (count($note) > 0) {
                    array_push($notesBrutes, $note);
                }
            }

            if (count($notesBrutes) > 0) {
                $notesOrdonnes = $this->OrdonnerNotes($notesBrutes, $matEnseignees);
                // dd($notesOrdonnes);

                // Montrons la vue adéquate
                if (session()->get('classe.estPrimaire') == 1) {
                    $view = 'dashboard.bulletins.b-primaire';
                } else if (session()->get('classe.estCollege') == 1) {
                    $view = 'dashboard.bulletins.b-college';
                }

                return view($view, compact('eleve', 'notesOrdonnes'));

            } else {
                // TODO pour @Romeo 
                // faire une vue pour afficher le message ci-dessous dedans
                return ('Impossible de générer le bulletin car aucune note enregistrée pour ce trimestre');
            }

        } else {
            abort(404);
        }
    }

    private function OrdonnerNotes($notesBruteArray, $EnseignerArrays)
    {
        $distinctsMatieres = [];
        $orderedNotes = [];

        $classeID = $notesBruteArray[0][0]['classe_id'];
        $yearID = $notesBruteArray[0][0]['annee_scolaire_id'];

        // Remplissage $distinctsMatieres
        foreach ($EnseignerArrays as $key => $e) {

            if (count($distinctsMatieres) == 0) {
                array_push($distinctsMatieres, $e['matiere_id']);
            } else {

                $found = false;
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

            $matiereID;
            $matiere = Matiere::findOrFail($matiereID);
            $classifiedNoteByMatiere = [
                'interrogation' => [],
                'devoir' => [],
                'examen' => [],
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

            // Détails de la amtière
            $matiereDetails;

            foreach ($EnseignerArrays as $ensIndex => $enseignerModel) {
                if ($enseignerModel->matiere->id == $matiere->id) {
                    $matiereDetails = $enseignerModel;
                    // echo("Trouvé : " . $enseignerModel->matiere->id . " == " . $matiereID . " - " );
                    // echo ($matiereDetails->matiere->intitule . ' : ' .$matiereDetails->professeur->prof_nom . ' ' . $matiereDetails->professeur->prof_prenoms . "\n");
                }
            }

            // Finalisation
            $orderedNotes[$matiere->intitule]['details'] = $matiereDetails;
            $orderedNotes[$matiere->intitule]['notes'] = $classifiedNoteByMatiere;
        }

        return $orderedNotes;
    }

}
