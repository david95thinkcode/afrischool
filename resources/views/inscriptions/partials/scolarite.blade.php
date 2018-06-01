<div class='row'>
    <div class="col-md-6 col-xs-12">
        <div class="form-group{{ $errors->has('montant_scolarite') ? ' has-error' : '' }}">
            {!! Form::label('montant_scolarite', "Montant de la scolarité") !!}
            {!! Form::text('montant_scolarite', old('montant_scolarite'), ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-6 col-xs-12">
        <div class="form-group{{ $errors->has('montant_verser') ? ' has-error' : '' }}">
            {!! Form::label('montant_verser', "Montant payé") !!}
            {!! Form::text('montant_verser', old('montant_verser'), ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-6 col-xs-12">
        <div class="form-group{{ $errors->has('date_inscription') ? ' has-error' : '' }}">
            {!! Form::label('date_inscription', "Date d\'inscription") !!}
            {!! Form::date('date_inscription', old('date_inscription'), ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-6 col-xs-12">
        <div class="form-group">
            {!! Form::label('classe', "Classe souhaitée") !!}
            <select name="classe" id="classe" class="form-control" value="{{ old('classe') }}" required>
                <option value="">-- Sélectionner --</option>
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
        <div class="form-group{{ $errors->has('annee_scolaire') ? ' has-error' : '' }}">
            {!! Form::label('annee_scolaire', "Année scolaire") !!}
            <select name="annee_scolaire" id="annee_scolaire" class="form-control" value="{{ old('annee_scolaire') }}" required>
                <option value="">-- Sélectionner --</option>
                @foreach ($annee_scolaires as $annee)
                    @if ($annee->id == old('annee_scolaire'))
                        <option value="{{ $annee->id }}" selected>
                            {{\Carbon\Carbon::parse($annee->an_date_debut)->format('Y')}} à
                            {{\Carbon\Carbon::parse($annee->an_date_fin)->format('Y')}}
                        </option>
                    @else
                        <option value="{{ $annee->id }}">
                            {{\Carbon\Carbon::parse($annee->an_date_debut)->format('Y')}} à
                            {{\Carbon\Carbon::parse($annee->an_date_fin)->format('Y')}}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
</div>
