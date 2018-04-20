@extends('templates.app')
@section('title') 
    Les Professeurs 
@endsection
@section('section-title')
    @if (isset($classe))
        Les professeurs de la classe de {{ $classe->cla_intitule }} 
    @else
        Liste de tous les professeurs
    @endif
@endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-condensed ">
                <thead>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Nationalité</th>
                    <th>Tel</th>
                    <th>Email</th>
                    <th>Matières enseignées </th>
                    <th>Actions</th>
                </thead>
                <tbody>
                @foreach ($professeurs as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td>{{ $p->prof_nom }} {{ $p->prof_prenoms }}</td>
                        <td> {{ $p->prof_nationalite }}</td>
                        <td>{{ $p->prof_tel }}</td>
                        <td>{{ $p->prof_email }}</td>
                        <td>
                           
                            @if ($p->enseigner != null)
                                @foreach ($p->enseigner as $ens)
                                    {{ $ens->matiere->intitule }},
                                @endforeach
                            @else
                                <span class="badge">Aucune</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('professeurs.show', ['id' => $p->id] ) }}" class="btn btn-sm btn-info">
                            Afficher
                            </a>
                            <a href="{{ route('professeurs.edit', ['id' => $p->id] ) }}" class="btn btn-sm btn-primary">
                            Modifier
                            </a>
                            <form action="{{ route('professeurs.destroy', $p->id) }}" method="POST" class='table-del-btn'>
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              {!! Form::submit('Del', array('class' => 'btn btn-sm btn-danger')) !!}
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
