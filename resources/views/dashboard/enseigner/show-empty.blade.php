@extends('templates.dashboard-dev')
@section('title') Matières par classe @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
        <h3 class='text-center'>Les matières de {{ $classe->cla_intitule }}</h3>
        <hr>
        
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