@extends('templates.app')
@section('title') Les classes @endsection
@section('section-title') Ajouter une classe @endsection
@section('content')
<div class='row'>
    <div class="col-sm-6">
        <div class="">
           
            {!! Form::open(['action' => ['ClasseController@store'], 'method' => 'POST']) !!}
                @include('dashboard.classes.partials.form-create-edit')
            {!! Form::close() !!}

        </div>
    </div>
</div>
@endsection
