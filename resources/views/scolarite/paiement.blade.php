@extends('templates.app')
@section('title') Information sur la scolarité @endsection
@section('section-title') Paiement scolarité @endsection
@section('content')

<div class="row">
    <div class="col-sm-3">
        <div class="panel panel-default mx-auto">
            <div class="panel-heading">
                <h5>A propos de ce paiement</h5>
            </div>
            <table class="table table-responsive">
                <tbody>
                    <tr>
                        <td>Montant Scolarité</td>
                        <td>{!! $inscription->montant_scolarite !!}</td>
                    </tr>
                    <tr>
                        <td>Montant payé</td>
                        <td>{!! $inscription->montant_paye !!}</td>
                    </tr>
                    <tr>
                        <td>Montant restant</td>
                        <th>{!! $reste !!}</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="panel panel-default mx-auto">
            <div class="panel-heading"><h5>Détails du paiement</h5></div>
            <div class="panel-body">
                {!! Form::open(['action' => ['EleveController@solderScolarite'], 'method' => 'POST']) !!}
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
                        {!! Form::number('montant_verser', old('montant_verser'), ['class' => 'form-control', 'max' =>
                        $reste, 'required' => '']) !!}
                    </div>
                    {!! Form::hidden('reste', $reste, ['class' => 'form-control']) !!}
                    
                    
                    <div class='form-group text-center'>
                        <br>
                        {{ Form::submit("Enregistrer paiement", array('class' => 'btn btn-success ')) }}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading"><h5>Les paiements déjà effectués</h5></div>
            <table class="table table-responsive">
                <thead>
                    <th>#</th>
                    <th>Montant payé</th>
                    <th>Tranche N°</th>
                    <th>Payé le</th>
                </thead>
                <tbody>
                    @foreach ($paiements as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td class="text-center">{{ $p->montant }}</td>
                        <td class="text-center">{{ $p->tranche_scolarite_id }}</td>
                        <td>{{ $p->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection