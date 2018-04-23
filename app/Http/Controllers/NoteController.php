<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreNoteFirstStepRequest;
use App\Http\Requests\StoreNoteLastStepRequest;
use App\Models\TypeEvaluation;
use App\Models\Trimestre;
use App\Models\Enseigner;
use App\Models\Classe;
use App\Models\Note;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Classe::all();
        $trimestres = Trimestre::all();

        return view('dashboard.notes.create-first-step', compact('classes', 'trimestres'));
    }

    /**
     * Retourne la dernière vue pour enregistrer les notes
     */
    public function goToSecondStep(StoreNoteFirstStepRequest $req)
    {
        $classe = Classe::find($req->classe);
        $trimestre = Trimestre::find($req->trimestre);
        $typeEv = TypeEvaluation::all();
        $matieres = Enseigner::where('classe_id', '=', $cla)->get();

        return view('dashboard.notes.create-last-step', compact('classe', 'trimestre', 'typeEv', 'matieres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNoteLastStepRequest $request)
    {
        dd($request->all());

        $note = new Note();
        $note->evaluation_id = $request->type_evaluation;
        $note->trimestre_id = $request->trimestre;
        $note->matiere_id = $request->matiere;
        $note->classe_id = $request->classe;
        $note->not_note = $request->note;
        $note->appreciation = 'Je ne sais pas quoi dire pour l\'instant'; // TODO: A gérer avec du js ou un gestionnaire d'event de laravel
        $note->save();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        //
    }
}
