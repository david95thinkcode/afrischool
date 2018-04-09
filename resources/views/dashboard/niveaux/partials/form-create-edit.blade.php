<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('niv_libelle', 'Intitulé du niveau ') !!}
            {!! Form::text('niv_libelle', old('niv_libelle'), ['class' => 'form-control', 'placeholder' => 'Ex: CP', 'required' => '']) !!}
        </div>
    </div>
    <div class="col-sm-8">
        <div class="form-group">
            {!! Form::label('niv_description', 'Description du niveau ') !!}
            {!! Form::text('niv_description', old('niv_description'), ['class' => 'form-control', 'placeholder' => 'Ex: Cours Préparatoires']) !!}
        </div>
    </div>
</div>


