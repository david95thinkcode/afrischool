@extends('templates.dashboard-dev')
@section('title') Les matières @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
        <h3>Les matières</h3>
        
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <th>#</th>
                    <th>Titre</th>
                    <th>Enseigné en </th>
                    <th>Enseigné par</th> 
                    <th>Actions</th>
                </thead>
                <tbody>
                @foreach ($matieres as $m)
                    <tr>
                        <td>{{ $m->id }}</td>
                        <td>{{ $m->intitule }}</td>
                        <td> TODO:</td>
                        <td> TODO: </td>
                        <td>
                            <a href="{{ route('matieres.edit', ['id' => $m->id]) }}" class="btn btn-sm btn-primary disabled">Modifier</a>
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