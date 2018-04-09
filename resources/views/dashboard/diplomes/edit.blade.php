@extends('templates.dashboard-dev')
@section('title') Diplômes @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
        
        <div class="jumbotron">
            <div>
                <h3 class='text-center'>Ajouter diplôme</h3>
            </div> <hr>
            
            {!! Form::model($diplome, ['action' => ['DiplomeController@update', $diplome->id], 'method' => 'PUT']) !!}
                
                @include('dashboard.diplomes.partials.form-fields')

                 <br>
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
