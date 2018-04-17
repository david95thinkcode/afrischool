@extends('templates.app')
@section('title')
    Professeurs
@endsection
@section('section-title')
    Ajouter un professeur
@endsection
@section('content')
    <div class="col-sm-12">
        <div class="x-content">
            {!! Form::open(['action' => ['ProfesseurController@store'], 'method' => 'POST']) !!}

            @include('dashboard.professeurs.partials.form-create-edit')

            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('custom-js')
    {!! Html::script('js/professeurs/fields.js') !!}
@endsection
