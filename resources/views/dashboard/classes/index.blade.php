@extends('templates.app')
@section('title') Les classes @endsection
@section('section-title') Liste des classes @endsection
@section('content')
<div class='row'>
    <a href="{!! route('classe.list', ['niveau' => 'PRM']) !!}" title='Cliquez pour voir la liste complète'>
        <div class="animated flipInY col-sm-offset-2 col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="tile-stats bg-green">
                <div class="count">{!! $numberOfClasses['PRM'] !!}</div>
                <h3>Primaire</h3>
            </div>
        </div>
    </a>

    <a href="{!! route('classe.list', ['niveau' => 'CLG']) !!}" title='Cliquez pour voir la liste complète'>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="tile-stats bg-green">
                <div class="count">{!! $numberOfClasses['CLG'] !!}</div>
                <h3>Collège</h3>
            </div>
        </div>
    </a>

    <a href="{!! route('classe.list', ['niveau' => 'UNV']) !!}" title='Cliquez pour voir la liste complète'>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="tile-stats bg-green">
                <div class="count">{!! $numberOfClasses['UNV'] !!}</div>
                <h3>Université</h3>
            </div>
        </div>
    </a>
</div>
@endsection
