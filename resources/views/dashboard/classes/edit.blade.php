@extends('templates.dashboard-dev')
@section('title') {{ $c->cla_intitule }} - Modifier @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
    <div class="jumbotron">
            <div>
                <h3 class='text-center'>Modifier une classe</h3>
            </div> <hr>

            {!! Form::model($c, ['action' => ['ClasseController@update', $c->id], 'method' => 'PUT']) !!}
                <div class="form-group">
                    {!! Form::label('cla_intitule', 'Nom du cours : ') !!}
                    {!! Form::text('cla_intitule', old('cla_intitule'), ['class' => 'form-control', 'required' => '']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('professeur_principal', 'Professeur principal') !!}
                    <select class="form-control" name="professeur_principal" id='professeur_principal' value="{{ old('professeur_principal') }}">
                        <option value="">-- Sélectionner --</option>
                    @foreach ($profs as $p)
                        @if ($p->id == $c->professeur_id)
                        <option value="{!! $p->id !!}" selected>{!! $p->prof_prenoms !!} {!! $p->prof_nom !!}</option>
                        @else
                        <option value="{!! $p->id !!}">{!! $p->prof_prenoms !!} {!! $p->prof_nom !!}</option>
                        @endif
                    @endforeach
                    </select>
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
