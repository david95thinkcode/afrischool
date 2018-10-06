<div class="row">
    <div class="col-md-4 col-xs-12">
        <div class="form-group">
            {!! Form::label('person_a_contacter_nom', 'Nom et prénoms') !!}
            {!! Form::tel('person_a_contacter_nom', old('person_a_contacter_nom'), ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4 col-xs-4">
        <div class="form-group">
            {!! Form::label('person_a_contacter_tel', 'Tél.') !!}
            {!! Form::text('person_a_contacter_tel', old('person_a_contacter_tel'), ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4 col-xs-4">
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
