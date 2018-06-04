@extends('templates.app')
@section('title') Envoie de message @endsection
@section('section-title')Notification aux parents notes de la semaine @endsection
@section('content')
    <div class='row'>
        <div class="col-md-5 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 my-2">
            <div class="panel panel-default mx-auto">
                {!! Form::open(['url' => route('notifier.notes.send'), 'method' => 'POST']) !!}
                <div class="panel-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('date_debut', "Date du début de la semaine") !!}
                            {!! Form::date('date_debut', old('date_debut'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('date_fin', "Date de fin de semaine") !!}
                            {!! Form::date('date_fin', old('date_fin'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-12 col-xs-12 form-group mb-1{{ $errors->has('classe') ? ' has-error' : '' }}">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="classe">
                            Selectionnez la classe
                            <span class="required">*</span>
                        </label>
                        <
                        <select class="col-md-12 col-sm-12 col-xs-12{{ $errors->has('classe') ? ' has-error' : '' }}" id="classe" name="classe">
                            @foreach($classes as $class)
                                <option value="{{$class->id}}">{{$class->cla_intitule}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="panel-footer text-center">
                    <button type="submit" class="btn btn-sm btn-success">
                        Envoyer notes
                    </button>
                </div>
                {!! Form::close() !!}
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
        });
        $('#message').keyup(function () {
            var max = 160;
            var char = $(this).val().length;
            if (char <= max) {
                $('#charNum').text(char + ' (1 sms)');
            }else{
                $('#charNum').text(char + ' (2 sms)');
            }
        });
    </script>
@stop