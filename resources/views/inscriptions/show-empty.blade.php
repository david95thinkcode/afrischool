@extends('templates.app')
@section('title') Inscriptions par classe @endsection
@section('section-title')
    Les élèves inscrits en {{ $classe->cla_intitule }}
@endsection
@section('content')
<div class='row'>
    <div class="col-sm-offset-4 col-sm-4">
        <div class="jumbotron mx-auto">
            Aucun élève inscrit pour cette classe!
        </div>
    </div>
</div>
@endsection