@extends('templates.app')
@section('title') Informations de l'élève @endsection
@section('section-title') Inscrire un élève @endsection
@section('content')
    <div class="x_content" style="display: block;">
        <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="{{ route('inscriptions.edit', ['id' => $inscription->eleve_id]) }}" id="home-tab" role="tab">Élève</a>
                </li>
                <li role="presentation" class="">
                    <a href="{{ route('parent.info', ['id' => $inscription->parent_id]) }}" role="tab" id="profile-tab">Parent d'élève</a>
                </li>
                <li role="presentation" class="">
                    <a href="{{ route('inscriptions.show', ['id' => $inscription->id]) }}" role="tab">Afficher informations</a>
                </li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="tab_content1" aria-labelledby="home-tab">
                    {!! Form::open(['route' => ['inscriptions.update', $inscription->eleve_id], 'method' => 'PUT']) !!}
                    <fieldset>
                        <legend>Informations sur l'élève</legend>
                        <div class='row'>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    {!! Form::label('nom', "Nom de l'élève") !!}
                                    {!! Form::text('nom', $inscription->nom, ['class' => 'form-control', 'required' => '']) !!}
                                </div>
                            </div>

                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    {!! Form::label('prenoms', "Prénom(s) de l'élève") !!}
                                    {!! Form::text('prenoms', $inscription->prenoms, ['class' => 'form-control', 'required' => '']) !!}
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('date_naissance', "Date de naissance") !!}
                                    {!! Form::date('date_naissance', $inscription->date_naissance, ['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('sexe', "Sexe") !!}
                                    <select name="sexe" id="sexe" class='form-control' required>
                                        @if ($inscription->sexe == 'Masculin')
                                            <option value="Masculin" selected>Masculin</option>
                                            <option value="Féminin">Féminin</option>
                                        @else
                                            <option value="Féminin" selected>Féminin</option>
                                            <option value="Masculin">Masculin</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 d-none">
                                <p>Ancien élève de l'école ? </p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id='ancien-oui' name="ancien" value="1"{{($inscription->ancien !== false)?'checked':''}}>
                                    <label class="form-check-label" for="ancien-oui">Oui</label>

                                    <input class="form-check-input" type="radio" id="ancien-non" name="ancien" value="0" {{($inscription->ancien == false)?'checked':''}}>
                                    <label class="form-check-label" for="ancien-non">Non</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <p>Redoublant ?</p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id='redoublant-oui' name="redoublant" value="1" {{($inscription->redoublant !== false)?'checked':''}}>
                                    <label class="form-check-label" for="redoublant-oui">Oui</label>

                                    <input class="form-check-input" type="radio" id="redoublant-non" name="redoublant" value="0" {{($inscription->redoublant == false)?'checked':''}}>
                                    <label class="form-check-label" for="redoublant-non">Non</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    {!! Form::label('classe', "Classe souhaitée") !!}
                                    <select name="classe" id="classe" class="form-control" value="{{ old('classe') }}" required>
                                        <option value=""></option>
                                        @foreach ($classes as $classe)
                                            @if ($classe->id == $inscription->classe_id)
                                                <option value="{{ $classe->id }}" selected>{{ $classe->cla_intitule }}</option>
                                            @else
                                                <option value="{{ $classe->id }}">{{ $classe->cla_intitule }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    {!! Form::label('ecole_provenance', "Ecole de provenance") !!}
                                    {!! Form::text('ecole_provenance', $inscription->ecole_provenance, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>

                    </fieldset>
                    <br>
                    <div class='form-group text-center'>
                        {{ Form::submit("Modifier", array('class' => 'btn btn-success ')) }}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
