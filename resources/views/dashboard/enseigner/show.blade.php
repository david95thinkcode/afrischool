@extends('templates.app')
@section('title') Matières par classe @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
        <h3 class='text-center'>Les matières de {{ $enseigner->first()->classe->cla_intitule }}</h3>
        <br>

        <div class="text-center">
            <a href="{{ route('matiere.show.classes') }}" class="btn btn-primary">Retour</a>
        </div> <br>
        <div class="table-responsive">
            <table class="table ">
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
                        <td>{{ $ens->classe->cla_intitule }}</td>
                        <td>{{ $ens->coefficient }}</td>
                        <td>
                            @if($ens->professeur_id != null)
                            {{ $ens->professeur->prof_prenoms }} {{ $ens->professeur->prof_nom }}
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('enseigner.edit', ['id' => $ens->id]) }}" class="btn btn-sm btn-primary">
                                Modifier
                            </a>
                            <form action="{{ route('enseigner.destroy', $ens->id) }}" method="POST" class='table-del-btn'>
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
