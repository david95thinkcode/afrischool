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
                        <th class="text-center">#</th>
                        <th class='text-center'>Type</th>
                        <th class="text-center">Nom</th>
                        <th class="text-center">Directeur</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Téléphone</th>
                        <th class="text-center">Pays</th>
                      </thead>
                      <tbody>
                        @foreach($schools as $s)
                        <tr>
                          <td>{{    $s->id  }}</td>
                          <td>{{    $s->categorie_ets_id  }}</td>
                          <td>{{    $s->sigle  }}</td>
                          <td>{{    $s->directeur   }}</td>
                          <td>{{    $s->email   }}</td>
                          <td>{{    $s->tel }}</td>
                          <td>{{    $s->adresse->pays   }}</td>
                          <th>
                            <a href="{{ route('etablissements.edit', ['id' => $s->id]) }}" class="btn btn-sm btn-primary">Modifier</a>
                            <form action="{{ route('etablissements.destroy', $s->id) }}" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              {!! Form::submit('Supprimer', array('class' => 'btn btn-sm btn-danger')) !!}
                            </form>
                          </th>
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