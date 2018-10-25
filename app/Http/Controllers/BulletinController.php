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
use Illuminate\Support\Facades\DB;
use App\CustomClasses\NoteByMatiere;
use App\CustomClasses\NoteByTrimestre;
use App\CustomClasses\AvgByTrimestre;
use App\CustomClasses\AboutEleve;
use Illuminate\Support\Collection;
use App\CustomClasses\SuperBulletin;

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

    /**
     * Retourne l'objet bulletin correspondant 
     * à l'élève dont le matricule est fourni
     * 
     * @param integer $matricule représente => InscriptionId
     * @return \App\CustomClasses\SuperBulletin
     * 
     */
    public function getBulletinOf($matricule)
    {
        $concernedInscription = Inscription::with('eleve', 'classe')->find($matricule);
        $concernedClasse = $concernedInscription->classe_id;
        $trimestres = Trimestre::all();
        
        // Tous les élèves inscrits dans la même classe 
        $elevesInClassroom = Inscription::with('eleve')
            ->where('classe_id', $concernedClasse)
        ->get();        

        // Toures les matières enseignées dans la classe de l'élève concerné
        $enseigner = DB::table('enseigner')
            ->where('classe_id', $concernedClasse)
            ->join('matieres', 'enseigner.matiere_id', 'matieres.id')
            ->select('*')
        ->get();
        
        // Toutes les notes des élèves dans cette même classe
        $everybodysNotesInClassroom = DB::table('notes')
            ->where('classe_id', $concernedClasse)
            ->join('classes', 'notes.classe_id', 'classes.id')
            ->join('matieres', 'notes.matiere_id', 'matieres.id')
            ->join('eleves', 'notes.eleve_id', 'eleves.id')
            ->join('types_evaluation', 'notes.types_evaluation_id', 'types_evaluation.id')
            ->select('*', 'classes.id as classe_key', 'matieres.id as matiere_key', 'eleves.id as eleve_key')
        ->get();
        
        $friends = $elevesInClassroom->whereNotIn('id', $matricule); // Les autres élèves de la classe
        $friendsAvg = []; // Moyennes des autres élèves de la classe
        
        $moyennesEleveActuel = $this->getBulletin($concernedInscription, $trimestres, $enseigner, $everybodysNotesInClassroom, $elevesInClassroom);
        $bulletin = new SuperBulletin($moyennesEleveActuel);
        
        // Elaboration du belletin
        foreach ($friends as $fk => $friendValue) {
            $averages = $this->getBulletin($friendValue, $trimestres, $enseigner, $everybodysNotesInClassroom, $elevesInClassroom);
            array_push($friendsAvg, $averages);
            $bulletin->addFriendAvg($averages); // important
        }
        
        $bulletin->setEleve($concernedInscription);
        $bulletin->finish(); // Obligatoire

        return $bulletin;
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
     * 
     * @param Inscription $concernedInscription : Eleve concerné
     * @param Collection $trimestres : Tous les trimestre de la DB
     * @param Collection $enseigner : Collection des matières enseignées dans la classe de l'élève
     * @param Collection $everybodysNotesInClassroom : Collection des notes de tous les élèves de la classe
     * @param Collection $elevesInClassroom : Collections des instances du model "Inscription" des élèves de la classe
     * @return \App\CustomClasses\NoteByTrimestre
     * 
     */
    private function getBulletin(
        Inscription $concernedInscription, 
        Collection $trimestres,
        Collection $enseigner, 
        Collection $everybodysNotesInClassroom,
        Collection $elevesInClassroom)
    {
        $avgbt;
        $nbt = new NoteByTrimestre();
        
        // Notes de l'élève concerné
        $currentEleveNotes = $everybodysNotesInClassroom
        ->where('eleve_key', $concernedInscription->eleve_id);
        
        $isCollege = $concernedInscription->classe->estCollege;
                
        foreach ($trimestres as $tKey => $trimestre) {
            
            foreach ($enseigner as $eKey => $eValue) {
                $currentMatiere = $eValue->matiere_id;
                
                $nbm = new NoteByMatiere($currentMatiere, $eValue->intitule, $isCollege);
                $nbm->setCoef($enseigner->where('matiere_id', $currentMatiere)->first()->coefficient);
                
                $currentMatNotes = $currentEleveNotes
                    ->where('matiere_id', $currentMatiere)
                    ->where('trimestre_id', $trimestre->id);
                
                foreach ($currentMatNotes as $cmnKey => $cmnValue) {
                    $nbm->addNote($cmnValue);
                }
                
                $nbm->calculateAvgs(); //obligatoire
                $nbm->setEleve(new AboutEleve($concernedInscription->id, $concernedInscription->eleve_id));
                $nbm->getEleve()->setNom($concernedInscription->eleve->nom);
                $nbm->getEleve()->setPrenom($concernedInscription->eleve->prenoms);
                $nbm->getEleve()->setSex($concernedInscription->eleve->sexe);
                
                switch ($trimestre->id) {
                    case 1:
                        # trimestre 1...
                        $nbt->pushToFirst($nbm);
                        break;
                    case 2:
                        $nbt->pushToSecond($nbm);
                        break;
                    case 3:
                        $nbt->pushToThird($nbm);
                        break;
                    default:
                        # Nothing to do here
                        break;
                }
            }            
        }

        $avgbt = new AvgByTrimestre($nbt);
        
        return $avgbt;
    }

    /**
     * Affiche le bulletin pour un trimestre donné
     *
     * @param int $idTrimestre
     * @param int $matricule : numéro de l'élève dans la table inscription
     * @return View
     */
    public function AverageByTrimestre($idTrimestre, $matricule)
    {
        $completeBulletin = $this->getBulletinOf($matricule);
        
        dd($completeBulletin);
    }


    /**
     * Retourne le rang, l'effectif ainsi que les moyennes générales
     * dans la classe de l'élève dont le matricule est indiqué.
     *
     * @param [type] $matricule
     * @return void
     */
    public function FinalAverage($matricule)
    {
        $completeBulletin = $this->getBulletinOf($matricule);
        
        dd($completeBulletin);
    }

}
