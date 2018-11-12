<div class='row'>
    <div class="col-md-6 col-xs-12">
        <div class="form-group">
            {!! Form::label('nom', "Nom de l'élève") !!}
            {!! Form::text('nom', old('nom'), ['class' => 'form-control', 'required' => '']) !!}
        </div>
    </div>

    <div class="col-md-6 col-xs-12">
        <div class="form-group">
            {!! Form::label('prenoms', "Prénom(s) de l'élève") !!}
            {!! Form::text('prenoms', old('prenoms'), ['class' => 'form-control', 'required' => '']) !!}
        </div>
    </div>
</div>
<div class='row'>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('date_naissance', "Date de naissance") !!}
            {!! Form::date('date_naissance', old('date_naissance'), ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('sexe', "Sexe") !!}
            <select name="sexe" id="sexe" class='form-control' required>
                @include('partials.sexe-options')
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-xs-12">
        <div class="form-group">
            {!! Form::label('classe', "Classe souhaitée") !!}
            <select name="classe" id="classe" class="form-control" value="{{ old('classe') }}" required>
                <option value=""></option>
                @foreach ($classes as $classe)
                    @if ($classe->id == old('classe'))
                        <option value="{{ $classe->id }}" selected>{{ $classe->cla_intitule }}</option>
                    @else
                        <option value="{{ $classe->id }}">{{ $classe->cla_intitule }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6 col-xs-12">
        <div class="form-group">
            {!! Form::label('ecole_provenance', "Ecole de provenance") !!}
            {!! Form::text('ecole_provenance', old('ecole_provenance'), ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
