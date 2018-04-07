@extends('templates.dashboard-dev')
@section('title') Home @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
        <h3>Accueil Dashboard</h3>
        <hr>
        <div class="">
            <ol> Pour nous
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
                <li>Matières
                    <ul>
                        <li><a href="{{ route('matieres.create') }}">Ajouter </a></li>
                        <li><a href="{{ route('matieres.index') }}">Liste </a></li>
                        <li><a href="{{ route('enseigner.create') }}">Attribuer à une classe </a></li>
                        <li><a href="{{ route('matiere.show.classes') }}">Liste des matières par classe </a></li>
                    </ul>
                </li>
                <li>Professeurs
                    <ul>
                        <li><a href="{{ route('professeurs.create') }}">Ajouter </a></li>
                        <li><a href="{{ route('professeurs.index') }}">Liste </a></li>
                    </ul>
                </li>
            </ol>
        </div>

        <div>
            <ul>Utilisable par les écoles
                <li>
                    <a href="{{ route('inscriptions.create') }}">Inscrire un élève </a>
                </li>
                <li>
                    <a href="{{ route('inscriptions.index') }}">Les inscrits </a>
                </li>
                <li>
                    <a href="#">Enregistrer une note </a>
                </li>
            </ul>
        </div>

    </div>

</div>
@endsection
