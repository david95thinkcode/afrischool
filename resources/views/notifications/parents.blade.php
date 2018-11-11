@extends('templates.app')
@section('title') Envoie de message @endsection
@section('section-title')Notification aux parents d'élèves @endsection
@section('content')
    <classe-envoie-message></classe-envoie-message>
@endsection

@section('custom-css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css"
          rel="stylesheet"/>
@endsection
@section('custom-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
       /* $(document).ready(function () {
            $('#classe').select2();
        });*/
        // $('#message').keyup(function () {
        //     var max = 160;
        //     var char = $(this).val().length;
        //     if (char <= max) {
        //         $('#charNum').text(char + ' (1 sms)');
        //     }else{
        //         $('#charNum').text(char + ' (2 sms)');
        //     }
        // });
    </script>
@stop