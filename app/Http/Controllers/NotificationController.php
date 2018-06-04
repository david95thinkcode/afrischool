<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\ParentEleve;
use App\Models\Eleve;
use App\Models\Inscription;
use App\Models\Classe;
use App\Models\Note;
use App\Traits\TraitSms;

class NotificationController extends Controller
{
    use TraitSms;
    public function indexForm()
    {
        $classes = Classe::all();
        return view('notifications.parents', compact('classes'));
    }

    public function sendNotification(Request $req)
    {
        $this->validate($req, [
            'message' =>'required|string|min:5',
            'classe' =>'required'
        ]);

        $inscrits = Inscription::where('classe_id', $req->classe)
            ->distinct('eleve_id')->pluck('eleve_id');
        $nbre = count($inscrits);
        for($i=0; $i<$nbre; $i++)
        {
            $eleve = Eleve::find($inscrits[$i]);
            $message = $req->message;
            $numero =  '229'.$eleve->parents->par_tel;
            $ecole = env('SCHOOL_NAME', 'AfrikaSchool');
            $this->senderParent($ecole, $numero, $message);
        }

        return Redirect::route('notifier.user')->with('status', 'Message envoyé avec succès !');
    }

    public function indexNotes()
    {
        $classes = Classe::all();
        return view('notifications.notes', compact('classes'));
    }

    public function sendNotes(Request $req)
    {
        $this->validate($req, [
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'classe' =>'required'
        ]);
        $classes = DB::table('notes')
            ->join('eleves', 'notes.eleve_id', 'eleves.id')
            ->join('classes', 'notes.classe_id', 'classes.id')
            ->where('notes.created_at', '>=', $req->date_debut)
            ->where('notes.created_at', '<=', $req->date_fin)
            ->where('classe_id', $req->classe)
            ->select([DB::RAW('DISTINCT(notes.eleve_id)')])
            ->get();
//        $classes = Classe::with('eleves')->find($req->classe);
        foreach ($classes as $eleve)
        {
            $eleva = $eleve;
            $notes = Note::where('created_at', '>=', $req->date_debut)
                ->where('created_at', '<=', $req->date_fin)
                ->where('classe_id', $req->classe)
                ->where(function ($query) use ($eleva) {
                    $query->where('eleve_id', $eleva->eleve_id);
                })
                ->get();
            $message = array();
            foreach ($notes as $note)
            {
                $message[] = ['Matière' => $note->matiere->intitule, 'Notes' => $note->not_note];
            }
            $eleve1 = Eleve::find($eleve->eleve_id);
            $numero =  '229'.$eleve1->parents->par_tel;
            $ecole = env('SCHOOL_NAME', 'AfrikaSchool');
            $data='';
            foreach ($message as $msg){
                $data .= $msg['Matière'].' => '.$msg['Notes'];
                $data .=' ';
            }
            $this->senderParent($ecole, $numero, $data);
        }
        return Redirect::route('notifier.notes')->with('status', 'Message envoyer avec succès');
    }
}
