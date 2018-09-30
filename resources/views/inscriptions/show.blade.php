@extends('templates.app')
@section('title') Inscriptions @endsection
@section('section-title') Les élèves inscrits en {!! $concernedClasse->cla_intitule !!} @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
        <div>
            <p>Nombre total : <strong>{!! $inscriptions->count() !!} inscrit(s)</strong></p>
        </div>
        <div>
            <div class="table-responsive">
                <table class="table table-bordered jambo_table" id="table_eleves">
                    <thead>
                        <th>#</th>
                        <th>Elève</th>
                        <th>Age</th>
                        <th>Inscrit le</th>
                        <th>Parent & contats</th>
                        <th>Reste à solder</th>
                        <th>Options</th>
                    </thead>
                    <tbody>
                        @foreach ($inscriptions as $i)
                            <tr>
                                <td>
                                    {!! $i->id !!}
                                </td>
                                <td>
                                    {!! $i->eleve->full_name !!}
                                </td>
                                <td>
                                    {!! $i->eleve->age !!}
                                </td>
                                <td>
                                  {!! $i->date_inscription !!}
                                </td>
                                <td>
                                    {!! $i->eleve->parent->full_name !!} / {!! $i->eleve->parent->par_tel !!}
                                </td>
                                <td class="text-center">
                                    @if ($i->est_solder)
                                        <span class="badge badge-success">Soldé</span>
                                    @else
                                        <strong>{!! $i->reste !!} FCFA</strong>
                                    @endif
                                </td>
                                <td>
                                    @if (!$i->est_solder && Auth::user()->hasRole('comptable'))
                                    <a href="{{ route('eleve.solder.scolarite', ['inscrit' => $i->id, 'eleve' => $i->eleve_id]) }}" class="btn btn-sm btn-success" title="Cliquer pour enregistrer un nouveau paiement de scolarité">
                                        Enregistrer un paiement
                                    </a>
                                    @endif
                                    <a href="{{ route('inscriptions.show', ['id' => $i->id]) }}" class="btn btn-sm btn-info sm-mg-2">Afficher</a>
                                    <a href="{{ route('inscriptions.edit', ['id' => $i->id]) }}" class="btn btn-sm btn-warning">Modifier</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-css')
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap.min.css')}}">
@endsection
@section('custom-js')
    <script src="{{asset('js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready( function () {
            $('#table_eleves').dataTable({
                "language": {
                    "url": "{{asset('lang/French.json')}}"
                },
                "order": [[ 3, "desc" ]]
            });
        } );
    </script>
@endsection
