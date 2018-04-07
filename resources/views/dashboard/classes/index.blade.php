@extends('templates.dashboard-dev')
@section('title') Les classes @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
        <h3>Les classes</h3>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <th>#</th>
                    <th>Intitulé</th>
                    <th>Professeur principal</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                @foreach ($classes as $c)
                    <tr>
                        <td>{{ $c->id }}</td>
                        <td>{{ $c->intitule }}</td>
                        <td>
                        @if ($c->professeur_id)
                            {{ $c->professeur->prof_prenoms }} {{ $c->professeur->prof_nom }}
                        @endif
                        </td>
                        <td>
                            <a href="{{ route('classe.edit', ['id' => $c->id]) }}" class="btn btn-sm btn-primary">Modifier</a>
                           <form action="{{ route('classe.destroy', $c->id) }}" method="POST">
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
