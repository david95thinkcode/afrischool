@extends('templates.app')
@section('title') Les matières @endsection
@section('section-title') Liste de toutes les matières @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table ">
                <thead>
                    <th>#</th>
                    <th>Titre</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                @foreach ($matieres as $m)
                    <tr>
                        <td>{{ $m->id }}</td>
                        <td>{{ $m->intitule }}</td>
                        <td>
                            <a href="{{ route('matieres.show', ['id' => $m->id]) }}" class="btn btn-sm btn-info">Afficher</a>
                            <a href="{{ route('matieres.edit', ['id' => $m->id]) }}" class="btn btn-sm btn-warning">Modifier</a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
