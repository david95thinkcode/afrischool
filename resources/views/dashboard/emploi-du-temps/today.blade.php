@extends('templates.app') 
@section('title') Emploi du temps
@endsection
 
@section('section-title') Aujourdh'hui
@endsection
 
@section('content')
<div class='row'>
    <div class="col-sm-offset-1 col-sm-10">
        <edt-today></edt-today>
    </div>
</div>
@endsection

@section('custom-css')

@endsection