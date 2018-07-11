@extends('templates.app')
@section('title') Elèves @endsection
@section('section-title') Choisissez l'élève a inscrire @endsection
@section('content')
    <div class="col-sm-12">
        <div class="x-content">
            <table id="anciens" class="table table-bordered jambo_table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom prénom(s)</th>
                        <th>Sexe</th>
                        <th>Date de naissance</th>
                        <th>parent</th>
                        <th>Téléphone parent</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($anciens as $ancien)
                        <tr>
                            <td class="text-center">{{$ancien->id}}</td>
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
                    @endforeach
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