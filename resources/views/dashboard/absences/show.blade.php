@extends('templates.app') 
@section('title') Absences @endsection
 
@section('section-title') Liste des absences enregistrées !
@endsection
 
@section('content')
<div class='row'>
    <div class="col-md-5 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
        <div class="panel panel-default mx-auto">
            <div class="panel-body">
                <div class="x-content">
                    <div class="col-md-6"><strong>Classe :</strong> {!! $details['classe']->cla_intitule !!}</div>
                    <div class="col-md-6"><strong>Date :</strong> {!! $details['date'] !!}</div>
                    <div class="col-md-6"><strong>Période :</strong> {!! $details['periode'] !!}</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='row'>
    <div class="col-md-12 col-xs-12 mt-1">
            <table class="table table-bordered jambo_table" id="table_depense">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Horaires</td>
                        <td>Matière</td>
                        <td>Elève</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($filtredAbsences as $abs)
                    <tr>
                        <td>{!! $loop->iteration !!}</td>
                        <td>{!! $abs['horaire']->horaire->debut !!} - {!! $abs['horaire']->horaire->fin !!} </td>
                        <td>{!! $abs['enseigner']->matiere->intitule !!} </td>
                        <td>{!! $abs['inscription']->eleve->nom !!} {!! $abs['inscription']->eleve->prenoms !!} </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</div>
@endsection
