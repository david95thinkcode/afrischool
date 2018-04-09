@extends('templates.dashboard-dev')
@section('title') Diplôme @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
        
        <div class="jumbotron">
            <div>
                <h3 class='text-center'>Ajouter diplôme</h3>
            </div> <hr>
            
            {!! Form::open(['action' => ['DiplomeController@store'], 'method' => 'POST']) !!}
                @include('dashboard.diplomes.partials.form-fields')
                <div class="form-group invisible">
                    {!! Form::text('professeur', $prof->id, ['class' => 'form-control']) !!}
                </div>

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
