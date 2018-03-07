@extends('templates.public-default')
@section('title') Inscriptions @endsection

@section('content')
<div class='container'>
    <div class="row">
        <div class="col-sm-12">
            <div class='text-center'>
                <h2>Les insriptions enregistrées</h2>
                <hr>
                <a href="{!! route('inscriptions.create') !!}" class="btn btn-default">Enregistrer une inscription</a>
            </div>
            <h2 class='jumbotron'>
                
            </h2>
        </div>
    </div>
</div>
@endsection