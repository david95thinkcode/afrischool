@extends('templates.app')
@section('title') Absences @endsection
@section('section-title') Enregistrer une absence @endsection
@section('content')
    <div class='row'>
        <div class="col-sm-5 col-sm-offset-3 col-sm-6 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="x-content">
                        @if (count($mats) == 0)
                            <h5 class="text-center">Impossible de continuer car aucune matière n'est enseignée dans cette classe ce jour.</h5>
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

    <div class="row">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="alert alert-info alert-dismissible text-center" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Il semblerait que vous êtes perdu !</strong> 
                <p>
                    Afin de pouvoir enregistrer des absences, il est obligatoire d'avoir préalablement renseigné entièrement l'emploi du temps.
                </p>
                <p>Renseignez l'emploi du temps en utilisant le bouton ci-dessous</p>
                <p class="text-center">
                    <a href="{!! route('absences.steps.first') !!}" class="btn btn-primary">Ajouter un horaire à l'emploi du temps</a>
                </p>
            </div>
        </div>
    </div>
@endsection
