<div class='row'>
    <div class="col-md-6 col-xs-12">
        <div class="form-group">
            {!! Form::label('prof_nom', "Nom du professeur") !!}
            {!! Form::text('prof_nom', old('prof_nom'), ['class' => 'form-control', 'required' => '']) !!}
        </div>
    </div>

    <div class="col-md-6 col-xs-12">
        <div class="form-group">
            {!! Form::label('prof_prenoms', "Prénom(s) du professeur") !!}
            {!! Form::text('prof_prenoms', old('prof_prenoms'), ['class' => 'form-control', 'required' => '']) !!}
        </div>
    </div>

    <div class="col-md-6 col-xs-12">
        <div class="form-group">
            {!! Form::label('prof_nationalite', "Nationalité") !!}
            <select class="form-control" name="prof_nationalite" id='prof_nationalite'
                    value="{{ old('prof_nationalite') }}" required>
                <option value=""></option>
            </select>
        </div>
    </div>

    <div class="col-md-6 col-xs-12">
        <div class="form-group">
            {!! Form::label('prof_date_naissance', "Date de naissance") !!}
            {!! Form::date('prof_date_naissance', old('prof_date_naissance'), ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-6 col-xs-12">
        <div class="form-group">
            {!! Form::label('prof_sexe', "Sexe") !!}
            <select name="prof_sexe" id='prof_sexe' class="form-control">
                @include('partials.sexe-options')
            </select>
        </div>
    </div>

    <div class="col-md-6 col-xs-12">
        <div class="form-group">
            {!! Form::label('prof_tel', 'Téléphone') !!}
            {!! Form::text('prof_tel', old('prof_tel'), ['class' => 'form-control', 'required' => '']) !!}
        </div>
    </div>

    <div class="col-md-6 col-xs-12">
        <div class="form-group">
            {!! Form::label('prof_email', 'Email') !!}
            {!! Form::email('prof_email', old('prof_email'), ['class' => 'form-control']) !!}
        </div>
        <br>
    </div>
</div>

<div class='text-center'>
    {{ Form::submit("Enregistrer", array('class' => 'btn btn-success col-md-3 col-md-offset-4')) }}
</div>
