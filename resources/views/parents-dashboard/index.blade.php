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
    <div class="card-deck mb-3 text-center">
        @foreach ($enfants as $e)
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">#{!! $loop->iteration !!}</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">{!! $e->prenoms !!} {!! $e->nom !!}</h1>
            {{-- <ul class="list-unstyled mt-3 mb-4">
              <li>10 users included</li>
            </ul> --}}
            <a href="{!! route('consultation.notes', ['ideleve' => $e->id]) !!}" class="btn btn-lg btn-block btn-outline-primary">
                Sélectionner
            </a>
          </div>
        </div>
        @endforeach
      <div class="card mb-4 box-shadow">
        <div class="card-header">
          <h4 class="my-0 font-weight-normal">Pro</h4>
        </div>
        <div class="card-body">
          <h1 class="card-title pricing-card-title">$15 <small class="text-muted">/ mo</small></h1>
          <ul class="list-unstyled mt-3 mb-4">
            <li>20 users included</li>
            <li>10 GB of storage</li>
            <li>Priority email support</li>
            <li>Help center access</li>
          </ul>
          <button type="button" class="btn btn-lg btn-block btn-primary">Get started</button>
        </div>
      </div>
      <div class="card mb-4 box-shadow">
        <div class="card-header">
          <h4 class="my-0 font-weight-normal">Enterprise</h4>
        </div>
        <div class="card-body">
          <h1 class="card-title pricing-card-title">$29 <small class="text-muted">/ mo</small></h1>
          <ul class="list-unstyled mt-3 mb-4">
            <li>30 users included</li>
            <li>15 GB of storage</li>
            <li>Phone and email support</li>
            <li>Help center access</li>
          </ul>
          <button type="button" class="btn btn-lg btn-block btn-primary">Contact us</button>
        </div>
      </div>
    </div>
  </div>
@endsection
