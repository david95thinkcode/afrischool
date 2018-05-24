<div class="row">
    <div class="col-md-5 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
        <div class="panel panel-default mx-auto">
            <div class="panel-body">
                {{--  matières  --}}
                <div class='col-md-12 col-xs-12 form-group'>
                    {!! Form::label('matiere', 'Matiere') !!}                    
                    <select name="enseigner" id="enseigner" class="form-control" required>
                        <option value=""></option>
                        @foreach ($matieres as $matiere)
                            <option value="{{ $matiere['enseigner_id'] }}">{{ $matiere['datas']->intitule }}</option>
                        @endforeach
                    </select>
                </div>
                {{--  jour  --}}
                <div class="col-md-12 col-xs-12 form-group">
                    {!! Form::label('jour', 'Jour de la semaine') !!}
                    <select name="jour" id="jour" class="form-control" required>
                        <option value=""></option>
                        @foreach ($jours as $day)
                            <option value="{{ $day->id }}">{{ $day->nom }}</option>
                        @endforeach
                    </select>
                </div>
                 {{--  heure début  --}}
                <div class="col-md-12 col-xs-12 form-group">
                    {!! Form::label('debut', 'Heure de debut') !!}
                    {!! Form::time('debut', old('debut'), ['class' => 'form-control', 'required' => '']) !!}
                </div>
                {{--  heure fin  --}}
                <div class="col-md-12 col-xs-12 form-group">
                    {!! Form::label('fin', 'Heure de fin') !!}
                    {!! Form::time('fin', old('fin'), ['class' => 'form-control', 'required' => '']) !!}
                </div>
                
                {!! Form::hidden('classe', old('classe'), ['class' => 'form-control', 'required' => '']) !!}
                
                <div class='col-md-12 text-center mt-1'>
                    {{ Form::submit("Enregistrer", ['class' => 'btn btn-success col-md-6 col-md-offset-3']) }}
                </div>
            </div>
        </div>
    </div>
</div>