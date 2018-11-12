@extends('templates.app')
@section('title') Information sur la scolarité @endsection
@section('section-title') Inscrire un élève @endsection
@section('content')
    <div class="col-sm-12">
        <div class="x-content">
            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h4>Paiement de la scolarité</h4>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['action' => ['InscriptionController@sessionScolarite'], 'method' => 'POST']) !!}
                            <fieldset>
                                @include('inscriptions.partials.first-scolarite')
                            </fieldset>
                            <div class='form-group text-center'>
                                {{ Form::submit("Etape finale", array('class' => 'btn btn-warning ')) }}
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