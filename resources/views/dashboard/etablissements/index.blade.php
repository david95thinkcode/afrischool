@extends('templates.dashboard-dev')
@section('title') Etablissements @endsection
@section('content')
<div class='row'>
    <div class="col">
        <h3>Etablissements</h3>
        <br>

      @if ($schools->count() != null)
        <div class="table-responsive">
            <table class="table table-striped">
                      <thead>
                        <th class="">#</th>
                        <th class="">Nom</th>
                        <th class="">Téléphone</th>
                        <th class="">Pays</th>
                        <th>Infos.</th>
                        <th class="">Actions</th>
                      </thead>
                      <tbody>
                        @foreach($schools as $s)
                        <tr>
                          <td>{{ $s->id  }}</td>
                          <td>{{ $s->sigle  }}</td>
                          <td>{{ $s->tel }}</td>
                          <td>{{ $s->adresse->pays   }}</td>
                          <td>
                            @if ($s->activer)
                            <span class="badge badge-success">Activé</span>
                            @else
                            <span class="badge badge-warning">En attente d'activation</span>
                            @endif
                          </td>
                          <td>
                            @if (!$s->activer)
                            <a href="{{ route('etablissements.activate', ['id' => $s->id]) }}" class="btn btn-sm btn-outline-primary">Activer</a>
                            @endif
                            <a href="{{ route('etablissements.show', ['id' => $s->id]) }}" class="btn btn-sm btn-info">Afficher</a>
                            <a href="{{ route('etablissements.edit', ['id' => $s->id]) }}" class="btn btn-sm btn-warning">Modifier</a>
                            <form action="{{ route('etablissements.destroy', $s->id) }}" method="POST" class='table-del-btn'>
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
        <p>Aucun établissement enregistré !</p>
      </div>
      @endif
    </div>
</div>
@endsection
