@extends('templates.app')
@section('title') Scolarité @endsection
@section('section-title') Liste des élève ayant à solder @endsection
@section('content')
    <div class="col-sm-12">
        <div class="x-content">
            <table id="eleves" class="table table-bordered jambo_table">
                <thead>
                <tr>
                    <th>N°</th>
                    <th>Nom prénom(s)</th>
                    <th>Téléphone parent</th>
                    <th>Scolarité</th>
                    <th>Reste à solder</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @php $i = 0; @endphp
                    @forelse($debiteurs as $debiteur)
                    @php $i++; @endphp
                    <tr>
                        <td class="text-center">{{$i}}</td>
                        <td>
                            {{$debiteur->eleve->prenoms}} {{$debiteur->eleve->nom}}
                        </td>
                        <td>{{$debiteur->eleve->parents->par_tel}}</td>
                        <td>{{$debiteur->montant_scolarite}} <strong>fcfa</strong></td>
                        <td>{{$debiteur->reste}} <strong>fcfa</strong></td>
                        <td class="text-center">
                            <a href="{{route('eleve.solder.scolarite', [$debiteur->id, $debiteur->eleve->id])}}" class="btn btn-xs btn-success">
                                Solder scolarité
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr class="text-center my-5 py-5">
                        Pas de scolarité non soldé
                    </tr>
                @endforelse
                </tbody>
            </table>
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
        $(document).ready(function() {
            $('#eleves').dataTable({
                "language": {
                    "url": "{{asset('lang/French.json')}}"
                }
            });
        } );
    </script>
@endsection