@extends('templates.app')
@section('title') Informations de l'élève @endsection
@section('section-title') Information détaillé de  {!! $inscription->nom !!} {!! $inscription->prenoms !!}@endsection
@section('content')
    <div class="x_content" style="display: block;">
        <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="false">Élève</a>
                </li>
                <li role="presentation" class="">
                    <a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Parent d'élève</a>
                </li>
                <li role="presentation" class="">
                    <a href="{{ route('inscriptions.edit', ['id' => $inscription->eleve_id]) }}" role="tab">Modifier informations</a>
                </li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="tab_content1" aria-labelledby="home-tab">
                    <div class="table-responsive">
                        <table class="table table-bordered jambo_table">
                            <thead>
                                <th>Libellé
                                <th>Information</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Nom & prénom(s)</td>
                                    <td>
                                        {!! $inscription->nom !!} {!! $inscription->prenoms !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Age</td>
                                    <td>
                                        {!! date('Y') - date('Y', strtotime($inscription->date_naissance)) !!} ans
                                    </td>
                                </tr>
                                <tr>
                                    <td>Sexe</td>
                                    <td>
                                        {!! $inscription->nom !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Classe</td>
                                    <td>
                                        {!! $inscription->cla_intitule !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>École de provenance</td>
                                    <td>
                                        {!! ($inscription->ecole_provenance)?$inscription->ecole_provenance:'pas renseigné' !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Date d'inscription</td>
                                    <td>
                                        {!! $inscription->date_inscription !!}
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>

                        <div class="alert alert-success text-center">
                            <h4 class="alert-heading text-uppercase">A transmettre au parent d'élève</h4>
                            <h5>Le code secret à utiliser pour s'inscrire sur la plateforme est :</h5>
                            <h1>{!! $inscription->id !!}</h1>
                        </div>
                    </div>
                    <br>
                    <a href="route" class="btn btn-sm"></a>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                    <div class="table-responsive">
                        <table class="table table-bordered jambo_table">
                            <thead>
                            <th>Libellé
                            <th>Information</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Nom & prénom(s)</td>
                                    <td>
                                        {!! $inscription->par_nom !!} {!! $inscription->par_prenoms !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Sexe</td>
                                    <td>
                                        {!! $inscription->par_sexe !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Téléphone</td>
                                    <td>
                                        {!! $inscription->par_tel !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>
                                        {!! ($inscription->par_email)?$inscription->par_email:'pas de email' !!}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop