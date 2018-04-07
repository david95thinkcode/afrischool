@extends('templates.dashboard-dev')
@section('title') Inscrire un élève @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">

        <div class="jumbotron">
            <div>
                <h3 class='text-center'>Inscrire un élève</h3>
            </div> <hr>
            <div>
                {!! Form::open(['action' => ['InscriptionController@store'], 'method' => 'POST']) !!}
                    <fieldset>
                        <legend>Informations sur l'élève</legend>
                        @include('inscriptions.partials.eleve-ancien')
                    </fieldset>

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
                            {{ Form::submit("Enregistrer", array('class' => 'btn btn-primary ')) }}
                        </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div>

    </div>
</div>
@endsection
