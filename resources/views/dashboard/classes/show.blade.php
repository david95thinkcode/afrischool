@extends('templates.app')

@section('title') 
    Details sur la classe
@endsection

@section('section-title') 
    
@endsection

@section('content')
<div class='row'>
    <div class="col-sm-6">
        <div class="panel panel-default mx-auto">
            <div class="panel-heading"><h5>A propos de la classe</h5></div>
            <div class="panel-body"></div>
        </div>
    </div>
    <div class="col-sm-6">
        <matieres-enseigner v-bind:classe={!! $c->id !!}></matieres-enseigner>
    </div>
</div>
<div class="row">
    <div class="col-sm-offset-1 col-sm-10">
        <div class="row">
            <div class="col-sm-12">
                <classe-edt v-bind:classe={!! $c->id !!}></classe-edt>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <eleves-inscrits-list v-bind:classe={!! $c->id !!}></eleves-inscrits-list>
            </div>
        </div>
    </div>
</div>
@endsection