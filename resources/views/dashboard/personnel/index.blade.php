@extends('templates.app')
@section('title') Le personnel @endsection
@section('section-title') Liste complète du personnel @endsection
@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="table-responsive">
            <table class="table table-bordered jambo_table" id="table_list">
                <thead>
                <tr>
                    <td>#</td>
                    <td>Rôle</td>
                    <td>Nom & Prénom(s)</td>
                    <td>Etat du compte</td>
                    <td>Notification</td>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{!! $loop->iteration !!}</td>
                        <td>
                            @foreach ($user->roles as $role)
                            {!! $role->name !!} -                       
                            @endforeach
                        </td>
                        <td>{!! $user->name !!}</td>
                        <td class="text-center">
                            @if ($user->active)
                                <span class="badge badge-success">Activé</span>
                            @else
                                <span class="badge badge-danger">Désactivé</span>
                            @endif
                        </td>
                        {{-- Notification --}}
                        <td></td>
                        {{-- Actions --}}
                        <td>
                            @if ($user->active)
                                @if (!$user->hasRole('administrator'))
                                <a class="btn btn-sm btn-danger" href="{!! route('users.activation', ['user' => $user->id]) !!}"> Désactiver</a>
                                @endif
                            @else 
                                <a class="btn btn-sm btn-success" href="{!! route('users.activation', ['user' => $user->id]) !!}">Activer</a>
                            @endif
                            {{-- <a href="{{ route('matieres.show', ['id' => $m->id]) }}" class="btn btn-sm btn-info">Afficher</a>
                            <a href="{{ route('matieres.edit', ['id' => $m->id]) }}" class="btn btn-sm btn-warning">Modifier</a> --}}
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
