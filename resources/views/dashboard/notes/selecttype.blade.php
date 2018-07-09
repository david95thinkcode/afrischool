@extends('templates.app')
@section('title') Inscriptions @endsection
@section('content')
    <div class='row'>
        <div class="col-md-5 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12 my-7">
            <div class="panel panel-default mx-auto">
                <div class="panel-body">
                    <div class="text-center">
                        <h3 class="mb-1 text-center">Vous désirez gérer ...</h3>
                        <a href="{{ route('notes.create.college') }}"
                           class="btn btn-lg btn-primary">Le Collège</a>
                        <a href="{{ route('notes.create.primaire') }}"
                           class="btn btn-lg btn-success"
                           title="Un élève provenant d'une autre école">Le primaire</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection