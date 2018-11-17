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
                        {!! Form::label('prof_est_marie', "Situation matrimonial") !!} <i class="fa fa-star text-danger" aria-hidden="true"></i>
                        <select class="form-control" name="prof_est_marie" id='prof_est_marie' required>
                            <option value='0'>Célibataire</option>
                            <option value='1'>En couple</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        {!! Form::label('prof_enfant', "Nombre d'enfant") !!} <i class="fa fa-star text-danger" aria-hidden="true"></i>
                        <select class="form-control" name="prof_enfant" id='prof_enfant'
                                value="{{ old('prof_enfant') }}" required>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        {!! Form::label('prof_est_permanent', 'Statut du professeur') !!} <i class="fa fa-star text-danger" aria-hidden="true"></i>
                        <select class="form-control" name="prof_est_permanent" id='prof_est_permanent' required>
                            <option value='1'>Permanent</option>
                            <option value='0'>Vacataire</option>
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
