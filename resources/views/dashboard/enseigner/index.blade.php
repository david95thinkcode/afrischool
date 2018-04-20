@extends('templates.app')
@section('title') Matières enseignées @endsection
@section('section-title') Liste des matières par classe @endsection
@section('content')
<div class='row'>
    <div class="col-md-5 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
        <div class='panel panel-default mx-auto'>
            <div class="panel-body">
                <div class="">
                    {!! Form::open(['action' => ['MatiereController@searchForClasse'], 'method' => 'POST', 'class' => '']) !!}
                        <div class="form-group">
                            {!! Form::label('classe', 'Sélectionnez une classe') !!}
                            <select name="classe" id="classe" class="form-control" required>                            
                                    <option value="">Veuillez sélectionner une classe ici</option>
                                    @foreach ($classes as $c)
                                    <option value="{{ $c->id }}">{{ $c->cla_intitule }}</option>
                                    @endforeach
                            </select>          
                        </div>
                        
                        <div class="mt-1">
                            <button type="submit" class="btn btn-success">Rechercher</button>
                        </div>    
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection