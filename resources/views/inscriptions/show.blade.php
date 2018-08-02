@extends('templates.app')
@section('title') Inscriptions @endsection
@section('section-title') Les élèves inscrits en {{ $inscriptions[0]->classe->cla_intitule }} @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
        <div>
            <div class="table-responsive">
                <table class="table table-bordered jambo_table" id="table_eleves">
                    <thead>
                        <th>#</th>
                        <th>Elève</th>
                        <th>Classe</th>
                        <th>Age</th>
                        <th>Inscrit le</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($inscriptions as $i)
                            <tr>
                                <td>
                                    {!! $i->id !!}
                                </td>
                                <td>
                                    {!! $i->eleve->nom !!} {!! $i->eleve->prenoms !!}
                                </td>
                                <td>
                                    {!! $i->classe->cla_intitule !!}
                                </td>
                                <td>
                                    {!! date('Y') - date('Y', strtotime($i->eleve->date_naissance)) !!} ans
                                </td>
                                <td>
                                  {!! $i->date_inscription !!}
                                </td>
                                <td>
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
