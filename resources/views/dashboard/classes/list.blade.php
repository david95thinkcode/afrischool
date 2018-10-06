@extends('templates.app')
@section('title') Les classes @endsection
@section('section-title') Liste des classes de {!! $message !!}@endsection
@section('content')
<div class='row'>
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered jambo_table" id="table_list">
                <thead>
                    <th>#</th>
                    <th>Intitulé</th>
                    <th>Description</th>
                    <th>Niveau</th>
                    <th>Montant scolarité</th>
                    <th>Actions rapides</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                @foreach ($classes as $c)
                    <tr>
                        <td>{{ $c->id }}</td>
                        <td>{{ $c->cla_intitule }}</td>
                        <td>{{ $c->cla_description }}</td>
                        <td>
                            @if($c->estPrimaire)
                            Primaire @elseif($c->estCollege)
                            Collège @else Université @endif
                        </td>
                        <td>{{ $c->mt_scolarite }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{!! route('matiere.show.classe', ['classe' => $c->id]) !!}" class="btn btn-success">
                                    <i class="fa fa-book"></i> Matières enseignées
                                </a>
                                <a href="{!! route('emploi-du-temps.afficher', ['classe' => $c->id]) !!}" class="btn btn-info">
                                     Emploi du temps
                                </a>
                                <a href="{!! route('inscriptions.classe.show', ['classe' => $c->id]) !!}" class="btn btn-primary">
                                    <i class="fa fa-users"></i> Elèves inscrits
                                </a>

                            </div>
                        </td>
                        <td>
                            <a href="{{ route('classe.edit', ['id' => $c->id]) }}" class="btn btn-sm btn-warning">Modifier</a>

                            <form action="{{ route('classe.destroy', $c->id) }}" method="post" class='table-del-btn' onsubmit="return confirm('Cette action est irréversible. Etes vous sûr de vouloir supprimer cette classe?');">
                                {{csrf_field()}}
                                {{ method_field('DELETE') }}
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
