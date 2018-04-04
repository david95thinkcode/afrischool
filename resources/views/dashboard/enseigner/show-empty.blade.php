@extends('templates.dashboard-dev')
@section('title') Matières par classe @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
        <h3 class='text-center'>Les matières de {{ $classe->intitule }}</h3>
        <br>
        
        <div class="text-center">
            <a href="{{ route('matiere.show.classes') }}" class="btn btn-primary">Retour</a>
        </div> <br>
       
        <div class="jumbotron text-center">
            Aucune matière n'a été enregistrée pour cette classe !
        </div>
    </div>
</div>
@endsection