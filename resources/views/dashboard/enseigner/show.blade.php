@extends('templates.app')
@section('title') Matières par classe @endsection
@section('section-title')
    Matières enseignées en {{ $enseigner->first()->cla_intitule }}
@endsection
@section('content')
<div class='row'>
    <div class="text-center">
        <a href="{{ route('enseigner.create') }}" class="btn btn-danger">Ajouter matière et professeur</a>
    </div>
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered jambo_table" id="table_list">
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
