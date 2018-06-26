@extends('templates.parent-dashboard-style')

@section('title')
    Enfants
@endsection

@section('main-descriptive-text')
    Enfant : {!! $enfant->prenoms !!} {!! $enfant->nom !!}
@endsection

@section('main-title')
  Les notes
@endsection

@section('content')
  <div class="container">
        {{-- @foreach ($notes as $n)
        @endforeach --}}
        
        @foreach ($trimestres as $t)
          <div class="row">
            <div class="col-sm-12">
                <div class="card shadow mb-5 bg-white">
                    <h5 class="card-header">Trimestre #{!! $t->tri_numero !!}</h5>
                    <div class="card-body">
                        {{-- <h5 class="card-title">Special title treatment</h5> --}}
                        <div>
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Matière</th>
                                        <th scope="col">Interrogations</th>
                                        <th scope="col">Devoir</th>
                                        <th scope="col">Examen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notes as $n)
                                        @if ($n->trimestre_id == $t->id)
                                        <th scope="row">{!! $n->matiere->intitule !!}</th>
                                        {{-- TODO --}}
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                            
                                        @endif
                                    @endforeach
                                    <tr>
                                    </tr>                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>      
          </div>
        @endforeach
    </div>
@endsection
