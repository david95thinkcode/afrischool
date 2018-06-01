@extends('layouts.app', ['title' => @lang('Error')])

@section('content')
    <div class="container">
        <div class="row my-5 py-5">
            <div class="col-*-8 col-*-offset-2">
                @lang('Too many requests').
            </div>
        </div>
    </div>
@endsection
