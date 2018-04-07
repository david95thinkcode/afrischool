@extends('templates.dashboard-dev')
@section('title') {{ $mat->intitule }} @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
        <h3 class="text-center">{{ $mat->intitule }}</h3>
        <hr>
      @if ($ens->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <th>#</th>
                    <th>Enseigné en </th>
                    <th>Enseigné par</th>
                </thead>
                <tbody>
                @foreach ($ens as $e)
                    <tr>
                        <td> {{ $e->id }}</td>
                        <td> {{ $e->classe->cla_intitule }} </td>
                        <td> {{ $e->professeur->prof_prenoms  }} {{ $e->professeur->prof_nom  }} </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
      @else
          <div class="jumbotron text-center">
             <p>Cette matière n'est encore enseignée dans aucune classe !</p>
             <br>
             <a href="{{ route('enseigner.create') }}" class="btn btn-primary">Attribuer à une classe</a>
          </div>
      @endif
    </div>
</div>
@endsection
