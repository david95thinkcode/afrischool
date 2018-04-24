@extends('templates.app')
@section('title') Matières @endsection
@section('section-title') {{ $mat->intitule }} @endsection
@section('content')
    <div class="col-md-12">
        <div class='x-content'>
            @if ($ens->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <th>#</th>
                        <th>Enseigné en</th>
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
