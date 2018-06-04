@extends('layouts.app', ['title' => @lang('Page Expired')])

@section('content')
    <div class="container">
        <div class="row my-5 py-5">
            <div class="col-*-8 col-*-offset-2">
                @lang('The page has expired due to inactivity').
                <br/><br/>
                @lang('Please refresh and try again').
            </div>
        </div>
    </div>
@endsection
