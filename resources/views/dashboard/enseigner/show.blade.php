@extends('templates.dashboard-dev')
@section('title') Matières par classe @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
        <h3 class='text-center'>Les matières de {{ $enseigner->first()->classe->intitule }}</h3>
        <br>
        
        <div class="text-center">
            <a href="{{ route('matiere.show.classes') }}" class="btn btn-primary">Retour</a>
        </div> <br>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <th>#</th>
                    <th>Titre</th>
                    <th>Classe</th>
                    <th>Coef </th>
                    <th>Enseigné par</th> 
                    <th>Actions</th>
                </thead>
                <tbody>
                @foreach ($enseigner as $ens)
                    <tr>
                        <td>{{ $ens->id }}</td>
                        <td>{{ $ens->matiere->intitule }}</td>
                        <td>{{ $ens->classe->intitule }}</td>
                        <td>{{ $ens->coefficient }}</td>
                        <td>{{ $ens->professeur->prenoms }} {{ $ens->professeur->nom }} </td>
                        <td>
                            <a href="{{ route('enseigner.edit', ['id' => $ens->id]) }}" class="btn btn-sm btn-primary">
                                Modifier
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection