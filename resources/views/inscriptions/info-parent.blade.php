@extends('templates.app')
@section('title') Information des parents @endsection
@section('section-title') Inscrire un élève @endsection
@section('content')
    <div class="col-sm-12">
        <div class="x-content">
            {!! Form::open(['action' => ['InscriptionController@sessionParent'], 'method' => 'POST']) !!}

                <fieldset>
                    <legend>Informations sur un parent</legend>
                    @include('inscriptions.partials.parent')
                </fieldset>

                <fieldset>
                    <legend>Personne à contacter en cas d'urgence</legend>
                    @include('inscriptions.partials.personne-a-contacter')
                </fieldset>

                <br>
                <div class='form-group text-center'>
                    {{ Form::submit("Suivant", array('class' => 'btn btn-success ')) }}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection