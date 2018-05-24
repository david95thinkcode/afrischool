@extends('templates.app')
@section('title') Emploi du temps @endsection
@section('section-title')
    Emploi du temps de {{ $c->cla_intitule }}
@endsection
@section('content')
<div class='row'>
    <div class="col-sm-offset-1 col-sm-9">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <th>Jour</th>
                    <th>Programmes</th>
                </thead>
                <tbody>
                @foreach ($horairesByDay as $jour => $horaires)
                    <tr>
                        <td>{{$jour}}</td>
                        <td>
                            <ul>
                                @foreach ($horaires as $h => $itemValue)
                                    <li>
                                        {{$itemValue->debut}} - {{$itemValue->fin}} : {{$itemValue->intitule}} - {{$itemValue->prof_nom}} {{$itemValue->prof_prenoms}}
                                    </li>
                                @endforeach                                
                            </ul>
                        </td>                                 
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
