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
            <table class="table table-bordered jambo_table" id="table_list">
                <thead>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Nationalité</th>
                    <th>Tel</th>
                    <th>Email</th>
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
                            <a href="{{ route('professeurs.show', ['id' => $p->id] ) }}" class="btn btn-sm btn-info">
                            Afficher
                            </a>
                            <a href="{{ route('professeurs.edit', ['id' => $p->id] ) }}" class="btn btn-sm btn-primary">
                            Modifier
                            </a>
                            <form action="{{ route('professeurs.destroy', $p->id) }}" method="POST" class='table-del-btn'>
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
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap.min.css')}}">
@endsection
@section('custom-js')
    <script src="{{asset('js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready( function () {
            $('#table_list').dataTable({
                "language": {
                    "url": "{{asset('lang/French.json')}}"
                }
            });
        });
    </script>
@endsection
