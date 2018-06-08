@extends('templates.app')
@section('title') Elèves @endsection
@section('section-title') Choisissez l'élève a inscrire @endsection
@section('content')
    <div class="col-sm-12">
        <div class="x-content">
            <table id="anciens" class="table table-bordered jambo_table">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nom prénom(s)</th>
                        <th>Sexe</th>
                        <th>Date de naissance</th>
                        <th>parent</th>
                        <th>Téléphone parent</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 0;@endphp
                    @forelse($anciens as $ancien)
                        @php $i++ @endphp
                        <tr>
                            <td class="text-center">{{$i}}</td>
                            <td class="text-center">
                                {{$ancien->prenoms}} {{$ancien->nom}}
                            </td>
                            <td class="text-center">{{$ancien->sexe}}</td>
                            <td class="text-center">{{\Carbon\Carbon::parse($ancien->date_naissance)->format('d/m/Y')}}</td>
                            <td class="text-center">{{$ancien->parents->par_nom}} {{$ancien->parents->par_prenoms}}</td>
                            <td class="text-center">{{$ancien->parents->par_tel}}</td>
                            <td class="text-center">
                                <a href="{{route('reinscription.index', $ancien->id)}}" class="btn btn-xs btn-success">
                                    Réincrire
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center my-5 py-5">
                            Pas d'anciens élèves enregistrés
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
            $('#anciens').dataTable({
                "language": {
                    "url": "{{asset('lang/French.json')}}"
                }
            });
        } );
    </script>
@endsection