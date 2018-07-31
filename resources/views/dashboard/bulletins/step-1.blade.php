@extends('templates.app')
@section('title') Bulletin de notes @endsection
@section('content')
    <div class='row'>
        <div class="col-md-5 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12 my-7">
            <div class="panel panel-default mx-auto">
                <div class="panel-body">
                    <div class="text-center">
                        <h3 class="mb-1 text-center">Bulletins du ...</h3>
                        <a href="{{ route('bulletin.criteres.get', ['niveau' => 'PRM']) }}"
                           class="btn btn-lg btn-primary">Primaire</a>
                        <a href="{{ route('bulletin.criteres.get', ['niveau' => 'CLG']) }}"
                           class="btn btn-lg btn-success"
                           title="Un élève provenant d'une autre école">College</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
