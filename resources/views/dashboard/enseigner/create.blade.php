@extends('templates.dashboard-dev')
@section('title') Ajouter une matière à une classe @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
        <div class="jumbotron">
            <div>
                <h3 class='text-center'>Ajouter une matière à une classe</h3>
            </div> <hr>

            {!! Form::open(['action' => ['EnseignerController@store'], 'method' => 'POST']) !!}
                
                @include('dashboard.enseigner.partials.form-fields')

            {!! Form::close() !!}

        </div>
    </div>
</div>
@endsection
