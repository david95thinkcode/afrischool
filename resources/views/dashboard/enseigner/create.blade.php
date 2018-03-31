@extends('templates.dashboard-dev')
@section('title') Attribuer une matière @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">        
        <div class="jumbotron">
            <div>
                <h3 class='text-center'>Ajouter une matière à une classe</h3>
            </div> <hr>
            
            {!! Form::open(['action' => ['EnseignerController@store'], 'method' => 'POST']) !!}
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            {!! Form::label('classe', 'Classe') !!} 
                            <select name="classe" id="classe" class="form-control" required>
                                <option value="">-- Sélectionner --</option>
                                @foreach ($classes as $classe)
                                <option value="{{ $classe->id }}">{{ $classe->intitule }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <br>
                            <a href="{!! route('classe.create') !!}" class="btn btn-success">Nouveau</a>
                        </div>
                    </div>                    
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class='col-sm-8'>
                            {!! Form::label('matiere', 'Matiere') !!} 
                            <select name="matiere" id="matiere" class="form-control" required>
                                <option value=""></option>
                                @foreach ($matieres as $matiere)
                                <option value="{{ $matiere->id }}">{{ $matiere->intitule }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <br>
                            <a href="{!! route('matieres.create') !!}" class="btn btn-success pt-sm-2">Nouveau</a>
                         </div>
                    </div>                                       
                </div>    
                        
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            {!! Form::label('professeur', 'Professeur') !!}
                            <select class="form-control" name="professeur" id='professeur' value="{{ old('professeur') }}">
                                
                                <option value=""></option>
                                @foreach ($profs as $p)
                                <option value="{!! $p->id !!}">{!! $p->prenoms !!} {!! $p->nom !!}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col">
                            <br>
                            <a href="{!! route('professeurs.create') !!}" class="btn btn-success pt-sm-2">Nouveau</a>
                        </div>
                    </div>
                    
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4">
                            {!! Form::label('coefficient', 'Coefficent de la matière') !!} 
                            {!! Form::number('coefficient', old('coefficient'), ['class' => 'form-control', 'placeholder' => '01', 'required' => '']) !!}
                        </div>
                    </div>
                </div>    

                <br>

                <div class='form-group text-center'>
                    {{ Form::submit("Enregistrer", array('class' => 'btn btn-primary ')) }}
                </div>                   
            {!! Form::close() !!}
            
        </div>
    </div>
</div>
@endsection