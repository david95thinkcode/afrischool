<div class='row'>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                <h4 class="text-primary">
                    Informations générale
                </h4>
            </div>
            <div class="panel-body">
                <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        {!! Form::label('prof_nom', "Nom") !!} <i class="fa fa-star text-danger" aria-hidden="true"></i>
                        {!! Form::text('prof_nom', old('prof_nom'), ['class' => 'form-control', 'required' => '']) !!}
                    </div>
                </div>

                <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        {!! Form::label('prof_prenoms', "Prénom(s)") !!} <i class="fa fa-star text-danger" aria-hidden="true"></i>
                        {!! Form::text('prof_prenoms', old('prof_prenoms'), ['class' => 'form-control', 'required' => '']) !!}
                    </div>
                </div>

                <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        {!! Form::label('prof_date_naissance', "Date de naissance") !!} <i class="fa fa-star text-danger" aria-hidden="true"></i>
                        {!! Form::date('prof_date_naissance', old('prof_date_naissance'), ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        {!! Form::label('prof_sexe', "Sexe") !!} <i class="fa fa-star text-danger" aria-hidden="true"></i>
                        <select name="prof_sexe" id='prof_sexe' class="form-control"
                                required value="{{ old('prof_sexe') }}">
                            @include('partials.sexe-options')
                        </select>
                    </div>
                </div>

                <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        {!! Form::label('prof_tel', 'Téléphone') !!} <i class="fa fa-star text-danger" aria-hidden="true"></i>
                        {!! Form::text('prof_tel', old('prof_tel'), ['class' => 'form-control', 'required' => '']) !!}
                    </div>
                </div>

                <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        {!! Form::label('prof_email', 'Email') !!} <i class="fa fa-star text-danger" aria-hidden="true"></i>
                        {!! Form::email('prof_email', old('prof_email'), ['class' => 'form-control']) !!}
                    </div>
                    <br>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                <h4 class="text-primary">
                    Informations complémentaires
                </h4>
            </div>
            <div class="panel-body">

                <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        {!! Form::label('prof_matrimonial', "Situation matrimonial") !!} <i class="fa fa-star text-danger" aria-hidden="true"></i>
                        <select class="form-control" name="prof_matrimonial" id='prof_matrimonial'
                                value="{{ old('prof_matrimonial') }}" required>
                            @if ($prof->prof_matrimonial == 'celibataire')
                                <option value="celibataire" selected>Célibataire</option>
                                <option value="en couple">En couple</option>
                            @else
                                <option value="en couple" selected>En couple</option>
                                <option value="celibataire">Célibataire</option>
                            @endif
                        </select>
                    </div>
                </div>

                <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        {!! Form::label('prof_enfant', "Nombre d'enfant") !!} <i class="fa fa-star text-danger" aria-hidden="true"></i>
                        <select class="form-control" name="prof_enfant" id='prof_enfant'
                                value="{{ old('prof_enfant') }}" required>
                            <option value="0" @if($prof->prof_enfant == 0) selected @endif>0</option>
                            <option value="1" @if($prof->prof_enfant == 1) selected @endif>1</option>
                            <option value="2" @if($prof->prof_enfant == 2) selected @endif>2</option>
                            <option value="3" @if($prof->prof_enfant == 3) selected @endif>3</option>
                            <option value="4" @if($prof->prof_enfant == 4) selected @endif>4</option>
                            <option value="5" @if($prof->prof_enfant == 5) selected @endif>5</option>
                            <option value="6" @if($prof->prof_enfant == 6) selected @endif>6</option>
                            <option value="7" @if($prof->prof_enfant == 7) selected @endif>7</option>
                            <option value="8" @if($prof->prof_enfant == 8) selected @endif>8</option>
                            <option value="9" @if($prof->prof_enfant == 9) selected @endif>9</option>
                            <option value="10" @if($prof->prof_enfant == 10) selected @endif>10</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        {!! Form::label('prof_type', 'Statut du professeur') !!} <i class="fa fa-star text-danger" aria-hidden="true"></i>
                        <select class="form-control" name="prof_type" id='prof_type'
                                value="{{ old('prof_type') }}" required>
                            <option value="titulaire" @if($prof->prof_type == 'titulaire') selected @endif>Titulaire</option>
                            <option value="vacataire" @if($prof->prof_type == 'vacataire') selected @endif>Vacataire</option>
                        </select>
                    </div>
                    <br>
                </div>

                <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        {!! Form::label('prof_nationalite', "Nationalité") !!}
                        <select class="form-control" name="prof_nationalite" id='prof_nationalite'
                                value="{{ old('prof_nationalite') }}" required>
                        </select>
                    </div>
                </div>

            </div>
        </div>
    </div>



    <div class='text-center'>
        {{ Form::submit("Enregistrer", array('class' => 'btn btn-success col-md-3 col-md-offset-4')) }}
    </div>
</div>
