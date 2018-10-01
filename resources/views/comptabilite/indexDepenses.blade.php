@extends('templates.app')
@section('title') Saisie des dépenses @endsection
@section('section-title')Saisir les dépenses! @endsection
@section('content')

    <div class="row">
        <div class="col-sm-offset-4 col-sm-4">
            
            <div class="panel panel-default mx-auto">
                <div class="panel-body">
                {!! Form::open(['action' => ['ComptabiliteController@storeDepenses'], 'method' => 'POST']) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Libellé de la dépense') !!}
                        {!! Form::text('name', old('name'), ['class' => 'form-control', 'required' => '']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('value', 'Montant de la dépense') !!}
                        {!! Form::number('value', old('value'), ['class' => 'form-control', 'required' => '']) !!}
                    </div>

                    <div class='form-group mt-1'>
                        {{ Form::submit("Enregistrer", array('class' => 'btn btn-success col-md-6 col-md-offset-3')) }}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>

        </div>
    </div>
    <div class='row'>
        <div class="col-md-12 col-xs-12 mt-1">


            <table class="table table-bordered jambo_table" id="table_depense">
                <thead>
                <tr>
                    <td>Libellé</td>
                    <td>Montant</td>
                    <td>Date de creation</td>
                    <td>Date de modification</td>
                </tr>
                </thead>
                <tbody>
                @foreach($depenses as $dep)
                    <tr>
                        <td>
                            <a href="#" data-name="libelle" data-value="{{$dep->libelle}}"
                               class="libelle" data-url="{{route('finance.depense.save')}}"
                               data-type="text" data-pk="{{$dep->id}}">
                                @if(!is_null($dep->libelle))
                                    {{$dep->libelle}}
                                @else
                                    saisir le libellé
                                @endif
                            </a>
                        </td>
                        <td>
                            <a href="#" data-name="montant" data-value="{{$dep->montant}}"
                               class="montant" data-url="{{route('finance.depense.save')}}"
                               data-type="text" data-pk="{{$dep->id}}">
                                @if(!is_null($dep->montant))
                                    {{$dep->montant}}
                                @else
                                    saisir le montant
                                @endif
                            </a>
                        </td>
                        <td>
                            {{Carbon\Carbon::parse($dep->created_at)->format('d-m-Y i')}}
                        </td>
                        <td>
                            {{Carbon\Carbon::parse($dep->updated_at)->format('d-m-Y')}}
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
@endsection
@section('custom-js')
    <script src="{{asset('js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js">
    </script>
    <script type="text/javascript">
        $(document).ready( function () {
            $('#table_depense').dataTable({
                "language": {
                    "url": "{{asset('lang/French.json')}}"
                },
                "order": [[ 3, "desc" ]]
            });
        } );
        $(function () {
            //toggle `popup` / `inline` mode
            $.fn.editable.defaults.mode = 'inline';

            $.fn.editable.defaults.params = function (params) {
                params._token = $('meta[name="csrf-token"]').attr('content');
                return params;
            };
            $('#table_depense').editable({
                container: 'body',
                selector: 'a.libelle',
                title: 'Saisir note obtenue',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                dataType: 'json',
                validate: function (value) {
                    if ($.trim(value) == '') {
                        return 'Le libellé est obligatoire';
                    }
                },
                success: function(data) {
                    if(data.code == "new"){
                        location.reload();
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
            $('#table_depense').editable({
                container: 'body',
                selector: 'a.montant',
                title: 'Saisir note obtenue',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                dataType: 'json',
                validate: function (value) {
                    if ($.trim(value) == '') {
                        return 'Le champ montant est obligatoire';
                    }
                },
                success: function(data) {
                    if(data.code == "new"){
                        location.reload();
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