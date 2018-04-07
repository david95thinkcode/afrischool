@extends('templates.dashboard-dev')
@section('title') Professeurs @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">

        <div class="jumbotron">
            <div>
                <h3 class='text-center'>Inscrire un professeur</h3>
            </div> <hr>

            {!! Form::open(['action' => ['ProfesseurController@store'], 'method' => 'POST']) !!}
                <div class="form-group">
                     <div class='row'>
                        <div class="col">
                            <div class="form-group">
                                {!! Form::label('nom', "Nom du professeur") !!}
                                {!! Form::text('nom', old('nom'), ['class' => 'form-control', 'required' => '']) !!}
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                {!! Form::label('prenoms', "Prénom(s) du professeur") !!}
                                {!! Form::text('prenoms', old('prenoms'), ['class' => 'form-control', 'required' => '']) !!}
                            </div>
                        </div>
                     </div>
                     <div class='row'>
                       <div class="col">
                           <div class="form-group">
                               {!! Form::label('nationalite', "Nationalité") !!}
                               <select class="form-control" name="nationalite" id='nationalite' value="{{ old('nationalite') }}" required>
                                   <option value=""></option>
                               </select>
                           </div>
                       </div>
                       <div class="col">
                           <div class="form-group">
                               {!! Form::label('date_naissance', "Date de naissance") !!}
                               {!! Form::date('date_naissance', old('date_naissance'), ['class' => 'form-control']) !!}
                           </div>
                       </div>
                        <div class="col">
                            <div class="form-group">
                                {!! Form::label('sexe', "Sexe") !!}
                                <select name="sexe" id='sexe' class="form-control">
                                  @include('partials.sexe-options')
                                </select>
                            </div>
                        </div>
                     </div>
                     <div class="row">
                       <div class="col">
                         <div class="form-group">
                             {!! Form::label('tel', 'Téléphone') !!}
                             {!! Form::tel('tel', old('tel'), ['class' => 'form-control', 'required' => '']) !!}
                         </div>
                       </div>
                       <div class="col">
                         <div class="form-group">
                             {!! Form::label('email', 'Email') !!}
                             {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                         </div> <br>
                       </div>
                     </div>
                </div>

                <div class='form-group text-center'>
                    {{ Form::submit("Enregistrer", array('class' => 'btn btn-primary ')) }}
                </div>
            {!! Form::close() !!}

        </div>
    </div>

    <div>

    </div>
</div>
@endsection

@section('custom-js')
    {!! Html::script('js/professeurs/fields.js') !!}
@endsection
