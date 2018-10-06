@extends('templates.app')
@section('title') Scolarité @endsection
@section('section-title') Liste des insoldés @endsection
@section('content')
<div class="col-sm-12">
    
    <div class="row">
        <div class="col-sm-offset-4 col-sm-4">
            {!! Form::open(['route' => ['scolarite.search.insolder'], 'class' => '', 'method' => 'POST']) !!}
            <div class="form-group">
                {!! Form::label('classe', 'Classe') !!}
                <select class="form-control" name="classe" id='classe' required>
                    <option value="">-- Sélectionner --</option>
                    @foreach ($classes as $key => $c)
                    <option value="{!! $c->id !!}">{!! $c->cla_intitule !!}</option>
                    @endforeach
                </select>
            </div>            
            <div class="form-group">
                {{ Form::submit("Afficher", array('class' => 'btn btn-block btn-success')) }}
            </div>
            {!! Form::close() !!}
            <br>
        </div>
    </div>
</div>
@endsection

@section('custom-css')
<link rel="stylesheet" href="{{asset('css/dataTables.bootstrap.min.css')}}">
@stop

@section('custom-js')
<script src="{{asset('js/jquery.dataTables.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#eleves').dataTable({
            "language": {
                "url": "{{asset('lang/French.json')}}"
            }
        });
    });
</script>
@endsection