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
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center"># Matricule</th>
                        <th class="text-center">Elève</th>
                        <th class="text-center">Bulletin du</th>
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
                            </td>
                        </tr>
                    @endforeach

                    {{-- @foreach ($horairesByDay as $jour => $horaires)
                    
                        @if ($horaires->count() > 0)
                            @foreach ($horaires as $h => $itemValue)
                                <tr>
                                    @if ($loop->first)                                    
                                        <th rowspan="{{$horaires->count()}}" class="day">{{$jour}}</th>
                                    @endif
                                    <td class="text-center"><strong>{{$itemValue->debut}} - {{$itemValue->fin}}</strong></td>
                                    <td class="text-center">{{$itemValue->intitule}}</td>
                                    <td class="text-center">{{$itemValue->prof_nom}} {{$itemValue->prof_prenoms}}</td>
                                    <td class="text-center">
                                        <form action="{{ route('horaire.destroy', $itemValue->horaire_id) }}" method="POST" class='table-del-btn'>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        {!! Form::submit('Retirer du programme', array('class' => 'btn btn-warning')) !!}
                                        </form>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <th rowspan="1">{{$jour}}</th>
                                <th class="text-center"> - </th>
                                <td class="text-center"> - </td>
                                <td class="text-center"> - </td>
                                <td class="text-center"> - </td>
                            </tr>
                        @endif
                       
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
 @fore
@section('custom-css')
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