@extends('templates.parent-dashboard-style')

@section('title')
    Enfants
@endsection

@section('main-descriptive-text')
    Enfant : {!! $enfant->full_name !!}
    <nav class="nav nav-pills mb-3 nav-fill" id='pills-tab' role='tablist'>
        <a class="nav-item nav-link active" id="notes-tab" data-toggle="pill" href="#notes" role="tab" aria-controls="notes" aria-selected="true">Les notes</a>
        <a class="nav-item nav-link" id="scolarite-tab" data-toggle="pill" href="#scolarite" role="tab" aria-controls="scolarite" aria-selected="false">Scolarité</a>
        <a class="nav-item nav-link" id="absences-tab" data-toggle="pill" href="#absences" role="tab" aria-controls="absences" aria-selected="false">Les absences</a>
    </nav>
@endsection

@section('main-title')
  Les notes
@endsection

@section('content')
    <div class="container">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="notes" role="tabpanel" aria-labelledby="notes-tab">@include('parents-dashboard.notes')</div>
            <div class="tab-pane fade" id="scolarite" role="tabpanel" aria-labelledby="scolarite-tab">@include('parents-dashboard.scolarite')</div>
            <div class="tab-pane fade" id="absences" role="tabpanel" aria-labelledby="absences-tab">@include('parents-dashboard.absences')</div>
        </div>
    </div>
@endsection

@section('custom-css')
    <style>
        .card-body {
            padding: 0px;
        }
    </style>
@endsection

@section('custom-js')
    <script>
        $('document').ready(function () {
            var _title = $('.main-title');
            $('#pills-tab a').on('click', function (e) {
                _title.text($(this).text());
            });
            
        })
    </script>
@endsection