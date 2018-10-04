@extends('templates.app')
@section('title') Scolarité @endsection
@section('section-title') Résultats de recherche des insoldés de la classe de : <strong>{!! $classe->cla_intitule !!}</strong> @endsection
@section('content')
<div class="col-sm-12">
    @if (count($debiteurs) > 0)
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading{!! $classe->id !!}">
                <h4 class="panel-title text-center">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#{!! $classe->id !!}"
                        aria-expanded="false" aria-controls="{!! $classe->id !!}">
                        <strong>
                            {!! $classe->cla_intitule !!} : 
                        </strong>
                        <span class="badge">{!! count($debiteurs) !!} élève(s) trouvé(s)</span>
                    </a>
                </h4>
            </div>
            <div id="{!! $classe->id !!}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading{!! $classe->id !!}">
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
                        @foreach ($debiteurs as $debiteur)
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
                    </tbody>                    
                </table>
            </div>
        </div>
    </div>
    @else
        <h2 class="alert alert-info">Aucun insoldé pour la classe de {!! $classe->cla_intitule !!}</h2>
    @endif
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
        $('#eleves').dataTable({
            "language": {
                "url": "{{asset('lang/French.json')}}"
            }
        });
    });
</script>
@endsection