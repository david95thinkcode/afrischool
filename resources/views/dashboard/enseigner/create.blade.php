@extends('templates.app')
@section('title') Matières enseignées @endsection
@section('section-title') Ajouter une matière à une classe @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
        <div class="">
            {!! Form::open(['action' => ['EnseignerController@store'], 'method' => 'POST']) !!}
                
                @include('dashboard.enseigner.partials.form-fields')

            {!! Form::close() !!}

        </div>
    </div>
</div>
@endsection
