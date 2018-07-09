@extends('templates.app')
@section('title') Les matières @endsection
@section('section-title') Liste de toutes les matières @endsection
@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="table-responsive">
            <table class="table table-bordered jambo_table" id="table_list">
                <thead>
                <tr>
                    <td>#</td>
                    <td>Titre</td>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                @foreach ($matieres as $m)
                    <tr>
                        <td>
                            {{ $m->id }}
                        </td>
                        <td>
                            {{ $m->intitule }}
                        </td>
                        <td>
                            <a href="{{ route('matieres.show', ['id' => $m->id]) }}" class="btn btn-sm btn-info">Afficher</a>
                            <a href="{{ route('matieres.edit', ['id' => $m->id]) }}" class="btn btn-sm btn-warning">Modifier</a>
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
