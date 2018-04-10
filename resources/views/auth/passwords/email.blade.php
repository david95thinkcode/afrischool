@extends('layouts.app', ['title' => 'restauration de mot de passe'])

@section('title')
    @lang('Réinitialiser mot de passe')
@endsection

@section('content')
<div class="container pt-5 mt-2">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading text-18">
                    Réinitialiser mon mot de passe
                </div>

                <div class="panel-body">

                    <form class="form-horizontal" method="POST" action="{{ route('password.tel') }}">
                        {{ csrf_field() }}

                        <div class="col-md-6 mb-1 col-md-offset-3">
                            <div class="form-group{{ $errors->has('pays') ? ' has-error' : '' }}">
                                <select class="form-control" name="pays"  id="id" onchange="load()" >
                                    <option value=" ">-Selectionnez le pays-</option>
                                    @foreach($listPays as $pays) 
                                        @if($pays->id == 4)
                                            <option value="{{$pays->id}}" selected>{{$pays->libellepays}}</option>
                                        @else
                                            <option value="{{$pays->id}}">{{$pays->libellepays}}</option>
                                        @endif 
                                    @endforeach
                                </select>
                                @if ($errors->has('pays'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pays') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-2 col-md-offset-2 mb-1{{ $errors->has('indicatif') ? ' has-error' : '' }}">
                            <input id="indicatif" type="text" class="form-control" name="indicatif" value="229" required readonly>
                            @if ($errors->has('indicatif'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('indicatif') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-6 mb-1{{ $errors->has('tel') ? ' has-error' : '' }}">
                            <input id="tel" type="text" class="form-control" placeholder="@lang('Votre Telephone')" 
                            name="tel" value="" required>
                            @if ($errors->has('tel'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tel') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-orange">
                                @lang('Recevoir code restauration')
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        function load(){
            $.ajax({
                /* the route pointing to the post function */
                url: '{{route('getCountry')}}',
                method: 'get',
                /* send the csrf-token and the input to the controller */
                data: {
                    id:$("#id").val(),
                },
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function (data) {
                    $("#indicatif").val(data.flagInd);
                    $("#tel").val("");
                }
            }); 
        }
    </script>
@stop
