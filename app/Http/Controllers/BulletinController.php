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
    //etape1
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

    /**
     * Retourne des notes ordonnées d'un élève
     * pour un trimestre donné
     * 
     */
    public function GetOrdoredNotesByTrimestre($idTrimestre, $matricule)
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

                $toReturn = [
                    "eleve" => $eleve,
                    "notesOrdonnes" => $notesOrdonnes
                ];

                return $toReturn;
            } 
            else {
                return null;
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

    /**
     * Affiche le bulletin pour un trimestre donné
     *
     * @param int $idTrimestre
     * @param int $matricule : numéro de l'élève dans la table inscription
     * @return View
     */
    public function AvgByTrimestreWithRangeAndNumber($idTrimestre, $matricule)
    {
        $rang;
        $avgs = [];
        $effectif = 0;
        $moyEleve = 0;
        $results = $this->GetOrdoredNotesByTrimestre($idTrimestre, $matricule);
        
        if (!is_null($results)) {
            $eleve = [];
            $eleve = $results['eleve'];
            $notesOrdonnes = $results['notesOrdonnes'];
            
            if ($eleve->classe->estPrimaire == 1) {
                $moyEleve = $this->getTrimestreAvgFromOrderedNotes($notesOrdonnes, false);
            } else {
                $moyEleve = $this->getTrimestreAvgFromOrderedNotes($notesOrdonnes, true);
            }
            array_push($avgs, $moyEleve);

            $eleves = Inscription::with('eleve', 'classe')
                ->where('classe_id', $eleve->classe_id)
                ->whereNotIn('id', [$matricule])->get(); 
            
            foreach ($eleves as $key => $InscriptionModel) {
                $ordNotes = $this->GetOrdoredNotesByTrimestre($idTrimestre, $InscriptionModel->$matricule);
                if ($InscriptionModel->classe->estPrimaire == 1) {
                    $avg = $this->getTrimestreAvgFromOrderedNotes($ordNotes, false);
                } else {
                    $avg = $this->getTrimestreAvgFromOrderedNotes($ordNotes, true);
                }
                array_push($avgs, $avg);
            }

            $rang = $this->getRange($moyEleve, $avgs);
            $effectif = $this->getEffectif($eleve->classe_id, $eleve->annee_scolaire_id);

            if ($eleve->classe->estPrimaire == 1) {
                $bulletinview = 'dashboard.bulletins.b-primaire';
            } 
            else {
                $bulletinview = 'dashboard.bulletins.b-college';
            }
            
            return view($bulletinview, compact('eleve', 'notesOrdonnes', 'rang', 'effectif'));

        }
        else {
            return null;
        }

    }


    /**
     * Retourne le rang, l'effectif ainsi que les moyennes générales
     * dans la classe de l'élève dont le matricule est indiqué.
     *
     * @param [type] $matricule
     * @return void
     */
    public function FinalAvgWithRangeAndNumber($matricule)
    {
        $avgs = []; // Moyenne des autres éléèves de la classe

        $eleve = Inscription::find($matricule)->first();
        $eleves = Inscription::with('eleve')
                ->where('classe_id', $eleve->classe_id)
                ->whereNotIn('id', [$matricule])->get();        
        
        foreach ($eleves as $key => $InscriptionModel) {
            $data = $this->ShowFinal($matricule);
            array_push($avgs, $data['moyenneGenerale']);
        }

        $effectif = $this->getEffectif($eleve->classe_id, $eleve->annee_scolaire_id);
        $moyEleve = $this->ShowFinal($matricule);
        array_push($avgs, $moyEleve);
        $rang = $this->getRange($moyEleve, $avgs);
        
        $toReturn = [
            "rang" => $rang,
            "effectif" => $effectif,
            "moyennes" => $moyEleve
        ];

        return $toReturn;
    }

    /**
     * Retourne un tableau concernant les moyennes de l'élève
     * dont le matricule est reçu en paramètre
     * 
     * @param int $matricule
     * @return void
     */
    public function ShowFinal($matricule)
    {
        /**
         * $trimestreAVG : Cette variable contient la moyenne 
         * générale par trimestre
         * 
         * NB: 
         * $trimestreAVG[1] => moyenne générale du trimestre 1
         * 
         * $trimestreAVG[2] => moyenne générale du trimestre 2
         * 
         * $trimestreAVG[3] => moyenne générale du trimestre 3
         * 
         */
        $trimestreAVG = []; 

        /**
         * $avgByTrimestreAndMatiere : Cette variable contient la moyenne 
         * de devoir et d'interro par trimestre
         * 
         * NB: 
         * $avgByTrimestreAndMatiere[1] => moyennes d'interro et devoir du trimestre 1
         * 
         * $avgByTrimestreAndMatiere[1]['Informatique] =>  moyenne d'interro et 
         * devoir du trimestre 1 en Informatique
         * 
         * $avgByTrimestreAndMatiere[1]['Informatique]['moyennes']['interrogation'] => 
         * moyenne d'interro du trimestre 1
         * 
         * $avgByTrimestreAndMatiere[1]['Informatique]['moyennes']['devoir'] => 
         * moyenne de devoir du trimestre 1
         */
        $avgByTrimestreAndMatiere = [];
        
        /**
         * Tableau contenant la moyenne générale de chaque 
         * matière à l'issue des 3 trimestres 
         */
        $finalAvgByMatiere = [];
        $notesByTrimestre = [];
        $toReturn;
        
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

                    // Calcul moyenne de devoir et d'interro
                    foreach ($trimestreNoteArray as $tnaKey => $tnaValue) {
                        // Eleve en college
                        if ($eleve->classe->estCollege == 1) 
                        {
                            $avgInterro = $this->getInterrogationAVG($tnaValue['notes']['interrogation']);
                            $avgs[$tnaKey]['moyenne']['interrogation'] = $avgInterro;
                            $avgs[$tnaKey]['somme']['devoir'] = $this->getDevoirsSum($tnaValue['notes']['devoir']);
                        }
                        // Insertion dans [ Matiere => ['details', 'moyenne'] ]
                        $avgDevoir = $this->getDevoirsAVG($tnaValue['notes']['devoir']);
                        $avgs[$tnaKey]['details'] = $tnaValue['details'];
                        $avgs[$tnaKey]['moyenne']['devoir'] = $avgDevoir;
                    }
                    
                    $avgByTrimestreAndMatiere[$key] = $avgs;

                    // Moyenne générale pour chaque trimestre ($key)
                    if ($eleve->classe->estCollege == 1) {
                        $trimestreAVG[$key] = $this->getTrimestreAvg($avgByTrimestreAndMatiere[$key], true);
                    }
                    else {
                        $trimestreAVG[$key] = $this->getTrimestreAvg($avgByTrimestreAndMatiere[$key], false);    
                    }
                }
            }
          
            $finalAvgByMatiere = $this->getFinalAvgByMatiere($avgByTrimestreAndMatiere, $eleve->classe);
            
            // FINALISATION ...
            $toReturn = [
                "moyenneGenerale" => $this->CalculerMoyenneGenerale($trimestreAVG),
                "moyenneParTrimestre" => $trimestreAVG,
                "moyenneGeneraleParMatiere" => $finalAvgByMatiere 
            ];
        }
        else {
            abort(403);
        }

        return $toReturn;
    }


    /**
     * Moyenne finale de chaque matière
     * à la fin de l'année
     *
     * @param [type] $moyenneMatiereParTrimestre
     * @return mixed
     */
    private function getFinalAvgByMatiere($moyenneMatiereParTrimestre, $classe)
    {
        /**
         * Moyenne générale finale de chaque matière.
         * 
         * Ne rien faire si les moyennes générale des matières par trimestre des  
         * trois (3) trimestres ne sont pas fournies
         * Lorsque les données sont fournies,
         * créer un tableau avec pour indice les matieres,
         * pour chaque tableau par exemple [GrandTableau]['Informatique'] = [],
         * créer à l'intérieur l'attribut 'sum'.
         * 'sum' sera actualisé à chaque fois qu'une moyenne est trouvée pour
         * la matière 'Informatique' dans un autre trimestre.
         * 
         * Enfin, faire la division de la 'sum' par 3
         * quand tous les trimestres ont été parcourus pour obtenir 
         * la moyenne générale finale de cette matière. 
         * 
         * NB : 
         * [GrandTableau]['matiere']['sum'] => Contient la sum des moyennes
         * [GrandTableau]['matiere']['avg'] => Contient la moyenne générale de la matière
         * [GrandTableau]['matiere']['details'] => Contient des détails sur la matière
         * 
         */
        
        $finalAvgs = [];

        if (count($moyenneMatiereParTrimestre) > 0) 
        {
            $avgSum = [];
            
            foreach ($moyenneMatiereParTrimestre as $trimestre => $matieres) {
                                
                foreach ($matieres as $matKey => $matValue) {
                    
                    if (!isset($avgSum[$matKey])) { // Moyenne du trimestre 1 existe déjà dans $avgSum ?
                        
                        $avgSum[$matKey]['details'] = $matValue['details'];

                        if ($classe->estCollege == 1) {
                            $avgSum[$matKey]['sum'] = ( $matValue['moyenne']['interrogation'] + $matValue['somme']['devoir']) / 3;
                        } else {
                            $avgSum[$matKey]['sum'] = $matValue['moyenne']['devoir'];
                        }
                    } 
                    else {

                        if ($classe->estCollege == 1) {
                            $avgSum[$matKey]['sum'] = ( $matValue['moyenne']['interrogation'] + $matValue['somme']['devoir']) / 3;
                        } else {
                            $avgSum[$matKey]['sum'] = $matValue['moyenne']['devoir'];
                        }
                    }                    
                }
            }
            
            // Trouvons les moyennes
            foreach ($avgSum as $keyMat => $v) {
                $finalAvgs[$keyMat] = $v;
                $finalAvgs[$keyMat]['avg'] = $finalAvgs[$keyMat]['sum'] / 3;
            }
        } 
        else {
            $finalAvgs = null;
        }
        
        return $finalAvgs;
    }


    /**
     * Retourne la moyenne général d'un trimestre
     *
     * @param array $notesByTrimestreCollection
     * @param boolean $isCollege
     * @return float
     */
    private function getTrimestreAvg($matiereArray, $isCollege)
    {
        /**
         * EN BREF,
         * 
         * DESCRIPTION
         * Cette méthode fait la somme de toutes les moyennes 
         * de chaque matière puis la divise par le nombre 
         * de matière.
         * 
         * PARAMETRES
         * $matiereArray est un tableau
         * Chacun des éléments du tableau contient des données d'une matière
         * pour un trimestre. Ce trimestre n'a pas besoin d'être renseigné
         * dans cette méthode.
         * 
         * Chaque élément du tableau contient :
         * $element['moyenne']['interrogation']
         * $element['moyenne']['devoir']
         * $element['somme']['devoir'] (uniquement s'il s'agit d'une matière
         * du college)
         * 
         * LE PRIMAIRE
         * La moyenne de chaque matière se trouve dans 
         * $element['moyenne']['devoir']
         * 
         * LE COLLEGE
         * Contrairement au cas du primaire, ici la moyenne 
         * de chaque matière se calcule en diviant par 3 la somme 
         * entre la moyenne d'interrogation et celle des notes de devoir
         * 
         */
        
        $avgsum = 0;
        
        if ($isCollege) {
            foreach ($matiereArray as $key => $value) {
                $avgsum += ($value['moyenne']['interrogation'] + $value['somme']['devoir']) / 3;
            }
        }
        else {
            foreach ($matiereArray as $key => $value) {
                $avgsum += $value['moyenne']['devoir'];
            }
        }

        return $avgsum / count($matiereArray);
    }

    
    private function getTrimestreAvgFromOrderedNotes($orderedNote, $isCollege)
    {
        $moy = 0;

        foreach ($orderedNote as $key => $value) {
            $n = $this->getDevoirsAVG($value['notes']['devoir']);
            
            if ($isCollege) {
                $i = $this->getInterrogationAVG($value['notes']['interrogation']);
                $u = $this->getDevoirsSum($value['notes']['devoir']);
                $m = ($i + $u) / 3;
            }
            else {
                $m = $n;
            }
            $moy += $m;
        }

        $moy = $moy / count($orderedNote);

        return $moy;
    }


    /**
     * Retourne la somme des notes de devoirs
     * 
     * @param Collection Collection de Note de devoir
     * @return float $avg
     */
    private function getDevoirsSum($devoirNotesCollection)
    {
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
        }

        return $sum;
    }

    /**
     * Retourne la moyenne des devoirs
     * 
     * Utile uniquement pour les notes du primaire
     * 
     * @param Collection Collection de Note de devoir
     * @return float $avg
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
     * Retourne la moyenne des interrogations
     * 
     * Utile pour les notes du primaires ainsi que pr le college
     * @param Collection Collection de Note d'interrogation
     * @return float $avg
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


    /**
     * Retourne le rang correspondant à une
     * moyenne reçue en paramètre dans un lot de
     * moyennes
     *
     * @param float $avg 
     * @param array $avgArray
     * @return int
     */
    private function getRange($avg, $avgArray)
    {        
        $range = 1;

        if (count($avgArray) > 0) {
            rsort($avgArray);
            $range = array_search($avg, $avgArray);
            $range ++; // important
        }
        
        return $range;
    }

    /**
     * Retourne l'effectif des élèves dans une classe
     * pour une année scolaire donnée
     *
     * @param int $classeID
     * @param int $intanneeScolaireID
     * @return int
     */
    private function getEffectif($classeID, $anneeScolaireID)
    {
        $number = Inscription::where([
            ['annee_scolaire_id', $anneeScolaireID],
            ['classe_id', $classeID]
        ])->count();

        return $number;
    }


    // clone de GetOrdoredNotesByTrimestre
    // Mais adapté à autre chose
    /**
     * Retourne les moyennes d'un élève pour un trimestre
     *
     * @param [type] $idTrimestre
     * @param [type] $matricule
     * @return void
     */
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

            if (count($notesBrutes) > 0) 
            {
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

    /**
     * Retourne une division par 3 
     * de la somme des éléments du tableau recu en paramètre
     *
     * @param array $avgArray
     * @return void
     */
    private function CalculerMoyenneGenerale($avgArray)
    {
        $m = 0;
        $sum = 0;

        if (count($avgArray) > 0) {
            foreach ($avgArray as $key => $avg) {
                $sum += $avg;
            }
            $m = $sum / 3;
        }

        return $m;
    }

}
