@extends('templates.app')
@section('title') 
    Les Professeurs 
@endsection
@section('section-title')
    @if (isset($classe))
        Les professeurs de la classe de {{ $classe->cla_intitule }} 
    @else
        Liste des professeurs enregistrés
    @endif
@endsection
@section('content')
    <div class='row'>
        <div class="col-sm-offset-3 col-sm-6 col-xs-12">
            <div class="panel panel-default mx-auto">
                <div class="panel-heading">
                    <h5>Recherche un professeur</h5>
                </div>
                <div class="panel-body">
                        {!! Form::open(['route' => ['professeurs.search.results'], 'method' => 'POST']) !!}
                        <div class="row">
                            <div class="col-sm-8{{ $errors->has('keyword') ? ' has-error' : '' }}">
                                <label for="keyword">Nom ou prénom du professeur à rechercher</label>
                                {{ Form::text('keyword', old('keyword'), ['class' => 'form-control', 'placeholder' => 'Nom du prof ou extrait', 'required' => '']) }}
                            </div>
                            <div class="col-sm-4 col-xs-12 form-group {{ $errors->has('classe') ? ' has-error' : '' }}">
                                <label for="classe">Sélectionnez une classe</label>
                                <select class="form-control {{ $errors->has('classe') ? ' has-error' : '' }}" id="classe" name="classe">
                                    <option value=""></option>
                                    @foreach($classes as $classe)
                                        <option value="{{$classe->id}}">{{$classe->cla_intitule}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group text-center mt-1">
                                <button type="submit" class="btn btn-sm btn-success">
                                    Rechercher
                                </button>
                            </div>                            
                        </div>
                        {!! Form::close() !!}
                </div>
            </div>
            @if ( isset($msg))
                <div class="alert alert-success text-center">
                    <h4 class="alert-alert-success">{!! $msg !!}</h4>
        </div>
            @endif
    </div>
    </div>
<div class='row'>
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-bordered jambo_table" id="table_list">
                <thead>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Age</th>
                    <th>Nationalité</th>
                    <th>Tel</th>
                    <th>Email</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                @foreach ($professeurs as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td>{!! isset($p->full_name) ? $p->full_name : $p->prof_prenoms.' '.$p->prof_nom !!}</td>
                        <td>{!! isset($p->age) ? $p->age : date('Y') - date('Y', strtotime($p->prof_date_naissance)) . ' ans' !!}</td>
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
