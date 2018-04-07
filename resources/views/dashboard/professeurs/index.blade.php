@extends('templates.dashboard-dev')
@section('title') Les Professeurs @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
        <h3>Les Professeurs</h3>
        <br>
        <div class="table-responsive">
            <table class="table table-sm table-striped">
                <thead>
                    <!-- <th>#</th> -->
                    <th>Nom</th>
                    <th>Tel</th>
                    <th>Email</th>
                    <th>Enseigne </th>
                    <th>Classes</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                @foreach ($professeurs as $p)
                    <tr>
                        <!-- <td>{{ $p->id }}</td> -->
                        <td>{{ $p->prof_nom }} {{ $p->prof_prenoms }}</td>
                        <td>{{ $p->prof_tel }}</td>
                        <td>{{ $p->prof_email }}</td>
                        <td>
                            @foreach($p->enseigner as $ens)
                            {{ $ens->matiere->intitule }},
                            @endforeach
                        </td>
                        <td>
                            @foreach( $p->enseigner as $c)
                            {{ $c->classe->intitule }},
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('professeurs.edit', ['id' => $p->id] ) }}" class="btn btn-sm btn-primary">
                            Modifier
                            </a>
                            <form action="{{ route('professeurs.destroy', $p->id) }}" method="POST">
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

@section('custom-css')
<style>
    form {
        display: inline-block;
    }
</style>
@endsection
