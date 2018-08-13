@extends('templates.app') 
@section('title') Absences @endsection
 
@section('section-title') Chercher les absences à date @endsection
 
@section('content')
<div class='row'>
    <div class="col-md-5 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
        <div class="panel panel-default mx-auto">
            <div class="panel-body">
                <div class="x-content">
                    {!! Form::open(['action' => ['AbsenceController@show'], 'method' => 'POST']) !!}
                    
                    <div class="col-md-12 col-xs-12 form-group">
                        <div class="row">
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
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group mb-1{{ $errors->has('date') ? ' has-error' : '' }}">
                                <label class="control-label col-md-12 col-sm-12 col-xs-12" for="date">
                                    Séletionnez la date
                                    <span class="required">*</span>
                                </label>
                                {!! Form::date('date', \Carbon\Carbon::now(), ['class' => 'form-control', 'required' => '']) !!}
                            </div>
                            {{--  heure début  --}}
                            <div class="col-md-3 col-xs-12 form-group">
                                {!! Form::label('from_time', 'Heure debut') !!}
                                {!! Form::time('from_time', '06:00', ['class' => 'form-control', 'required' => '']) !!}
                            </div>
                            {{--  heure fin  --}}
                            <div class="col-md-3 col-xs-12 form-group">
                                {!! Form::label('to_time', 'Heure fin') !!}
                                {!! Form::time('to_time', '20:00', ['class' => 'form-control', 'required' => '']) !!}
                            </div>
                        </div>

                    </div>

                    <div class='col-md-12 text-center mt-1'>
                        {{ Form::submit("Afficher les absents", ['class' => 'btn btn-success col-md-6 col-md-offset-3']) }}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-css')
    <style>
        span.required {
            font-size: small !important;
        }
    </style>    
@endsection