<div class="form-group">
    {!! Form::label('cla_intitule', 'Nom de la classe ') !!}
    {!! Form::text('cla_intitule', old('cla_intitule'), ['class' => 'form-control', 'required' => '']) !!}
</div>
<div class="form-group">
    {!! Form::label('professeur_principal', 'Professeur principal') !!}
    <select class="form-control" name="professeur_principal" id='professeur_principal' value="{{ old('professeur_principal') }}">
        <option value="">-- Sélectionner --</option>
    @foreach ($profs as $p)
        <option value="{!! $p->id !!}">{!! $p->prof_prenoms !!} {!! $p->prof_nom !!}</option>
    @endforeach
    </select>
</div>
