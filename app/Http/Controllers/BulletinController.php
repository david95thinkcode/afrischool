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
        $bulletinview = '';
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

                if (session()->get('classe.estPrimaire') == 1) {
                    $bulletinview = 'dashboard.bulletins.b-primaire';
                } else if (session()->get('classe.estCollege') == 1) {
                    $bulletinview = 'dashboard.bulletins.b-college';
                }
                return view($bulletinview, compact('eleve', 'notesOrdonnes'));

            } 
            else {
                // TODO pour @Romeo : faire une vue pour afficher le message ci-dessous dedans
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
            $matiereDetails;
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
            foreach ($noteCollection as $k => $noteModel) {                
                
                foreach ($distinctsMatieres as $distMatKey => $distMatvalue) {
                    
                    // On compare la matiere de la note à l'ID de la matière
                    // actuellement dans la boucle du tableau de matière distinctes 
                    //  
                    if ($noteModel['matiere_id'] == $distMatvalue) {
                        
                        $matiereID = $noteModel['matiere_id'];
        
                        switch ($noteModel['types_evaluation_id']) {
                            case 1:
                                array_push($classifiedNoteByMatiere['interrogation'], $noteModel);
                                break;
                            case 2:
                                array_push($classifiedNoteByMatiere['devoir'], $noteModel);
                                break;
                            case 3:
                                array_push($classifiedNoteByMatiere['examen'], $noteModel);
                                break;
                            default:
                                # code...
                                break;
                        }
                    }
                }
            }

            $matiere = Matiere::findOrFail($matiereID);// Détails de la matière

            foreach ($EnseignerArrays as $ensIndex => $enseignerModel) {
                if ($enseignerModel->matiere->id == $matiere->id) {
                    $matiereDetails = $enseignerModel;
                }
            }

            // Finalisation
            $orderedNotes[$matiere->intitule]['details'] = $matiereDetails;
            $orderedNotes[$matiere->intitule]['notes'] = $classifiedNoteByMatiere;
        }

        return $orderedNotes;
    }

    public function ShowFinal($matricule)
    {
        $notesByTrimestre = [];
        $avgByTrimestreAndMatiere = [];
        $trimestreAVG = []; 

        $eleve = Inscription::with('eleve', 'classe')
            ->where('id', $matricule)
            ->first();
        
        if (!is_null($eleve)) {

            // Filling $noteByTrimestre
            for ($trimestre=1; $trimestre < 4; $trimestre++) 
            { 
                $notes = $this->getNotesByTrimestre($trimestre, $eleve->id);
                $notesByTrimestre[$trimestre] = $notes;
            }

            // Filling $avgByTrimestreAndMatiere
            // NB : $key correspond au numero du trimestre;
            foreach ($notesByTrimestre as $key => $trimestreNoteArray) {
                if ((!is_null($trimestreNoteArray)) || (count($trimestreNoteArray)> 0)) {
                    $avgs = [];

                    // Calculer la moyenne de devoir et d'interro
                    foreach ($trimestreNoteArray as $tnaKey => $tnaValue) {
                        // Moyenne Interrogation si eleve en college
                        if ($eleve->classe->estCollege == 1) {
                            $avgInterro = $this->getInterrogationAVG($tnaValue['notes']['interrogation']);
                            $avgs[$tnaKey]['moyenne']['interrogation'] = $avgInterro;
                        }
                        // Insertion dans [ Matiere => ['details', 'moyenne'] ]
                        $avgDevoir = $this->getDevoirsAVG($tnaValue['notes']['devoir']);
                        $avgs[$tnaKey]['details'] = $tnaValue['details'];
                        $avgs[$tnaKey]['moyenne']['devoir'] = $avgDevoir;
                    }
                    
                    $avgByTrimestreAndMatiere[$key] = $avgs;

                    // Moyenne générale par trimestre
                    $trimestreAVG[$key] = $this->getFinalAVGBytrimestre($avgByTrimestreAndMatiere[$key]);
                }
            }
        }
        else {
            $notesByTrimestre = null;
            abort(403);
        }
        return $trimestreAVG;
    }


    /**
     * Calcule la moyenne générale 
     * à partir d'un lot de matière recu  en paramètre
     *
     * @param [array] $notesByTrimestreCollection
     * @return int 
     */
    private function getFinalAVGBytrimestre($notesByTrimestreCollection)
    {
        // Fais le cumul des moyennes de devoir de chaque matière
        // calcule la moyenne en fonction de ces notes
        $sum = 0;

        foreach ($notesByTrimestreCollection as $key => $value) {
            $sum += $value['moyenne']['devoir'];
        }

        return $sum / count($notesByTrimestreCollection);
    }

    /**
     * Retourne la moyenne des devoirs
     * 
     * @param [Collection] Collection de Note de devoir
     * @return [float] $avg
     */
    private function getDevoirsAVG($devoirNotesCollection)
    {
        $avg = 0;
        $sum = 0;

        if (!is_null($devoirNotesCollection)) {
            foreach ($devoirNotesCollection as $key => $noteModel) {
                if (!is_null($noteModel->not_note)) {
                    $sum += $noteModel->not_note;
                }
                else {
                    $sum += 0;
                }
            }
            $avg = $sum / count($devoirNotesCollection);            
        }

        return $avg;
    }

    /**
     * Retourne la moyenne des interrogation
     * 
     * @param [Collection] Collection de Note d'interrogation
     * @return [float] $avg
     */
    private function getInterrogationAVG($interroNotesCollection)
    {
        $avg = 0;
        $sum = 0;

        if (!is_null($interroNotesCollection)) {
            foreach ($interroNotesCollection as $key => $noteModel) {
                if (!is_null($noteModel->not_note)) {
                    $sum += $noteModel->not_note;
                }
                else {
                    $sum += 0;
                }
            }
            $avg = $sum / count($interroNotesCollection);            
        }

        return $avg;
    }


    public function CalculerMoyenneGenerale()
    {
        
    }


    //////////////////////////////////////
    // TODO: clone de ShowByTrimestre
    // Mais adapté à autre chose
    public function getNotesByTrimestre($idTrimestre, $matricule)
    {
        // le matricule est le numéro de l'élève dans la table inscription
        $bulletinview = '';
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
                return $notesOrdonnes;
            } 
            else {
                return null;
            }

        } else {
            abort(404);
        }
    }

}
