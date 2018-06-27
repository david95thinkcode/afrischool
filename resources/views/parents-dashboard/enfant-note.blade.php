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
      
        @foreach ($trimestres as $t)
          <div class="row">
            <div class="col-sm-12">
                <div class="card shadow mb-5 bg-white">
                    <h5 class="card-header">Trimestre #{!! $t->tri_numero !!}</h5>
                    <div class="card-body">
                        {{-- <h5 class="card-title">Special title treatment</h5> --}}
                        <div>
                            <table class="table">
                                <thead class="thead-dark table-bordered">
                                    <tr>
                                        <th scope="col">Matière</th>
                                        <th scope="col">Interrogations</th>
                                        <th scope="col">Devoir</th>
                                        <th scope="col">Examen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Each matieres --}}
                                    @foreach ($matiereWithNotes as $m)
                                    <tr>
                                        <th scope="row">{!! $m->intitule !!}</th>
                                        {{-- Interro notes --}}
                                        <td class="text-center">
                                            @foreach ($m->notes as $n)
                                                @if (($n->types_evaluation_id == 1) && ($n->trimestre_id == $t->id))
                                                    {!! $n->not_note !!} 
                                                @endif
                                            @endforeach
                                        </td>
                                        {{-- Devoir notes --}}
                                        <td class="text-center">
                                            @foreach ($m->notes as $n)
                                                @if (($n->types_evaluation_id == 2) && ($n->trimestre_id == $t->id))
                                                    {!! $n->not_note !!} 
                                                @endif
                                            @endforeach
                                        </td>
                                        {{-- Examen notes --}}
                                        <td class="text-center">
                                            @foreach ($m->notes as $n)
                                                @if (($n->types_evaluation_id == 3) && ($n->trimestre_id == $t->id))
                                                    {!! $n->not_note !!} 
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>                                    
                                    @endforeach
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

@section('custom-css')
    <style>
        .card-body {
            padding: 0px;
        }
    </style>
@endsection
