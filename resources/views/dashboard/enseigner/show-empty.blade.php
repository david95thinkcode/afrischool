@extends('templates.app')
@section('title') Matières par classe @endsection
@section('section-title') Les matières de {{ $classe->cla_intitule }} @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
        <div class="text-center">
            <a href="{{ route('matiere.show.classes') }}" class="btn btn-primary">Retour</a>
        </div> <br>
       
        <div class="jumbotron text-center">
            <p>Aucune matière n'a été enregistrée pour cette classe !</p>

            <a href="{{ route('enseigner.create') }}" class="btn btn-primary">Ajouter une matière à cette classe</a>
        </div>
    </div>
</div>
@endsection