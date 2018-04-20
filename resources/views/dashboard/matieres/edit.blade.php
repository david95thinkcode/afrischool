@extends('templates.app')
@section('title') Matières @endsection
@section('section-title') Modifier la matière : {{ $m->intitule }} @endsection
@section('content')
<div class='row'>
    <div class="col-md-5 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
        <div class="panel panel-default mx-auto">
            <div class="panel-body">
                <div class="">
                    {!! Form::model($m, ['action' => ['MatiereController@update', 'id' => $m->id], 'method' => 'PUT']) !!}
                        @include('dashboard.matieres.partials.form-fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div>

    </div>
</div>
@endsection
