@extends('templates.dashboard-dev')
@section('title') Home @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
        <h3>Accueil Dashboard</h3>
<hr>
        <div class="">
            <ol>
                <li>Etablissements
                    <ul>
                        <li><a href="{{ route('etablissements.create') }}">Ajouter </a></li>
                        <li><a href="{{ route('etablissements.index') }}">Liste </a></li>
                    </ul>
                </li>
                <li>Classes
                    <ul>
                        <li><a href="{{ route('classe.create') }}">Ajouter </a></li>
                        <li><a href="{{ route('classe.index') }}">Liste </a></li>
                    </ul>
                </li>
                <li>Professeur
                    <ul>
                        <li><a href="{{ route('etablissements.create') }}">Ajouter </a></li>
                        <li><a href="{{ route('etablissements.index') }}">Liste </a></li>
                    </ul>
                </li>
                <li><a href="#">Ajouter une note</a></li>
                <li></li>
            </ol>
        </div>
    </div>

</div>
@endsection