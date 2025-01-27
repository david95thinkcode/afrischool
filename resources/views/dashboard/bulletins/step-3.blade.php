@extends('templates.app') 
@section('title') Bulletin
@endsection 
@section('section-title') 
@endsection
 
@section('content')
<div class="row">
    <div class="col-md-5 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="x-content">
                    <div class="col-md-6"><strong>Classe :</strong> {{session('classe.cla_intitule')}}</div>
                    <div class="col-md-6"><strong>Année scolaire :</strong> {{ session('anneescolaire.an_description') }}</div>
                </div>
            </div>
        </div>
    </div>    
</div>

<div class='row'>
    <div class="col-sm-offset-1 col-sm-9">
        <div class="table-responsive">
            <table class="table table-bordered jambo_table" id="table_list">
                <thead>
                    <tr>
                        <th class="text-center"># Matricule</th>
                        <th class="text-center">Elève</th>
                        <th class="text-center">Bulletin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($eleves as $el)
                        <tr>
                            <td class="text-center">{!! $el->id !!}</td>
                            <td class="text-center">{!! $el->eleve->nom !!} {!! $el->eleve->prenoms !!} </td>
                            <td class="text-center">
                                @foreach ($trimestres as $tr)
                                    <a href="{!! route('bulletin.showbytrimestre', ['trimestre' => $tr->id, 'matricule' => $el->id]) !!}" class="btn btn-info">Trimestre {!! $tr->tri_numero !!}</a>
                                @endforeach

                                {{-- General --}}
                                <a href="{!! route('bulletin.final', ['matricule' => $el->id]) !!}" class="btn btn-primary">Final</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('custom-css')
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap.min.css')}}">
    <style>
        table {
            font-size: medium;
        }

        td {
            vertical-align: middle !important;
        }
        .day {            
            vertical-align: middle !important;
            text-transform: uppercase;
            color: maroon;
        }
    </style>
@endsection
@section('custom-js')
    <script src="{{asset('js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready( function () {
            $('#table_list').dataTable({
                "language": {
                    "url": "{{asset('lang/French.json')}}"
                }
            });
        });
    </script>
@endsection