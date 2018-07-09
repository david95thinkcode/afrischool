@extends('templates.app')
@section('title') Matières enseignées @endsection
@section('content')
    <div class="col-sm-12">
        <div class="x-content">
            {!! Form::model($ens, ['action' => ['EnseignerController@update', $ens->id], 'method' => 'PUT']) !!}

            @include('dashboard.enseigner.partials.form-edit')

            {!! Form::close() !!}

        </div>
    </div>
@endsection

@section('custom-css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css"
          rel="stylesheet"/>
@endsection
@section('custom-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#classe').select2();
            $('#matiere').select2();
            $('#anneescolaire').select2();
            $('#professeur').select2();
        });
    </script>
@endsection
