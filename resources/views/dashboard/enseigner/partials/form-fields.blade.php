                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            {!! Form::label('classe', 'Classe') !!}
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
                        <div class="col">
                            <br>
                            <a href="{!! route('classe.create') !!}" class="btn btn-success">Nouveau</a>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class='col-sm-8'>
                            {!! Form::label('matiere', 'Matiere') !!}
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
                        <div class="col">
                            <br>
                            <a href="{!! route('matieres.create') !!}" class="btn btn-success pt-sm-2">Nouveau</a>
                         </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            {!! Form::label('professeur', 'Professeur') !!}
                            <select class="form-control" name="professeur" id='professeur' value="{{ old('professeur') }}">

                                <option value=""></option>
                                @foreach ($profs as $p)
                                    @if (isset($ens))
                                        @if ($ens->professeur_id == $p->id)
                                        <option value="{!! $p->id !!}" selected>{!! $p->prof_prenoms !!} {!! $p->prof_nom !!}</option>
                                        @else
                                        <option value="{!! $p->id !!}">{!! $p->prof_prenoms !!} {!! $p->prof_nom !!}</option>
                                        @endif
                                    @else
                                        <option value="{!! $p->id !!}">{!! $p->prof_prenoms !!} {!! $p->prof_nom !!}</option>
                                    @endif
                                @endforeach

                            </select>
                        </div>
                        <div class="col">
                            <br>
                            <a href="{!! route('professeurs.create') !!}" class="btn btn-success pt-sm-2">Nouveau</a>
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4">
                            {!! Form::label('coefficient', 'Coefficent de la matière') !!}
                            {!! Form::number('coefficient', old('coefficient'), ['class' => 'form-control', 'required' => '']) !!}
                        </div>
                    </div>
                </div>
                <br>

                <div class='form-group'>
                    {{ Form::submit("Enregistrer", array('class' => 'btn btn-primary ')) }}
                </div>