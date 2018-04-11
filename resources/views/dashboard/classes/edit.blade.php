@extends('templates.app')
@section('title') {{ $c->cla_intitule }} - Modifier @endsection
@section('section-title') Modifier une classe @endsection
@section('content')
<div class='row'>
    <div class="col-sm-6">
        <div class="">
            {!! Form::model($c, ['action' => ['ClasseController@update', $c->id], 'method' => 'PUT']) !!}
                
                @include('dashboard.classes.partials.form-create-edit')
                
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
