@extends('templates.app')
@section('title') Matières @endsection
@section('section-title') Ajouter une matière @endsection
@section('content')
    <div class="col-sm-12">
        <div class="x-content">
            {!! Form::open(['action' => ['MatiereController@store'], 'method' => 'POST']) !!}
            <div class="form-group">
                {!! Form::label('intitule', 'Titre de la matière') !!}
                {!! Form::text('intitule', old('intitule'), ['class' => 'form-control', 'required' => '']) !!}
            </div>

            <br>
            <div class='form-group text-center'>
                {{ Form::submit("Enregistrer", array('class' => 'btn btn-primary ')) }}
            </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection
