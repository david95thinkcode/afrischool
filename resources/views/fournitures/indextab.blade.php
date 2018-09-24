@extends('templates.app')
@section('title') Fournitures @endsection
@section('section-title') Liste des fournitures !@endsection

@section('content')
    <div class='row'>
        <div class="col-sm-offset-1 col-sm-9">
            <table id="table_fourniture" class="table table-bordered table-condensed" >
                <thead>
                <tr>
                    <th>#</th>
                    <th>Classe</th>
                    <th>Fourniture</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($fournitures as $f)
                    <tr>
                        <td class="text-center">{!! $loop->iteration !!}</td>
                        <td>{!! $f->classe->cla_intitule !!} </td>
                        <td>{!! $f->libelle !!}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4"class="text-center"> Aucune fourniture enregistrée pour le moment</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
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
            $('#table_fourniture').dataTable({
                "language": {
                    "url": "{{asset('lang/French.json')}}"
                }
            });
        } );
    </script>
@endsection