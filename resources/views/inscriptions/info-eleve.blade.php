@extends('templates.app')
@section('title')Information de l'élève@endsection
@section('section-title') Inscrire un élève @endsection
@section('content')
    <div class="col-sm-12">
        <div class="x-content">
            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h4>Informations de l'élève</h4>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['action' => ['InscriptionController@store'], 'method' => 'POST']) !!}
                        <fieldset>
                            @include('inscriptions.partials.eleve-new')
                        </fieldset>
                        <br>
                        <div class='form-group text-center'>
                            {{ Form::submit("Etape suivante", array('class' => 'btn btn-success ')) }}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-css')
    <style>
        .panel-heading{padding: 3px 10px;}
    </style>
@stop
