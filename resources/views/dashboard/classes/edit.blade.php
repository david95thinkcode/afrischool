@extends('templates.app')
@section('title') {{ $classe->cla_intitule }} - Modifier @endsection
@section('section-title') Modifier une classe @endsection
@section('content')
<div class='row'>
    <div class="col-md-5 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
        <div class="panel panel-default mx-auto">
            <div class="panel-body">
                <div class="">
                    {!! Form::model($classe, ['action' => ['ClasseController@update', $classe->id], 'method' => 'PUT']) !!}
                        
                        @include('dashboard.classes.partials.form-create-edit')
                        
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
