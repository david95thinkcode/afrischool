@extends('templates.app')
@section('title') Les niveaux @endsection
@section('section-title') Ajouter un niveau @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
        <div class="">
           
            {!! Form::open(['action' => ['NiveauController@store'], 'method' => 'POST']) !!}
                @include('dashboard.niveaux.partials.form-create-edit')
                 <br>
                <div class='form-group text-center'>
                    {{ Form::submit("Enregistrer", array('class' => 'btn btn-primary ')) }}
                </div>
            {!! Form::close() !!}

        </div>
    </div>
</div>
@endsection
