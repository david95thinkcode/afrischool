@extends('templates.dashboard-dev')
@section('title') Editer une matière @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">

        <div class="jumbotron">
            <div>
                <h3 class='text-center'>Editer la matière : {{ $m->intitule }}</h3>
            </div> <hr>

            {!! Form::model($m, ['action' => ['MatiereController@update', 'id' => $m->id], 'method' => 'PUT']) !!}
                <div class="form-group">
                    {!! Form::label('intitule', 'Titre de la matière') !!}
                    {!! Form::text('intitule', old('intitule'), ['class' => 'form-control', 'required' => '']) !!}
                </div>

                 <br>
                <div class='form-group text-center'>
                    {{ Form::submit("Enregistrer", array('class' => 'btn btn-success ')) }}
                </div>
            {!! Form::close() !!}

        </div>
    </div>

    <div>

    </div>
</div>
@endsection
