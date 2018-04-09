@extends('templates.dashboard-dev')
@section('title') Details sur le professeur {{ $p->prof_prenoms }} {{ $p->prof_nom }} @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
        
        <div>
            <h3>Dîplomes {{ $p->prof_prenoms }} {{ $p->prof_nom }} </h3>
            <a href="{{ route('professeur.diplome.create', ['id' => $p->id]) }}" class="btn btn-primary">Ajouter un diplome</a>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <th>#</th>
                        <th>Intitule</th>
                        <th>Specialité</th>
                        <th>Niveau</th>
                        <th>Ecole </th>
                        <th>Date d'obtention</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                    @foreach ($p->diplomes as $d)
                        <tr>
                            <td>{{ $d->id }}</td>
                            <td>{{ $d->dip_intitule }}</td>
                            <td>{{ $d->dip_specialite }}</td>
                            <td>{{ $d->dip_ecole }}</td>
                            <td>{{ $d->dip_niveau }}</td>
                            <td>{{ $d->dip_date_obtention }}</td>
                            <td>
                                <a href="{{ route('diplomes.show', ['id' => $d->id] ) }}" class="btn btn-sm btn-outline-info">
                                Afficher
                                </a>
                                <a href="{{ route('diplomes.edit', ['id' => $d->id] ) }}" class="btn btn-sm btn-outline-warning">
                                Modifier
                                </a>
                                <form action="{{ route('diplomes.destroy', $d->id) }}" method="POST" class='table-del-btn'>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                {!! Form::submit('Retirer', array('class' => 'btn btn-sm btn-outline-danger')) !!}
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</div>
@endsection