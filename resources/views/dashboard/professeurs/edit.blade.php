@extends('templates.app')
@section('title') Professeurs @endsection
@section('section-title') Modifier : {{ $prof->prof_nom }} {{ $prof->prof_prenoms }} @endsection
@section('content')
    <div class="col-sm-12">
        <div class="x-content">

            {!! Form::model($prof, ['action' => ['ProfesseurController@update', $prof->id], 'method' => 'PUT']) !!}
                @include('dashboard.professeurs.partials.form-create-edit')
            {!! Form::close() !!}

        </div>
    </div>
@endsection


@section('custom-js')
    {!! Html::script('js/professeurs/fields.js') !!}
@endsection
