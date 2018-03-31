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
                    {!! Form::label('intitule', 'Nom de la classe ') !!} 
                    {!! Form::text('intitule', old('intitule'), ['class' => 'form-control', 'required' => '']) !!}
                </div> 
                <div class="form-group">
                    {!! Form::label('professeur_principal', 'Professeur principal') !!}
                    <select class="form-control" name="professeur_principal" id='professeur_principal' value="{{ old('professeur_principal') }}">
                        <option value="">-- Sélectionner --</option>
                    @foreach ($profs as $p)
                        <option value="{!! $p->id !!}">{!! $p->prenoms !!} {!! $p->nom !!}</option>
                    @endforeach
                    </select>
                </div> <br>
                <div class='form-group text-center'>
                    {{ Form::submit("Enregistrer", array('class' => 'btn btn-primary ')) }}
                </div>                   
            {!! Form::close() !!}
            
        </div>
    </div>
</div>
@endsection