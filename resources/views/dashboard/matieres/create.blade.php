@extends('templates.dashboard-dev')
@section('title') Ajouter une matière @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
        
        <div class="jumbotron">
            <div>
                <h3 class='text-center'>Ajouter une matière</h3>
            </div> <hr>
            
            {!! Form::open(['action' => ['MatiereController@store'], 'method' => 'POST']) !!}
                <div class="form-group">
                    {!! Form::label('titre', 'Titre de la matière') !!} 
                    {!! Form::text('titre', old('titre'), ['class' => 'form-control', 'required' => '']) !!}
                </div>
                
                 <br>
                <div class='form-group text-center'>
                    {{ Form::submit("Enregistrer", array('class' => 'btn btn-primary ')) }}
                </div>                   
            {!! Form::close() !!}
            
        </div>
    </div>

    <div>

    </div>
</div>
@endsection