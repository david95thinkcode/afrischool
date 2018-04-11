@extends('templates.app')
@section('title') Diplômes @endsection
@section('section-title') Modifier un diplôme @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">        
        <div class="">
            {!! Form::model($diplome, ['action' => ['DiplomeController@update', $diplome->id], 'method' => 'PUT']) !!}
                
                @include('dashboard.diplomes.partials.form-fields')
                  
            {!! Form::close() !!}
            
        </div>
    </div>

    <div>

    </div>
</div>
@endsection
