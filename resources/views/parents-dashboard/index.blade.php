@extends('templates.parent-dashboard-style')

@section('title')
    Enfants
@endsection

@section('main-descriptive-text')
    Sélectionnez un enfant afin de consulter les informations le concernant.
@endsection

@section('main-title')
  Vos enfants
@endsection

@section('content')
  <div class="container">
      <div class="row">
          <div class="col-md-10 mx-auto justify-content-center">
              <table id="liste" class="table table-bordered table-condensed" >
                  <thead>
                  <tr>
                      <th>#</th>
                      <th>Nom</th>
                      <th>Prénom(s)</th>
                      <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  @forelse ($enfants as $e)
                      <tr>
                          <td class="text-center">{!! $loop->iteration !!}</td>
                          <td>{!! $e->nom !!}</td>
                          <td>{!! $e->prenoms !!} </td>
                          <td class="text-center">
                              <a href="{!! route('consultation.index', ['ideleve' => $e->id]) !!}" class='btn btn-sm btn-outline-info'>
                                  consulter informations
                              </a>
                          </td>
                      </tr>
                  @empty
                      <tr>
                          <td colspan="4"class="text-center"> Aucun enfant inscript pour le moment</td>
                      </tr>
                  @endforelse
                  </tbody>
              </table>
          </div>
      </div>
  </div>

@endsection

@section('custom-css')
    {!! Html::style('css/dataTables.bootstrap4.min.css') !!}
@stop

@section('custom-js')
    {!! Html::script('js/jquery.dataTables.min.js') !!}
    {!! Html::script('js/dataTables.bootstrap4.min.js') !!}
    <script>
        $(document).ready(function() {
            $('#liste').DataTable({
                "language": {
                    "url": "{{asset('lang/French.json')}}"
                }
            });
        });
    </script>
@stop