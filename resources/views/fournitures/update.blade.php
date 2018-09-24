@extends('templates.app')
@section('title') Fournitures @endsection
@section('section-title') Ajouter des fournitures scolaires @endsection
@section('content')
    <div class='row'>
        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 my-2">
            <div class="panel panel-default mx-auto">
                {!! Form::open(['url' => route('fourniture.update', $fourniture->id), 'method' => 'PUT']) !!}
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
                                  placeholder="Votre fourniture">{{(old('fourniture'))?old('fourniture') : $fourniture->libelle}}</textarea>
                        @if ($errors->has('fourniture'))
                            <span class="help-block">
                                <strong>{{ $errors->first('fourniture') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="panel-footer text-center">
                    <button type="submit" class="btn btn-sm btn-success">
                        Modifier fourniture
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('custom-css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css"
          rel="stylesheet"/>
@endsection
@section('custom-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    </script><script>
        $(document).ready(function () {
            $('#classe').select2({
                width: '100%'
            });
        });
    </script>
@stop