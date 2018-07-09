@extends('templates.app')
@section('title') Matières enseignées @endsection
@section('section-title') Ajouter une matière à une classe @endsection
@section('content')
    <div class="col-sm-12">
        <div class="x-content">
            {!! Form::open(['action' => ['EnseignerController@store'], 'method' => 'POST']) !!}

            @include('dashboard.enseigner.partials.form-fields')

            {!! Form::close() !!}

        </div>
    </div>
     {{--Modal année scolaire--}}
    <div class="modal fade" id="myAnScolaire" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Ajouter une année scolaire</h4>
                </div>
                {!! Form::open(array('url'=>route('anneescolaire.store'),'method'=>'POST','class'=>'form-horizontal')) !!}

                    <div class="modal-body">

                        <div class="col-md-12 mb-2{{ $errors->has('login') ? ' has-error' : '' }}">
                            <div class="form-group">
                                {!! Form::label('description', "Description année") !!}
                                {!! Form::text('description', old('description'), ['class' => 'form-control', 'placeholder' => 'Ex: 2018-2019', 'required' => '']) !!}
                            </div>
                        </div>

                        <div class="col-md-12 mb-2{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="form-group">
                                {!! Form::label('datedebut', "Date de début") !!}
                                {!! Form::date('datedebut', old('datedebut'), ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-12 mb-2{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="form-group">
                                {!! Form::label('datefin', "Date de fin") !!}
                                {!! Form::date('datefin', old('datefin'), ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Créer l'année</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

     {{--Modal matière--}}
    <div class="modal fade" id="myMatiere" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Ajouter une matière</h4>
                </div>
                {!! Form::open(['action' => ['MatiereController@store'], 'method' => 'POST']) !!}
                    <div class="modal-body">
                        <div class="form-group">
                            {!! Form::label('intitule', 'Titre de la matière') !!}
                            {!! Form::text('intitule', old('intitule'), ['class' => 'form-control', 'required' => '']) !!}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-success">Enregistrer</button>
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
            $('#matiere').select2();
            $('#anneescolaire').select2();
            $('#professeur').select2();
        });
    </script>
@endsection
