<div class="form-group">
    {!! Form::label('intitule', 'Titre de la matière') !!}
    {!! Form::text('intitule', old('intitule'), ['class' => 'form-control', 'required' => '']) !!}
</div>

<br>
<div class='form-group text-center'>
    {{ Form::submit("Enregistrer", array('class' => 'btn btn-success ')) }}
</div>