@extends('templates.dashboard-dev')
@section('title') Etablissements @endsection
@section('content')
<div class='row'>
    <div class="col">
        <h3>Etablissements</h3> 
        <br>

      <div class="table-responsive">
        <table class="table table-striped">
                      <thead>
                        <th class="text-center">#</th>
                        <th class='text-center'>Catégorie</th>
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
                          <td>{{    $s->raison_sociale  }}</td>
                          <td>{{    $s->directeur   }}</td>
                          <td>{{    $s->email   }}</td>
                          <td>{{    $s->tel }}</td>
                          <td>{{    $s->adresse->pays   }}</td>
                        </tr>
                        @endforeach
                      </tbody>
        </table>
      </div>
    </div>
</div>
@endsection