                <div class="form-group">
                    {!! Form::label('dip_intitule', 'Intitulé du diplôme') !!} 
                    {!! Form::text('dip_intitule', old('dip_intitule'), ['class' => 'form-control', 'required' => '']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('dip_ecole', 'Ecole') !!} 
                    {!! Form::text('dip_ecole', old('dip_ecole'), ['class' => 'form-control', 'placeholder' => "L'école ou le diplôme a été obtenu", 'required' => '']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('dip_specialite', "Spécialité") !!} 
                    {!! Form::text('dip_specialite', old('dip_specialite'), ['class' => 'form-control', 'required' => '']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('dip_niveau', "Niveau") !!} 
                    {!! Form::text('dip_niveau', old('dip_niveau'), ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('dip_date_obtention', "Date d'obtention") !!} 
                    {!! Form::date('dip_date_obtention', old('dip_date_obtention'), ['class' => 'form-control']) !!}
                </div>
                <br>
                <div class='form-group'>
                    {{ Form::submit("Enregistrer", array('class' => 'btn btn-success ')) }}
                </div>
                