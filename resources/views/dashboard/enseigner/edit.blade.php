@extends('templates.dashboard-dev')
@section('title') Attribuer une matière @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
        <div class="jumbotron">
            <div>
                <h3 class='text-center'>Modifier une matière d'une classe</h3>
            </div> <hr>

            {!! Form::model($ens, ['action' => ['EnseignerController@update', $ens->id], 'method' => 'PUT']) !!}
                
                @include('dashboard.enseigner.partials.form-fields')

            {!! Form::close() !!}

        </div>
    </div>
</div>
@endsection
