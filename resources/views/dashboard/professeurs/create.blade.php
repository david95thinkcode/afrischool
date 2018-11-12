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

            @include('dashboard.professeurs.partials.form-create')

            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('custom-css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css"
          rel="stylesheet"/>
    <style>
        .panel-heading{
            padding: 2px 15px;
        }
    </style>
@endsection
@section('custom-js')
    {!! Html::script('js/professeurs/fields.js') !!}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#prof_nationalite').select2();
            $('#prof_type').select2();
            $('#prof_matrimonial').select2();
            $('#prof_enfant').select2();
        });
    </script>
@endsection