@extends('templates.app')
@section('title') Matières @endsection
@section('section-title') Ajouter une matière @endsection
@section('content')
<div class='row'>
    <div class="col-md-5 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
        <div class="panel panel-default mx-auto">
            <div class="panel-body">
                <div class="x-content">
                    {!! Form::open(['action' => ['MatiereController@store'], 'method' => 'POST']) !!}
                        @include('dashboard.matieres.partials.form-fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
