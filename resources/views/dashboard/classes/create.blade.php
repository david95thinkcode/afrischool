@extends('templates.app')
@section('title') Les classes @endsection
@section('section-title') Ajouter une classe @endsection
@section('content')
<div class='row'>
    <div class="col-md-5 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
        <div class="panel panel-default mx-auto">
            <div class="panel-body">
                <div class="">
                
                    {!! Form::open(['action' => ['ClasseController@store'], 'method' => 'POST']) !!}
                        @include('dashboard.classes.partials.form-create')
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
