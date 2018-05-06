@extends('templates.app')
@section('title') Saisie des notes @endsection
@section('section-title')Matière et type d'évaluation @endsection
@section('content')
    <div class='row'>
        <div class="col-md-5 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! Form::open(['route' => ['notes.classe.fird'], 'method' => 'POST']) !!}
                    <div class="x-content">
                        <div class="col-md-12 form-group{{ $errors->has('matiere') ? ' has-error' : '' }}">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12" for="matiere">
                                La matière
                                <span class="required">*</span>
                            </label>
                            <select class="col-md-12 col-sm-12 col-xs-12" id="matiere" name="matiere" required>
                                <option value="">Selectionnez matière</option>
                                @foreach($matieres as $matiere)
                                    <option value="{{$matiere->matiere->id}}">{{$matiere->matiere->intitule}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 form-group{{ $errors->has('typeEv') ? ' has-error' : '' }}">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12" for="typeEv">
                                Le type d'evaluation
                                <span class="required">*</span>
                            </label>
                            <select class="col-md-12 col-sm-12 col-xs-12" id="typeEv" name="typeEv" required>
                                <option value="">Selectionnez type d'evaluation</option>
                                @foreach($typeEv as $typeEv)
                                    <option value="{{$typeEv->id}}">{{$typeEv->tev_libelle}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 col-md-offset-2"><strong>Classe :</strong> {{session('classe')}}</div>
                        <div class="col-md-4 col-md-offset-2"><strong>Trimestre :</strong> {{session('trimestre')}}</div>
                        <div class="col-md-6 col-md-offset-4">
                            <input type="submit" class="btn btn-success" value="Continuer">
                        </div>
                    </div>
                    {!! Form::close() !!}
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
            $('#matiere').select2();
            $('#typeEv').select2();
        });
    </script>
@endsection