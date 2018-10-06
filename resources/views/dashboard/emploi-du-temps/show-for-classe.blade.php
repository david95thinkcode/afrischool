@extends('templates.app') 
@section('title') Emploi du temps
@endsection
 
@section('section-title') Emploi du temps de : <strong>{{ $c->cla_intitule }}</strong>
@endsection
 
@section('content')
<div class='row'>
    <div class="col-sm-offset-1 col-sm-9">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Jour</th>
                        <th class="text-center">Horaire</th>
                        <th class="text-center">Matière</th>
                        <th class="text-center">Enseignant</th>
                        <th class="text-center">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($horairesByDay as $jour => $horaires)
                    
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
                       
                    @endforeach
                </tbody>
            </table>
        </div>

        <div>
            {!! Form::open(['route' => ['horaire.second-step.go'], 'method' => 'POST']) !!}
                {!! Form::hidden('classe', $c->id, ['class' => 'form-control', 'required' => '']) !!}                
                <div class='form-group text-center'>
                    {{ Form::submit("Ajouter un programme à l'emploi du temps", array('class' => 'btn btn-primary ')) }}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

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