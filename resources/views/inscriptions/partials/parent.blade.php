<div class="row">
    <div class="col-md-6 col-xs-12">
        <div class="form-group">
            {!! Form::label('nom_parent', "Nom du parent") !!}
            {!! Form::text('nom_parent', old('nom_parent'), ['class' => 'form-control', 'required' => '']) !!}
        </div>
    </div>
    <div class="col-md-6 col-xs-12">
        <div class="form-group">
            {!! Form::label('prenoms_parent', "Prénom(s) du parent") !!}
            {!! Form::text('prenoms_parent', old('prenoms_parent'), ['class' => 'form-control', 'required' => '']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-xs-6">
        <div class="form-group">
            {!! Form::label('tel_parent', "Tel") !!}
            {!! Form::text('tel_parent', old('tel_parent'), ['class' => 'form-control', 'required' => '']) !!}
        </div>
    </div>
    <div class="col-md-6 col-xs-6">
        <div class="form-group">
            {!! Form::label('mail_parent', "Adresse email") !!}
            {!! Form::email('mail_parent', old('mail_parent'), ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('sexe_parent', "Sexe") !!}
            <select name="sexe_parent" id="sexe_parent" class="form-control">
                @include('partials.sexe-options')
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('person_a_contacter_lien', 'Lien') !!}
            <select name="person_a_contacter_lien" id="person_a_contacter_lien" class='form-control'>
                <option value="père/mère">Père/Mère</option>
                <option value="oncle/tante">Oncle/Tante</option>
                <option value="cousin(e)">Cousin/Cousine</option>
                <option value="tuteur/tutrice">Tuteur/Tutrice</option>
                <option value="autres">Autres</option>
            </select>
        </div>
    </div>
</div>
