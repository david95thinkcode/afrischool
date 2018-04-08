<div class="form-group">
    <div class='row'>
        <div class="col">
            <div class="form-group">
                {!! Form::label('nom', "Nom de l'élève") !!}
                {!! Form::text('nom', old('nom'), ['class' => 'form-control', 'required' => '']) !!}
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                {!! Form::label('prenoms', "Prénom(s) de l'élève") !!}
                {!! Form::text('prenoms', old('prenoms'), ['class' => 'form-control', 'required' => '']) !!}
            </div>
        </div>
    </div>
    <div class='row'>
        <div class="col">
            <div class="form-group">
                {!! Form::label('date_naissance', "Date de naissance") !!}
                {!! Form::date('date_naissance', old('date_naissance'), ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                {!! Form::label('sexe', "Sexe") !!}
                <select name="sexe" id="sexe" class='form-control' required>
                    @include('partials.sexe-options')
                </select>
            </div>
        </div>
    </div>

    <div class="row">
      <div class="col d-none">
          <p>Ancien élève de l'école ? </p>
          <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" id='ancien-oui' name="ancien" value="1">
              <label class="form-check-label" for="ancien-oui">Oui</label>
          </div>
          <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" id="ancien-non" name="ancien" value="0" checked>
              <label class="form-check-label" for="ancien-non">Non</label>
          </div>
      </div>
        <div class="col">
            <div class="form-group">
                {!! Form::label('ecole_provenance', "Ecole de provenance") !!}
                {!! Form::text('ecole_provenance', old('ecole_provenance'), ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
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

        <div class="col">
            <p>Redoublant ?</p>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id='redoublant-oui' name="redoublant" value="1">
                <label class="form-check-label" for="redoublant-oui">Oui</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="redoublant-non" name="redoublant" value="0">
                <label class="form-check-label" for="redoublant-non">Non</label>
            </div>
        </div>

    </div>
</div>
