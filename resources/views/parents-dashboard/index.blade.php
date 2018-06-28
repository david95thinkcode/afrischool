@extends('templates.parent-dashboard-style')

@section('title')
    Enfants
@endsection

@section('main-descriptive-text')
    Sélectionnez un enfant afin de consulter les informations lui concernant.
@endsection

@section('main-title')
  Vos enfants
@endsection

@section('content')
  <div class="container">
    <div class="d-flex justify-content-center">
        @foreach ($enfants as $e)
        <div class="row">
          <div class="col">
            <a href="{!! route('consultation.index', ['ideleve' => $e->id]) !!}" class='no-link'>
            <div class="card mb-4 box-shadow">
              <div class="card-body">
                <h3 class="card-title pricing-card-title">#{!! $loop->iteration !!}. {!! $e->prenoms !!} {!! $e->nom !!}</h3>
              </div>
            </div>
            </a>
          </div>
        </div>
        @endforeach
    </div>
  </div>
@endsection

@section('custom-css')
    <style>
      .no-link:hover {
        text-decoration: none;
      }
    </style>
@endsection