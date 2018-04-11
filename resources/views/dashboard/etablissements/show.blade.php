@extends('templates.app')
@section('title') Détails sur {{ $ecole->sigle }} @endsection
@section('content')
<div class='row'>
    <div class="col">
        <h3>{{ $ecole->raison_sociale }}</h3>

        {{ dd($ecole) }}
    </div>
</div>
@endsection
