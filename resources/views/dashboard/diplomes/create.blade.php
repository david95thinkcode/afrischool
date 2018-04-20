@extends('templates.app')
@section('title') Diplômes @endsection
@section('section-title') Ajouter un diplôme @endsection
@section('content')
<div class='row'>
    <div class="col-md-5 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
        <div class='panel panel-default mx-auto'>
            <div class="panel-body">
        
                <div class="">
                    {!! Form::open(['action' => ['DiplomeController@store'], 'method' => 'POST']) !!}
                        @include('dashboard.diplomes.partials.form-fields')
                        
                        <div class="form-group invisible">
                            {!! Form::text('professeur', $prof->id, ['class' => 'form-control']) !!}
                        </div>
                        
                    {!! Form::close() !!}            
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
