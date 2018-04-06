@extends('templates.dashboard-dev')
@section('title') Inscriptions @endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">

        <div>
            <div>
                <h3 class='text-center'>Les élèves inscrits en {{ $inscriptions[0]->classe->intitule }} </h3>
            </div> <hr>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <th>#</th>
                        <th>Elève</th>
                        <th>Classe</th>
                        <th>Inscrit le</th>
                    </thead>
                    <tbody>
                        @foreach ($inscriptions as $i)
                            <tr>
                                <td>
                                    {!! $i->id !!}
                                </td>
                                <td>
                                    {!! $i->eleve->nom !!} {!! $i->eleve->prenoms !!}
                                </td>
                                <td>
                                    {!! $i->classe->intitule !!}
                                </td>
                                <td>
                                  {!! $i->created_at !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
