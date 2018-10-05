@extends('templates.app')
@section('title') 
    Les Professeurs 
@endsection
@section('section-title')
        Les professeurs de la classe de {{ $classe->cla_intitule }}
@endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-bordered jambo_table" id="table_list">
                <thead>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Age</th>
                    <th>Nationalité</th>
                    <th>Teléphone</th>
                    <th>Email</th>
                    <th>Matière(s) enseignée(s) </th>
                    <th>Actions</th>
                </thead>
                <tbody>
                @foreach ($sorted as $e)
                    <tr>
                        <td>{{ $e['id'] }}</td>
                        <td>{!! isset($e['datas']->full_name) ? $e['datas']->full_name : $e['datas']->prof_prenoms.' '.$e['datas']->prof_nom !!}</td>
                        <td>{!! isset($e['datas']->age) ? $e['datas']->age : date('Y') - date('Y', strtotime($e['datas']->prof_date_naissance)) . ' ans' !!}</td>
                        <td>{{ $e['datas']->prof_nationalite }}</td>
                        <td>{{ $e['datas']->prof_tel }}</td>
                        <td>{{ $e['datas']->prof_email }}</td>
                        <td>
                            @foreach ($e['matieres'] as $m)
                            <li>
                                {!! $m !!}
                            </li>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('professeurs.show', ['id' => $e['id']] ) }}" class="btn btn-sm btn-info">
                            Afficher
                            </a>
                            <a href="{{ route('professeur.edit', ['id' => $e['id']] ) }}" class="btn btn-sm btn-primary">
                            Modifier
                            </a>
                            <form action="{{ route('professeurs.destroy', $e['id']) }}" method="POST" class='table-del-btn'>
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
