@extends('templates.dashboard-dev')
@section('title') Les niveaux @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
        <h3 class="text-center">Les niveaux</h3>
        <br>
        <div class="text-center">
            <a href="{{ route('niveaux.create') }}" class="btn btn-primary">Ajouter </a>
        </div> <br>

        @if ($niveaux->count() != 0)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <th>#</th>
                    <th>Libelle</th>
                    <th>Description</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                @foreach ($niveaux as $n)
                    <tr>
                        <td>{{ $n->id }}</td>
                        <td>{{ $n->niv_libelle }}</td>
                        <td>{{ $n->niv_description }} </td>
                        <td>
                            <a href="{{ route('niveaux.edit', ['id' => $n->id]) }}" class="btn btn-sm btn-warning">Modifier</a>
                           <form action="{{ route('niveaux.destroy', $n->id) }}" method="POST" class='table-del-btn'>
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              {!! Form::submit('Supprimer', array('class' => 'btn btn-sm btn-danger')) !!}
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="jumbotron text-center">
            <p>Aucune niveau n'a été enregistré !</p>

            <a href="{{ route('niveaux.create') }}" class="btn btn-primary">Ajouter un niveau</a>
        </div>
        @endif
    </div>
</div>
@endsection
