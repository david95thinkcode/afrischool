@extends('templates.app')
@section('title') Personnel @endsection
@section('section-title') Ajouter un membre du personnel @endsection
@section('content')
    <div class='row'>
        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 my-2">
            <div class="panel panel-default mx-auto">
                {!! Form::open(['url' => route('personnel.store'), 'method' => 'POST']) !!}
                <div class="panel-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('name', "Nom et Prénom(s)") !!}
                            {!! Form::text('name', old('name'), ['class' => 'form-control', 'required' => '']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('email', "Adresse email") !!}
                            {!! Form::email('email', old('email'), ['class' => 'form-control', 'required' => '']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('pwd', "Mot de passe") !!}
                            {!! Form::password('pwd', ['class' => 'form-control', 'required' => '']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('pwd_confirmation', "Répéter le mot de passe") !!}
                            {!! Form::password('pwd_confirmation', ['class' => 'form-control', 'required' => '']) !!}
                        </div>
                    </div>
                    <div class="col-md-12 col-xs-12 form-group mb-1{{ $errors->has('role') ? ' has-error' : '' }}">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="classe">Selectionnez son role
                            <span class="required">*</span>
                        </label>
                        <select class="col-md-12 col-sm-12 col-xs-12{{ $errors->has('role') ? ' has-error' : '' }}" id="role" name="role">
                            @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="panel-footer text-center">
                    <button type="submit" class="btn btn-sm btn-success">
                        Enregistrer cet utilisateur
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
            $('#role').select2();
        });
    </script>
@stop