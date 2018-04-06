@extends('templates.dashboard-dev')
@section('title') Inscriptions par classe @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
        <h3 class='text-center'>Les élèves inscrits en {{ $classe->intitule }}</h3>
        <br>
        
        <div class="text-center">
            <a href="{{ route('inscriptions.index') }}" class="btn btn-primary">Retour</a>
        </div> <br>
       
        <div class="jumbotron text-center">
            Aucune inscription n'a été enregistrée pour cette classe !
        </div>
    </div>
</div>
@endsection