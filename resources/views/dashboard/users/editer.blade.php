<div class="x_content">
    <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
        <thead>
        <tr>
            <th>Nom Prénom(s)</th>
            <th>Nom d'utilisateur</th>
            <th>Email</th>
            <th>Rôle(s)</th>
            <th>Actions</th>
        </tr>
        </thead>

        <tbody>
        @forelse()
            <tr>
                <td>
                    {{$user->name}}
                </td>
                <td>
                    {{$user->username}}
                </td>
                <td>{{$user->email}}</td>
                <td>
                    {{--<select id="roles" name="roles[]" class="select2" multiple="multiple" style="width: 100%" autocomplete="off">
                        @foreach($roles as $role)
                            <option @if($user->roles->find($role->id)) selected="selected" @endif value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>--}}
                </td>
                <td>
                    @if($user->active == true)
                        <a href="#">Activer</a>
                    @else
                        <a href="#">Desactiver</a>
                    @endif
                </td>
            </tr>
        @empty
            <p class="text-center my-5 py-5">
                Pas d'utilisateur disponible, ajouter des utiisateurs
            </p>
        @endforelse
        </tbody>
        
    </table>
</div>