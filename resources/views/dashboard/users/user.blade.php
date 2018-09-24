@extends('admin.layouts.admin')

@section('title', __('views.admin.users.show.title', ['name' => $user->name]))

@section('content')
    <div class="col-md-12">
        <h1>Utilisateurs</h1>
        <div class="row"><br><br>
            <section class="table-responsive">
                <table id="user" class="table table-condensed">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Telephone</th>
                        <th>Mail</th>
                        <th>Profil créé le</th>
                        <th>Bloqué</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->lastname}}</td>
                            <td>{{$user->firstname}}</td>
                            <td>{{$user->telephone}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>
                                @if(($user->locked) == "no")
                                    Non
                                @else
                                    Oui
                                @endif
                            </td>
                            <td>
                                <ul class="list-inline">
                                    @if(($user->role) == "admin")
                                        <li>
                                            <form action="{{route('makeadmin', ['id' => $user->id,'action'=>'makeuser'])}}"
                                                  method="post"
                                                  onsubmit="return confirm('Etes vous sûr de vouloir le nommer utilisateur simple?');">
                                                {{csrf_field()}}
                                                <button class="btn btn-danger"><span
                                                            class=" glyphicon glyphicon-remove"></span> Retirer admin
                                                </button>
                                            </form>

                                        </li>
                                    @else
                                        <li>
                                            <form action="{{route('makeadmin', ['id' => $user->id,'action'=>'makeadmin'])}}"
                                                  method="post"
                                                  onsubmit="return confirm('Etes vous sûr de vouloir le nommer administrateur?');">
                                                {{csrf_field()}}
                                                <button class="btn btn-primary"><span
                                                            class=" glyphicon glyphicon-check"></span> Nommer admin
                                                </button>
                                            </form>
                                        </li>
                                    @endif
                                    @if(($user->locked) == "no")
                                        <li>
                                            <form action="{{route('lockuser', ['id' => $user->id,'action'=>'lock'])}}"
                                                  method="post"
                                                  onsubmit="return confirm('Etes vous sûr de vouloir bloquer cet utilisateur?');">
                                                {{csrf_field()}}
                                                <button class="btn btn-danger"><span
                                                            class=" glyphicon glyphicon-lock"></span> Bloquer
                                                </button>
                                            </form>

                                        </li>
                                    @else
                                        <li>
                                            <form action="{{route('lockuser', ['id' => $user->id,'action'=>'unlock'])}}"
                                                  method="post">
                                                {{csrf_field()}}
                                                <button class="btn btn-success"><span
                                                            class=" glyphicon glyphicon-unlock"></span>Debloquer
                                                </button>
                                            </form>
                                        </li>
                                    @endif
                                    <li>
                                        <form action="{{route('deleteuser', ['id' => $user->id])}}" method="post"
                                              onsubmit="return confirm('Cette action est irréversible. Etes vous sûr de vouloir supprimer  cet utilisateur?');">
                                            {{csrf_field()}}
                                            {{ method_field('DELETE') }}
                                            <button class="btn btn-danger"><span
                                                        class=" glyphicon glyphicon-remove"></span> Supprimer
                                            </button>
                                        </form>
                                    </li>

                                </ul>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center"> Aucun utilisateur enregistrée pour le moment</td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
            </section>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('#user').dataTable({
                "language": {
                    "url": "{{asset('lang/French.json')}}"
                }
            });
        });
    </script>
@stop
