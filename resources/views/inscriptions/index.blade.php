@extends('templates.dashboard-dev')
@section('title') Inscriptions @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">

        <div>
            <h3 class='text-center'>Les élèves inscrits</h3>
            <hr>
            <div class='text-center'>
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
                    <div class="">
                        <button type="submit" class="btn btn-success mb-2 ml-sm-3">Rechercher</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div>

    </div>
</div>
@endsection
