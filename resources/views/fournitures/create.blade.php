@extends('templates.app')
@section('title') Fournitures @endsection
@section('section-title') Ajouter des fournitures scolaires @endsection
@section('content')
    <div class='row'>
        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 my-2">
            <div class="panel panel-default mx-auto">
                {!! Form::open(['url' => route('fourniture.store'), 'method' => 'POST']) !!}
                <div class="panel-body">
                    <div class="col-md-12 col-xs-12 form-group mb-1{{ $errors->has('classe') ? ' has-error' : '' }}">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="classe">Selectionnez la classe
                            <span class="required">*</span>
                        </label>
                        <select class="col-md-12 col-sm-12 col-xs-12{{ $errors->has('classe') ? ' has-error' : '' }}" id="classe" name="classe_id">
                            @foreach($classes as $classe)
                                <option value="{{$classe->id}}">{{$classe->cla_intitule}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12" data-for="fourniture">
                        <label for="fourniture">Votre fourniture <span class="required">*</span></label>
                        <textarea id="fourniture" class="form-control" name="libelle" rows="3"
                                  placeholder="Votre fourniture">{{old('fourniture')}}</textarea>
                        @if ($errors->has('fourniture'))
                            <span class="help-block">
                                <strong>{{ $errors->first('fourniture') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="panel-footer text-center">
                    <button type="submit" class="btn btn-sm btn-success">
                        Ajouter fourniture
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class='row'>
        <div class="col-sm-offset-1 col-sm-9">
            <table id="table_fourniture" class="table table-bordered table-condensed" >
                <thead>
                <tr>
                    <th>#</th>
                    <th>Classe</th>
                    <th>Fourniture</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($fournitures as $f)
                    <tr>
                        <td class="text-center">{!! $loop->iteration !!}</td>
                        <td>{!! $f->classe->cla_intitule !!} </td>
                        <td>{!! $f->libelle !!}</td>
                        <td class="row">
                            <div class="col-md-6">
                                <form action="{{route('fourniture.destroy', $f->id)}}" method="post"
                                      onsubmit="return confirm('Etes vous sûr de supprimer ?');">
                                    {{csrf_field()}}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-sm btn-danger">
                                        <span class="glyphicon glyphicon-lock"></span>
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <a href="{!! route('fourniture.edit', ['idfourniture' => $f->id]) !!}"
                                   class='btn btn-sm btn-info'>
                                    Modifier
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4"class="text-center"> Aucune fourniture enregistrée pour le moment</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('custom-css')
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap.min.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css"
          rel="stylesheet"/>
@endsection
@section('custom-js')
    <script src="{{asset('js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#table_fourniture').dataTable({
                "language": {
                    "url": "{{asset('lang/French.json')}}"
                }
            });
        });
    </script><script>
        $(document).ready(function () {
            $('#classe').select2({
                width: '100%'
            });
        });
    </script>
@stop