@extends('templates.dashboard-dev')
@section('title') Inscriptions @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12"> <br>
        <div class="jumbotron text-center">
          <h3 class="sm mb-5">Vous désirez inscrire ...</h3>
          <a href="{{ route('eleves.create', ['type' => 'ancien']) }}" class="btn btn-primary sm mr-3" title='Un ancien élève de votre école'>Un ancien élève</a>
          <a href="{{ route('eleves.create', ['type' => 'nouveau']) }}" class="btn btn-success sm ml-3" title="Un élève provenant d'une autre école">Un nouvel élève</a>
        </div>
    </div>

    <div>

    </div>
</div>
@endsection
