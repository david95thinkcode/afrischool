@extends('templates.app')

@section('title') 
    Details sur la classe
@endsection

@section('section-title') 
    
@endsection

@section('content')
<div class='row '>
    <div class="col-sm-offset-4 col-sm-4">
        <div class="panel panel-default mx-auto">
            <div class="panel-heading"><h5>A propos de la classe</h5></div>
            <table class="table table-responsive">
                <tbody>
                    <tr>
                        <td>Nom de la classe</td>
                        <th>{!! $c->cla_intitule !!}</th>
                    </tr>
                    <tr>
                        <td>Niveau classe</td>
                        <th>{!! ($c->estPrimaire) ? "Primaire" : "Secondaire" !!}</th>
                    </tr>
                    <tr>
                        <td>Montant  scolarité</td>
                        <th>{!! $c->mt_scolarite !!} Francs CFA</th>
                    </tr>
                    <tr>
                        <td>Description </td>
                        <th>{!! $c->cla_description !!}</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <ul class="col-sm-2 nav nav-pills nav-stacked">
        <li role="presentation" class="active">
            <a data-toggle="tab" href="#eleves">
                <span class="fa fa-users"></span> Elèves
            </a>
        </li>
        <li role="presentation">
            <a data-toggle="tab" href="#matieres">
                <span class="fa fa-book"></span> Matières
            </a>
        </li>
        <li role="presentation">
            <a data-toggle="tab" href="#emploi-du-temps">
                <span class="fa fa-calendar"></span> Emploi du temps
            </a>
        </li>
        <li role="presentation">
            <a data-toggle="tab" href="#fournitures">
                <span class="fa fa-cut"></span> Fournitures
            </a>
        </li>
    </ul>
    <div class="col-sm-10 tab-content">
        <div class="tab-pane" id='matieres'>
            <matieres-enseigner v-bind:classe={!! $c->id !!}></matieres-enseigner>
        </div>
        <div class="tab-pane" id='emploi-du-temps'>
            <div class="row">
                <div class="col-sm-12">
                    <classe-edt v-bind:classe={!! $c->id !!}></classe-edt>
                </div>
            </div>
        </div>
        <div class="tab-pane active" id='eleves'>
            <eleves-inscrits-list v-bind:classe={!! $c->id !!}></eleves-inscrits-list>
        </div>
        <div class="tab-pane" id='fournitures'>
            <div class="panel panel-primary">
                <div class="panel-heading"><h5>Les fournitures</h5></div>
                <div class="panel-body">
                    {{-- <div class="well"> --}}
                        @if (!is_null($fournitures))
                        <h2>
                            {!! $fournitures->libelle !!}
                        </h2>                                
                        @else
                            <h2>Aucune fourniture</h2>
                        @endif
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-js')
{{-- <script>
    let show = new Vue({
        el: 
    })

</script> --}}
@endsection

@section('custom-css')
    <style>
        .row {
            font-size: initial;
        }
    </style>
@endsection