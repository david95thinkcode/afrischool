@extends('templates.app')
@section('title') Scolarité @endsection
@section('section-title') Liste des élève ayant à solder @endsection
@section('content')
<div class="col-sm-12">

    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

        @foreach ($sorted as $sd)
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading{!! $sd['classe']->id !!}">
                <h4 class="panel-title text-center">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#{!! $sd['classe']->id !!}"
                        aria-expanded="false" aria-controls="{!! $sd['classe']->id !!}">
                        {!! $sd['classe']->cla_intitule !!} : 
                        <span class="badge">{!! count($sd['debiteurs']) !!} élève(s) trouvé(s)</span>
                    </a>
                </h4>
            </div>
            <div id="{!! $sd['classe']->id !!}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading{!! $sd['classe']->id !!}">
                <table class="table table-bordered jambo_table">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nom & prénom(s)</th>
                            <th>Parent</th>
                            <th>Contacts parent</th>
                            <th>Scolarité</th>
                            <th>Reste à solder</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($sd['debiteurs'] == 0)
                        <tr class="text-center my-5 py-5">
                            Pas de scolarité non soldée !
                        </tr>
                        @else
                        @foreach ($sd['debiteurs'] as $debiteur)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td>
                                {{$debiteur->eleve->full_name}}
                            </td>
                            <td>{{$debiteur->eleve->parent->full_name}}</td>
                            <td>{{$debiteur->eleve->parent->par_tel}} / {{$debiteur->eleve->parent->par_email}}</td>
                            <td>{{$debiteur->montant_scolarite}} <strong>fcfa</strong></td>
                            <td>{{$debiteur->montant_restant}} <strong>fcfa</strong></td>
                            <td class="text-center">
                                @if (Auth::user()->hasRole('comptable'))
                                <a href="{{route('eleve.solder.scolarite', [$debiteur->id, $debiteur->eleve->id])}}"
                                    class="btn btn-xs btn-success">
                                    Enregistrer un paiement
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('custom-css')
<link rel="stylesheet" href="{{asset('css/dataTables.bootstrap.min.css')}}">
@stop

@section('custom-js')
<script src="{{asset('js/jquery.dataTables.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.table-bordered').dataTable({
            "language": {
                "url": "{{asset('lang/French.json')}}"
            }
        });
    });
</script>
@endsection