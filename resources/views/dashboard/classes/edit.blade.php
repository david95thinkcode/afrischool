@extends('templates.dashboard-dev')
@section('title') {{ $c->cla_intitule }} - Modifier @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
    <div class="jumbotron">
            <div>
                <h3 class='text-center'>Modifier une classe</h3>
            </div> <hr>

            {!! Form::model($c, ['action' => ['ClasseController@update', $c->id], 'method' => 'PUT']) !!}
                
                @include('dashboard.classes.partials.form-create-edit')
                <br>                
                <div class='form-group text-center'>
                    {{ Form::submit("Enregistrer", array('class' => 'btn btn-success ')) }}
                </div>

            {!! Form::close() !!}

        </div>
    </div>
</div>
@endsection
