<div class="form-group">
    {!! Form::label('cla_intitule', 'Nom de la classe ') !!}
    {!! Form::text('cla_intitule', old('cla_intitule'), ['class' => 'form-control', 'placeholder' => 'Ex: 3e D', 'required' => '']) !!}
</div>
<div class="form-group">
    {!! Form::label('niveau', 'Niveau') !!}
    <select class="form-control" name="niveau" id='niveau' value="{{ old('professeur_principal') }}">
        <option value="">-- Sélectionner --</option>
      
      @foreach ($niveaux as $n)
        @if (isset($c))
            @if ($n->id == $c->niveau_id)
            <option value="{!! $n->id !!}" selected>{!! $n->niv_libelle !!}</option>
            @else
            <option value="{!! $n->id !!}">{!! $n->niv_libelle !!}</option>
            @endif
        @else
            <option value="{!! $n->id !!}">{!! $n->niv_libelle !!}</option>
        @endif        
      @endforeach
    </select>
</div>