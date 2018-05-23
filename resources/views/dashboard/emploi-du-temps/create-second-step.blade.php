@extends('templates.app')
@section('title') Emploi du temps @endsection
@section('section-title') Ajouter un horaire
@section('content')
    <div class="col-sm-12">
        <div class="x-content">
            <div>
                <p>Classe : {{ $classe->cla_intitule }}</p>
            </div>

            {!! Form::open(['action' => ['HoraireController@store'], 'method' => 'POST']) !!}

            @include('dashboard.emploi-du-temps.partials.form-fields')

            {!! Form::close() !!}

        </div>
    </div>
@endsection
