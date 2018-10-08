@extends('templates.app')

@section('title') 
    Details sur le professeur {{ $p->prof_prenoms }} {{ $p->prof_nom }} 
@endsection

@section('section-title') 
    Professeur {{ $p->prof_prenoms }} {{ $p->prof_nom }} 
@endsection

@section('content')
<div class='row'>
    <div class="col-sm-12">
        <div>
            <div class="row">
                <div class="col-sm-5">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default mx-auto">
                                <div class="panel-heading"><span class="lead">Détails personnels</span></div>
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <th>Code : </th>
                                            <td>{!! $p->id !!}</td>
                                        </tr>
                                        <tr>
                                            <th>Nom : </th>
                                            <td>{!! $p->prof_nom !!}</td>
                                        </tr>
                                        <tr>
                                            <th>Prénom(s) : </th>
                                            <td>{!! $p->prof_prenoms !!}</td>
                                        </tr>
                                        <tr>
                                            <th>Téléphone : </th>
                                            <td>{!! $p->prof_tel !!}</td>
                                        </tr>
                                        <tr>
                                            <th>Adresse mail : </th>
                                            <td>{!! $p->prof_email !!}</td>
                                        </tr>
                                        <tr>
                                            <th>Age : </th>
                                            <td>{!! $p->age !!} ans</td>
                                        </tr>
                                        <tr>
                                            <th>Nationalité : </th>
                                            <td>{!! $p->prof_nationalite !!}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default mx-auto">
                                <div class="panel-heading">
                                    <span class="lead">Matières enseignées 
                                        <span class="badge">{!! count($p->enseigner) !!}
                                        </span>
                                    </span> 
                                </div>
                                <table class="table table-hover">
                                    <tbody>
                                        @foreach ($enseigner as $ens)
                                            <tr>
                                                <th>{!! $ens->matiere->intitule !!}</th>
                                                <td class="text-center">enseignée en classe de </td>
                                                <th>{!! $ens->classe->cla_intitule !!}</th>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span class="lead">Les dîplomes</span>
                                    <a href="{{ route('professeur.diplome.create', ['id' => $p->id]) }}" class="btn btn-success pull-right">Ajouter un diplome</a>
                                </div>
                                <table class="table table-hover">
                                    <thead>
                                        {{-- <th>#</th> --}}
                                        <th>Intitule</th>
                                        <th>Specialité</th>
                                        <th>Niveau</th>
                                        <th>Ecole </th>
                                        <th>Date d'obtention</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                    @foreach ($p->diplomes as $d)
                                        <tr>
                                            {{-- <td>{{ $d->id }}</td> --}}
                                            <td>{{ $d->dip_intitule }}</td>
                                            <td>{{ $d->dip_specialite }}</td>
                                            <td>{{ $d->dip_niveau }}</td>
                                            <td>{{ $d->dip_ecole }}</td>
                                            <td>{{ $d->dip_date_obtention }}</td>
                                            <td>
                                                <a href="{{ route('diplomes.show', ['id' => $d->id] ) }}" class="btn btn-sm btn-info" title="Afficher les détails">
                                                    <i class="fa fa-info" aria-hidden="true"></i>
                                                </a>
                                                <a href="{{ route('diplomes.edit', ['id' => $d->id] ) }}" class="btn btn-sm btn-warning" title="Modifier">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a>
                                                <form action="{{ route('diplomes.destroy', $d->id) }}" method="POST" class='table-del-btn'>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                {!! Form::submit('Retirer', array('class' => 'btn btn-sm btn-danger')) !!}
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
        
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <professeur-edt v-bind:prof={!! $p->id !!}></professeur-edt>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
</div>
@endsection