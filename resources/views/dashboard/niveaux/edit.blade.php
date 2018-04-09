@extends('templates.dashboard-dev')
@section('title') Nodifier un niveau @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
    <div class="jumbotron">
            <div>
                <h3 class='text-center'>Modifier un niveau</h3>
            </div> <hr>

            {!! Form::model($niveau, ['action' => ['NiveauController@update', $niveau->id], 'method' => 'PUT']) !!}
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
