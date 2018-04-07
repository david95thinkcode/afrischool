@extends('templates.dashboard-dev')
@section('title') {{ $p->prof_prenoms }} {{ $p->prof_nom }} @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
        {{ dd($p) }}
    </div>
</div>
@endsection

@section('custom-js')
    {!! Html::script('js/professeurs/fields.js') !!}
@endsection
