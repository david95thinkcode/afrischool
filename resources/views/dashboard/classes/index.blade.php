@extends('templates.app')
@section('title') Les classes @endsection
@section('section-title') Liste des classes @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table ">
                <thead>
                    <th>#</th>
                    <th>Intitulé</th>
                    <th>Niveau</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                @foreach ($classes as $c)
                    <tr>
                        <td>{{ $c->id }}</td>
                        <td>{{ $c->cla_intitule }}</td>
                        <td>
                            @if ($c->niveau != null)
                                {{  $c->niveau->niv_libelle }}
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('classe.show', ['id' => $c->id]) }}" class="btn btn-sm btn-info">Afficher</a>
                            <a href="{{ route('classe.edit', ['id' => $c->id]) }}" class="btn btn-sm btn-warning">Modifier</a>
                           <form action="{{ route('classe.destroy', $c->id) }}" method="POST" class='table-del-btn'>
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
    </div>
</div>
@endsection
