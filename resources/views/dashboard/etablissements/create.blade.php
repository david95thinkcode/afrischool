@extends('templates.app')
@section('title') Etablissements @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
        
        <div class="jumbotron">
            <div>
                <h3 class='text-center'>Inscrire un établissement</h3>
            </div> <hr>
            
            {!! Form::open(['action' => ['EtablissementController@store'], 'method' => 'POST']) !!}
                <div class="form-group">
                    {!! Form::label('raison_sociale', 'Nom de l\'établissement') !!} 
                    {!! Form::text('raison_sociale', old('raison_sociale'), ['class' => 'form-control', 'required' => '']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('sigle', "Sigle de l'établissement (diminutif du nom)") !!} 
                    {!! Form::text('sigle', old('sigle'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('categorie_ets', "Catégorie de l'établissement") !!} 
                    <select class="form-control" name="categorie_ets" id="categorie_ets" value="{{ old('categorie_ets') }}" required>
                        <option value="">Sélectionnez une catégorie</option>
                        @foreach($categories as $c)
                            <option value="{{ $c->id }}">{{ $c->libelle }}</option>
                        @endforeach
                    </select>                    
                </div>
                
                <div class="form-group">
                    {!! Form::label('directeur', "Nom du directeur de l'établissement") !!} 
                    {!! Form::text('directeur', old('directeur'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('tel', 'Téléphone') !!} 
                    {!! Form::tel('tel', old('tel'), ['class' => 'form-control', 'required' => '']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('site_web', "Site web de l'établissement") !!} 
                    {!! Form::text('site_web', old('site_web'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'Email') !!} 
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('pays', 'Pays') !!} 
                    <select class="form-control" name="pays" id='pays' value="{{ old('pays') }}" required>
                        <option value=""></option>
                    </select>
                </div>
                <div class="form-group">
                    {!! Form::label('ville', 'Ville') !!} 
                    {!! Form::text('ville', old('ville'), ['class' => 'form-control', 'required' => '']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('quartier', 'Quartier') !!} 
                    {!! Form::text('quartier', old('quartier'), ['class' => 'form-control']) !!}
                </div> <br>
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
    {!! Html::script('js/etablissements/fields.js') !!}
@endsection