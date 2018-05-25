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
                                    <strong> {{$itemValue->debut}} - {{$itemValue->fin}} : </strong> {{$itemValue->intitule}}
                                    - {{$itemValue->prof_nom}} {{$itemValue->prof_prenoms}}
                                </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
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
</style>
@endsection