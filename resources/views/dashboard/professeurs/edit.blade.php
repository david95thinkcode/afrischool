@extends('templates.dashboard-dev')
@section('title') Professeurs @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
        
        <div class="jumbotron">
            <div>
                <h3 class='text-center'>Modifier {{ $prof->nom }} {{ $prof->prenoms }} </h3>
            </div> <hr>
            
            {!! Form::model($prof, ['action' => ['ProfesseurController@update', $prof->id], 'method' => 'PUT']) !!}
                <div class="form-group">
                     <div class='row'>
                        <div class="col">
                            <div class="form-group">
                                {!! Form::label('nom', "Nom du professeur") !!}
                                {!! Form::text('nom', old('nom'), ['class' => 'form-control', 'required' => '']) !!}
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                {!! Form::label('prenoms', "Prénom(s) du professeur") !!}
                                {!! Form::text('prenoms', old('prenoms'), ['class' => 'form-control', 'required' => '']) !!}
                            </div>
                        </div>
                     </div>
                </div>
                <div class="form-group">
                    {!! Form::label('tel', 'Téléphone') !!} 
                    {!! Form::tel('tel', old('tel'), ['class' => 'form-control', 'required' => '']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'Email') !!} 
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'required' => '']) !!}
                </div> <br>
                <div class='form-group text-center'>
                    {{ Form::submit("Enregistrer les modifications", array('class' => 'btn btn-success ')) }}
                </div>                   
            {!! Form::close() !!}
            
        </div>
    </div>

    <div>

    </div>
</div>
@endsection