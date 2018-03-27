@extends('templates.dashboard-dev')
@section('title') Créer une classe @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
    <div class="jumbotron">
            <div>
                <h3 class='text-center'>Enregistrer une classe</h3>
            </div> <hr>
            
            {!! Form::open(['action' => ['ClasseController@store'], 'method' => 'POST']) !!}
                <div class="form-group">
                    {!! Form::label('intitule', 'Nom du cours : ') !!} 
                    {!! Form::text('intitule', old('intitule'), ['class' => 'form-control', 'required' => '']) !!}
                </div> <br>
                <div class='form-group text-center'>
                    {{ Form::submit("Enregistrer", array('class' => 'btn btn-primary ')) }}
                </div>                   
            {!! Form::close() !!}
            
        </div>
    </div>
</div>
@endsection