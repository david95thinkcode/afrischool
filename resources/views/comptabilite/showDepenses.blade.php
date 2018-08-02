@extends('templates.app')
@section('title') Les dépenses effectuées @endsection
@section('section-title')Les dépenses effectuées! @endsection
@section('content')
    <div class='row'>
        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form method="POST" action="{{ route('finance.depense.periode') }}">
                        {{ csrf_field() }}
                        <div class="x-content">
                            <div class="col-md-6 col-xs-12">
                                {!! Form::label('datedebut', 'Date de début') !!}
                                {!! Form::date('datedebut', old('datedebut'), ['class' => 'form-control', 'required' => '']) !!}
                            </div>
                            <div class="col-md-6 col-xs-12 mb-1">
                                {!! Form::label('datefin', 'Date de fin') !!}
                                {!! Form::date('datefin', old('datefin'), ['class' => 'form-control', 'required' => '']) !!}
                            </div>

                            <div class='form-group text-center'>
                                {{ Form::submit("Afficher", array('class' => 'btn btn-success ')) }}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
                            {{$dep->libelle}}
                        </td>
                        <td>
                            {{$dep->montant}}
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
        <div class="col-md-6 col-md-offset-6 col-xs-6 col-xs-offset-5">
            <table class="table-bordered table">
                <tr>
                    <td>Total</td>
                    <td>{{$depenses->sum('montant')}}</td>
                </tr>
            </table>
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
            $('#table_depense').dataTable({
                "language": {
                    "url": "{{asset('lang/French.json')}}"
                },
                "order": [[ 3, "desc" ]]
            });
        } );
    </script>
@endsection