<div class="col-md-12">
    <div class="form-group">
        {!! Form::label('cla_intitule', 'Nom de la classe ') !!}
        {!! Form::text('cla_intitule', old('cla_intitule'), ['class' => 'form-control', 'placeholder' => 'Ex: 3e D', 'required' => '']) !!}
    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        {!! Form::label('cla_description', 'Description') !!}
        {!! Form::text('cla_description', old('cla_description'), ['class' => 'form-control', 'placeholder' => 'Ex: Troisième D',]) !!}
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        {!! Form::label('mt_scolarite', 'Montant de la scolarité') !!}
        {!! Form::number('mt_scolarite', old('mt_scolarite'), ['class' => 'form-control',]) !!}
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        {!! Form::label('niveau', 'Niveau') !!}
        <select class="form-control" name="niveau" id='niveau' required>
            <option value="">-- Sélectionner --</option>
            @foreach ($typedeclasse as $key => $value)
                @if (old('niveau') == $key)
                    <option value="{!! $key !!}" selected>{!! $value !!}</option>
                @endif
                <option value="{!! $key !!}">{!! $value !!}</option>
            @endforeach
        </select>
    </div>
</div>
<br>
<div class='form-group text-center'>
    {{ Form::submit("Enregistrer", array('class' => 'btn btn-success ')) }}
</div>