@extends('templates.app')
@section('title') Saisie de notes @endsection
@section('section-title')Saisir les notes ! @endsection
@section('content')
    <div class='row'>
        <div class="col-md-5 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="x-content">
                        <div class="col-md-6"><strong>Classe :</strong> {{session('libelleClasse')}}</div>
                        <div class="col-md-6"><strong>Trimestre :</strong> {{session('trimestre')}} trimestre</div>
                        <div class="col-md-6"><strong>Matière :</strong> {{session('libelleMatiere')}}</div>
                        <div class="col-md-6"><strong>Evaluation :</strong> {{session('libelleEvaluation')}}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-xs-12 mt-1">
            <table class="table table-bordered jambo_table" id="table_note">
                <thead>
                <tr>
                    <td>Nom</td>
                    <td>Prénom</td>
                    <td>Date de naissance</td>
                    <td>Note de la matière</td>
                </tr>
                </thead>
                <tbody>
                @php
                    $eleves = $eleves->unique(function ($item) {
                        return $item->eleve->nom.$item->eleve->prenoms;
                    });
                @endphp
                @foreach($eleves as $eleve)
                    <tr>
                        <td>{{$eleve->eleve->nom}}</td>
                        <td>{{$eleve->eleve->prenoms}}</td>
                        <td>{{$eleve->eleve->date_naissance}}</td>
                        @if(!is_null($notes))
                            @php
                                $noters = $notes->where('eleve_id', $eleve->eleve->id);
                            @endphp
                        @endif
                        <td class="text-center">
                            @forelse($noters as $noter)
                                @if(is_null($noter->not_note))
                                    <a href="#" data-name="not_note" data-value="{{$noter->not_note}}"
                                       class="note " data-url="{{route('notes.req')}}"
                                       data-type="text" data-pk="{{$noter->id}}" >
                                        ajouter la note ou 0
                                    </a>
                                @else
                                    <a href="#" data-name="not_note" data-value="{{$noter->not_note}}"
                                       class="note " data-url="{{route('notes.req')}}"
                                       data-type="text" data-pk="{{$noter->id}}" >
                                        {{$noter->not_note}}
                                    </a> <span class="separateur"> || </span>
                                @endif
                                @if ($loop->last)
                                    <hr>
                                    <a href="{{route('add.ligne.eleve', ['eleve' => $eleve->eleve->id])}}" class="btn btn-success">
                                        Ajouter un champ
                                    </a>
                                @endif
                            @empty
                                <a href="{{route('add.ligne.eleve', ['eleve' => $eleve->eleve->id])}}" class="btn btn-success">
                                    Ajouter un champ
                                </a>
                            @endforelse
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('custom-css')
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap.min.css')}}">
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css"
          rel="stylesheet"/>
    <style>
        .separateur{
            padding-left: 20px;
            padding-right: 20px;
        }
    </style>
@endsection
@section('custom-js')
    <script src="{{asset('js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js">
    </script>
    <script type="text/javascript">
        $(document).ready( function () {
            $('#table_note').dataTable({
                "language": {
                    "url": "{{asset('lang/French.json')}}"
                }
            });
        } );
        $(function () {
            //toggle `popup` / `inline` mode
            $.fn.editable.defaults.mode = 'inline';

            $.fn.editable.defaults.params = function (params) {
                params._token = $('meta[name="csrf-token"]').attr('content');
                return params;
            };
            $('#table_note').editable({
                container: 'body',
                selector: 'a.note',
                title: 'Saisir note obtenue',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                dataType: 'json',
                validate: function (value) {
                    if ($.trim(value) == '') {
                        return 'Ce champs est obligatoire';
                    }
                },
                success: function(data) {
                    if(data.code == "new"){
                        return 'Note ajoutée avec succès';
                    }
                },
                error: function (response, newValue) {
                    if (response.status === 500) {
                        return 'Erreur serveur, reprendre';
                    } else {
                        return response.responseText;
                    }
                }
            });
        });
    </script>
@endsection
