@extends('templates.dashboard-dev')
@section('title') Les Professeurs @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
        <h3>Les Professeurs</h3>
        
        <div class="table-responsive">
            <table class="table  table-striped">
                <thead>
                    <th>#</th>
                    <th>Nom & Prénoms</th>
                    <th>Tel</th>
                    <th>Email</th>
                    <th>Matières enseignées </th>
                    <th>Classes tenues</th>
                    <th>PP en</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                @foreach ($professeurs as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td>{{ $p->nom }} {{ $p->prenoms }}</td>
                        <td>{{ $p->tel }}</td>
                        <td>{{ $p->email }}</td>
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
                            @foreach ($p->classes as $c)
                                {{ $c->intitule }},
                            @endforeach
                        </td>                        
                        <td> 
                            <a href="{{ route('professeurs.edit', ['id' => $p->id]) }}" class="btn btn-sm btn-primary disabled">
                            Modifier
                            </a> 
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