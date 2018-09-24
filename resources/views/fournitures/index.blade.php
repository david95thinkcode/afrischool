@extends('templates.parent-dashboard-style')

@section('title')
    Fournitures
@endsection

@section('main-descriptive-text')
    Saisir la classe dans le champ <strong>Rechercher</strong> pour filtrer les résultats
@endsection

@section('main-title')
    Les founitures
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto justify-content-center">
                <table id="liste" class="table table-bordered table-condensed" >
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
    </div>

@endsection

@section('custom-css')
    {!! Html::style('css/dataTables.bootstrap4.min.css') !!}
@stop

@section('custom-js')
    {!! Html::script('js/jquery.dataTables.min.js') !!}
    {!! Html::script('js/dataTables.bootstrap4.min.js') !!}
    <script>
        $(document).ready(function() {
            $('#liste').DataTable({
                "language": {
                    "url": "{{asset('lang/French.json')}}"
                }
            });
        });
    </script>
@stop