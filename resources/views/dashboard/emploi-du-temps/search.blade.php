@extends('templates.app')
@section('title') Emploi du temps @endsection
@section('section-title') Consulter un emploi de temps @endsection
@section('content')
    <div class='row'>
        <div class="col-md-5 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="x-content">
                        {!! Form::open(['route' => ['emploi-du-temps.search.go'], 'method' => 'POST']) !!}
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
