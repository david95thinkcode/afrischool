@extends('templates.app')
@section('title') Information sur la scolarité @endsection
@section('section-title') Paiement restant de la scolarité @endsection
@section('content')
    <div class="col-sm-12">
        <div class="x-content">
            {!! Form::open(['action' => ['EleveController@solderScolarite'], 'method' => 'POST']) !!}
            <fieldset>
                <legend>Informations sur la scolarité</legend>

                <div class='row'>
                    <div class="col-md-4 col-md-offset-4">
                        <div class="form-group{{ $errors->has('montant_verser') ? ' has-error' : '' }}">
                            {!! Form::label('montant_verser', "Montant payé") !!}
                            {!! Form::text('montant_verser', old('montant_verser'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>

            </fieldset>
            <br>
            <div class='form-group text-center'>
                {{ Form::submit("Enregistrer paiement", array('class' => 'btn btn-success ')) }}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection