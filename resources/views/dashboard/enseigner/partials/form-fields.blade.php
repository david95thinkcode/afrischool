<div class="row">
    <div class="col-md-5 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
        <div class="panel panel-default mx-auto">
            <div class="panel-body">
                <div class="col-md-12 col-xs-12 mb-1">
                    {!! Form::label('classe', 'Classe') !!}
                    <a href="{!! route('classe.create') !!}" class="btn btn-success pull-right">
                        Créer classe
                    </a>
                    <select name="classe" id="classe" class="form-control" required>
                        <option value=""></option>
                        @foreach ($classes as $classe)
                            @if (isset($ens))
                                @if ($ens->classe_id == $classe->id)
                                    <option value="{{ $classe->id }}" selected>{{ $classe->cla_intitule }}</option>
                                @else
                                    <option value="{{ $classe->id }}">{{ $classe->cla_intitule }}</option>
                                @endif
                            @else
                                <option value="{{ $classe->id }}">{{ $classe->cla_intitule }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class='col-md-12 col-xs-12 mb-1'>
                    {!! Form::label('matiere', 'Matiere') !!}
                    <a href="{!! route('matieres.create') !!}" class="btn btn-success pull-right">
                        Créer matière
                    </a>
                    <select name="matiere" id="matiere" class="form-control" required>
                        <option value=""></option>
                        @foreach ($matieres as $matiere)
                            @if (isset($ens))
                                @if ($ens->matiere_id == $matiere->id)
                                    <option value="{{ $matiere->id }}" selected>{{ $matiere->intitule }}</option>
                                @else
                                    <option value="{{ $matiere->id }}">{{ $matiere->intitule }}</option>
                                @endif
                            @else
                                <option value="{{ $matiere->id }}">{{ $matiere->intitule }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12 col-xs-12 mb-1">
                    {!! Form::label('professeur', 'Professeur') !!}
                    <a href="{!! route('professeurs.create') !!}" class="btn btn-success pull-right">
                        Créer professeur
                    </a>
                    <select class="form-control" name="professeur" id='professeur' value="{{ old('professeur') }}">

                        <option value=""></option>
                        @foreach ($profs as $p)
                            @if (isset($ens))
                                @if ($ens->professeur_id == $p->id)
                                    <option value="{!! $p->id !!}"
                                            selected>{!! $p->prof_prenoms !!} {!! $p->prof_nom !!}</option>
                                @else
                                    <option value="{!! $p->id !!}">{!! $p->prof_prenoms !!} {!! $p->prof_nom !!}</option>
                                @endif
                            @else
                                <option value="{!! $p->id !!}">{!! $p->prof_prenoms !!} {!! $p->prof_nom !!}</option>
                            @endif
                        @endforeach

                    </select>
                </div>

                <div class="col-md-12 col-xs-12">
                    {!! Form::label('coefficient', 'Coefficent de la matière') !!}
                    {!! Form::number('coefficient', old('coefficient'), ['class' => 'form-control', 'required' => '']) !!}
                </div>

                <div class='col-md-12 text-center mt-1'>
                    {{ Form::submit("Enregistrer",
                    array('class' => 'btn btn-success col-md-6 col-md-offset-3')) }}
                </div>
            </div>
        </div>
    </div>
</div>