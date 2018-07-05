@extends('templates.app')
@section('title') Matières par classe @endsection
@section('section-title')
    Matières enseignées en {{ $enseigner->first()->cla_intitule }}
@endsection
@section('content')
<div class='row'>
    <div class="col-sm-offset-2 col-sm-8">
        <div class="table-responsive">
            <table class="table ">
                <thead>
                    <th>#</th>
                    <th>Titre</th>
                    <th>Classe</th>
                    <th>Coefficient </th>
                    <th>Enseigné par</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                @foreach ($enseigner as $ens)
                    <tr>
                        <td>{{ $ens->id }}</td>
                        <td>{{ $ens->intitule }}</td>
                        <td>{{ $ens->cla_intitule }}</td>
                        <td>{{ $ens->coefficient }}</td>
                        <td>
                            @if($ens->professeur_id != null)
                            {{ $ens->prof_prenoms }} {{ $ens->prof_nom }}
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('enseigner.edit', ['id' => $ens->id]) }}" disabled class="btn btn-sm btn-warning">
                                Modifier
                            </a>
                            <form action="{{ route('enseigner.destroy', $ens->id) }}" method="POST" class='table-del-btn'>
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              {!! Form::submit('Retirer', array('class' => 'btn btn-sm btn-danger')) !!}
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
