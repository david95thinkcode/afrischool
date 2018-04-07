@extends('templates.dashboard-dev')
@section('title') Professeurs @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">

        <div class="jumbotron">
            <div>
                <h3 class='text-center'>Inscrire un professeur</h3>
            </div> <hr>

            {!! Form::open(['action' => ['ProfesseurController@store'], 'method' => 'POST']) !!}
                @include('dashboard.professeurs.partials.form-create-edit')
                <div class='form-group text-center'>
                    {{ Form::submit("Enregistrer", array('class' => 'btn btn-primary ')) }}
                </div>
            {!! Form::close() !!}

        </div>
    </div>

    <div>

    </div>
</div>
@endsection

@section('custom-js')
    {!! Html::script('js/professeurs/fields.js') !!}
@endsection
