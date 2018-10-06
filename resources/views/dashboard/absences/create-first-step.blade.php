@extends('templates.app')
@section('title') Absences @endsection
@section('section-title') Enregistrer une absence @endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <absence-create></absence-create>
    </div>
</div>

<div class='row'>    
    <div class="col-sm-5 col-sm-offset-3 col-sm-6 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="x-content">
                        {!! Form::open(['route' => ['absences.steps.second'], 'method' => 'POST']) !!}
                        
                        <div class="col-md-12 form-group mb-1{{ $errors->has('anneeScolaire') ? ' has-error' : '' }}">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12" for="anneeScolaire">
                                Selectionnez l'année scolaire
                                <span class="required">*</span>
                            </label>
                            <select class="col-md-12 col-sm-12 col-xs-12" id="anneeScolaire" name="anneeScolaire">
                                @foreach($anneeScolaires as $anneeScolaire)
                                    <option value="{{$anneeScolaire->id}}">{{$anneeScolaire->an_description}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6 form-group mb-1{{ $errors->has('classe') ? ' has-error' : '' }}">
                                <label for="classe">
                                    Selectionnez la classe
                                    <span class="required">*</span>
                                </label>
                                <select class="form-control" id="classe" name="classe">
                                    @foreach($classes as $class)
                                        <option value="{{$class->id}}">{{$class->cla_intitule}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-6 form-group mb-1{{ $errors->has('date') ? ' has-error' : '' }}">
                                <label for="date">
                                    Sélectionnez la date
                                    <span class="required">*</span>
                                </label>
                                {!! Form::date('date', \Carbon\Carbon::now(), ['class' => 'form-control', 'required' => '']) !!}
                            </div>
                        </div>
                        <div class="col-md-6 col-md-offset-4">
                            <input type="submit" class="btn btn-success" value="Continuer">
                        </div>
                        {!! Form::close() !!}
                    </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Attention!</strong> 
                Si aucune matière n'est enseignée dans la classe que vous allez sélectionner,
                vous ne pourrez pas enregistrer une absence.
                <p>Dans cette situation, assurez-vous que des matières ont été associées à cette classe avant de revenir ici pour enregistrer une absence.</p>
            </div>
        </div>
    </div>
@endsection

@section('custom-css')
    
@endsection
@section('custom-js')
   
@endsection
