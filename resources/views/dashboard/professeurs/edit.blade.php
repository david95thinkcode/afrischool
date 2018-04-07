@extends('templates.dashboard-dev')
@section('title') Professeurs @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">

        <div class="jumbotron">
            
            <div>
                <h3 class='text-center'>Modifier {{ $prof->prof_nom }} {{ $prof->prof_prenoms }} </h3>
            </div> <hr>

            {!! Form::model($prof, ['action' => ['ProfesseurController@update', $prof->id], 'method' => 'PUT']) !!}
                @include('dashboard.professeurs.partials.form-create-edit')
                <div class='form-group text-center'>
                    {{ Form::submit("Enregistrer les modifications", array('class' => 'btn btn-success ')) }}
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
