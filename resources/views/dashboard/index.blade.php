@extends('templates.dashboard-dev')
@section('title') Home @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
        <h3>Accueil Dashboard</h3>
        <hr>
        <div class="">
            <ol> Pour nous
                <li>Niveaux
                    <ul>
                        <li><a href="{{ route('niveaux.create') }}">Ajouter </a></li>
                        <li><a href="{{ route('niveaux.index') }}">Liste </a></li>
                    </ul>
                </li>
                <li>Etablissements
                    <ul>
                        <li><a href="{{ route('etablissements.create') }}">Ajouter </a></li>
                        <li><a href="{{ route('etablissements.index') }}">Liste </a></li>
                    </ul>
                </li>

            </ol>
        </div>

        <div>
            <ul><span class="badge badge-primary">Utilisable par les écoles</span>
                <li>Classes
                    <ul>
                        <li><a href="{{ route('classe.create') }}">Ajouter </a></li>
                        <li><a href="{{ route('classe.index') }}">Liste </a></li>
                    </ul>
                </li>
                <li>Matières
                    <ul>
                        <li><a href="{{ route('matieres.create') }}">Ajouter </a></li>
                        <li><a href="{{ route('enseigner.create') }}">Ajouter une matière à une classe </a></li>
                        <li><a href="{{ route('matiere.show.classes') }}">Liste des matières par classe </a></li>
                        <li><a href="{{ route('matieres.index') }}">Liste de toutes les matières</a></li>
                    </ul>
                </li>
                <li>Professeurs
                    <ul>
                        <li><a href="{{ route('professeurs.create') }}">Ajouter </a></li>
                        <li><a href="{{ route('professeurs.index') }}">Liste </a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('inscriptions.create') }}">Inscrire un élève </a>
                </li>
                <li>
                    <a href="{{ route('inscriptions.index') }}">Liste des élèves inscrits </a>
                </li>
                <li>
                    <a href="#">Enregistrer une note </a>
                </li>

            </ul>
        </div>

    </div>

</div>
@endsection
