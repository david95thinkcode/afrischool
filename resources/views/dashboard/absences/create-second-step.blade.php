@extends('templates.app')
@section('title') Absences @endsection
@section('section-title') Enregistrer une absence @endsection
@section('content')
    <div class='row'>
        <div class="col-md-5 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="x-content">
                        @if (count($mats) == 0)
                            <h2>Aucune métière n'est enseignée ce jour dans cette classe.</h2>
                        @else                        
                        {!! Form::open(['route' => ['absences.steps.last'], 'method' => 'POST']) !!}                        
                            @foreach ($mats as $m)
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        {!! Form::radio('enseignerID', $m->id, ['class' => 'form-control', 'required' => '']) !!} {!! $m->matiere->intitule !!}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                            
                            <div class="col-md-6 col-md-offset-4">
                                <input type="submit" class="btn btn-success" value="Continuer">
                            </div>
                        {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-css')
    
@endsection
@section('custom-js')
   
@endsection
