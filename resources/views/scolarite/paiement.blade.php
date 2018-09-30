@extends('templates.app')
@section('title') Information sur la scolarité @endsection
@section('section-title') Paiement restant de la scolarité @endsection
@section('content')
    <div class="col-sm-12">
        <div class="x-content">
            {!! Form::open(['action' => ['EleveController@solderScolarite'], 'method' => 'POST']) !!}
            <fieldset>
                <legend>Informations sur la scolarité</legend>

                <div class='row'>
                    <div class="col-md-4 col-md-offset-4">
                        <div class="form-group row">
                            <div class="form-group col-sm-6">
                                        {!! Form::label('tranche', "Quelle tranche est payée ?") !!}
                                        <select name="tranche" id="tranche" class='form-control' required>
                                            @foreach ($tranches as $t)
                                            <option value="{!! $t->id !!}">{!! $t->description !!}</option>
                                            @endforeach
                                        </select>
                                    </div>
                            <div class="form-group{{ $errors->has('montant_verser') ? ' has-error' : '' }} col-sm-6">
                                {!! Form::label('montant_verser', "Montant payé") !!}
                                {!! Form::number('montant_verser', old('montant_verser'), ['class' => 'form-control', 'max' => $reste, 'required' => '']) !!}
                            </div>
                            {!! Form::hidden('reste', $reste, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>

            </fieldset>
            <br>
            <div class='form-group text-center'>
                {{ Form::submit("Enregistrer paiement", array('class' => 'btn btn-success ')) }}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection