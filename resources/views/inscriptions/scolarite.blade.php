@extends('templates.app')
@section('title') Information sur la scolarité @endsection
@section('section-title') Inscrire un élève @endsection
@section('content')
    <div class="col-sm-12">
        <div class="x-content">
            {!! Form::open(['action' => ['InscriptionController@sessionScolarite'], 'method' => 'POST']) !!}
                <fieldset>
                    <legend>Informations sur la scolarité</legend>
                    @include('inscriptions.partials.first-scolarite')
                </fieldset>
                <br>
                <div class='form-group text-center'>
                    {{ Form::submit("Enregistrer", array('class' => 'btn btn-success ')) }}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection