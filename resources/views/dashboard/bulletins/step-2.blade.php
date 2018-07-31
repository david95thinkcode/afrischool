@extends('templates.app')
@section('title') Bulletin de notes @endsection
@section('section-title') Générer bulletins @endsection
@section('content')
    <div class='row'>
        <div class="col-md-5 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="x-content">
                        {!! Form::open(['route' => ['bulletin.criteres.post'], 'method' => 'POST']) !!}
                        <div class="col-md-12 form-group mb-1{{ $errors->has('classe') ? ' has-error' : '' }}">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12" for="classe">
                                Selectionnez la classe
                                <span class="required">*</span>
                            </label>
                            <select class="col-md-12 col-sm-12 col-xs-12" id="classe" name="classe">
                                @foreach($classes as $class)
                                    <option value="{{$class->id}}">{{$class->cla_intitule}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 form-group mb-1{{ $errors->has('anneeScolaire') ? ' has-error' : '' }}">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12" for="anneeScolaire">
                                Selectionnez l'année scolaire
                                <span class="required">*</span>
                            </label>
                            <select class="col-md-12 col-sm-12 col-xs-12" id="anneeScolaire" name="anneeScolaire">
                                @foreach($years as $anneeScolaire)
                                    <option value="{{$anneeScolaire->id}}">{{$anneeScolaire->an_description}}</option>
                                @endforeach
                            </select>
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
@endsection

@section('custom-css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css"
          rel="stylesheet"/>
@endsection
@section('custom-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#classe').select2();
            $('#anneeScolaire').select2();
        });
    </script>
@endsection
