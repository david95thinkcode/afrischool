@extends('templates.app')
@section('title') Informations de l'élève @endsection
@section('section-title') Inscrire un élève @endsection
@section('content')
    <div class="col-sm-12">
        <div class="x-content">
            {!! Form::open(['action' => ['InscriptionController@store'], 'method' => 'POST']) !!}
                <fieldset>
                    <legend>Informations sur l'élève</legend>
                    @include('inscriptions.partials.eleve-new')
                </fieldset>
            <br>
            <div class='form-group text-center'>
                {{ Form::submit("Suivant", array('class' => 'btn btn-success ')) }}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
