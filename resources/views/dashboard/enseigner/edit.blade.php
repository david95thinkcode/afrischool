@extends('templates.app')
@section('title') Matières enseignées @endsection
@section('content')
    <div class="col-sm-12">
        <div class="x-content">
            {!! Form::model($ens, ['action' => ['EnseignerController@update', $ens->id], 'method' => 'PUT']) !!}

            @include('dashboard.enseigner.partials.form-fields')

            {!! Form::close() !!}

        </div>
    </div>
@endsection
