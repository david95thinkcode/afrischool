@extends('templates.app')
@section('title') Diplômes @endsection
@section('section-title') Modifier un diplôme @endsection
@section('content')
<div class='row'>
    <div class="col-md-5 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
        <div class='panel panel-default mx-auto'>
            <div class="panel-body">        <div class="">
            {!! Form::model($diplome, ['action' => ['DiplomeController@update', $diplome->id], 'method' => 'PUT']) !!}
                
                @include('dashboard.diplomes.partials.form-fields')
                  
            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
