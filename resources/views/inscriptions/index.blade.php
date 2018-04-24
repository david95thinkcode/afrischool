@extends('templates.app')
@section('title') Inscriptions @endsection
@section('section-title') Liste des élèves inscrits @endsection
@section('content')
<div class='row'>
    <div class="col-md-5 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
        <div class="panel panel-default mx-auto">
            <div class="panel-body">
                <div class=''>
                    {!! Form::open(['action' => ['InscriptionController@searchForClasse'], 'method' => 'POST', 'class' => '']) !!}
                        <div class="form-group">
                            {!! Form::label('classe', 'Classe') !!}
                            <select name="classe" id="classe" class="form-control" required>

                                <option value="">Veuillez sélectionner une classe</option>
                                @foreach ($classes as $c)
                                <option value="{{ $c->id }}">{{ $c->cla_intitule }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success mt-1">Rechercher</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
