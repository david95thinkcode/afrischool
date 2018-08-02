@extends('templates.app')
@section('title') Informations sur le parent d'élève @endsection
@section('section-title')Informations sur le parent d'élève@endsection
@section('content')
    <div class="x_content" style="display: block;">
        <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="">
                    <a href="{{ route('inscriptions.edit', ['id' => $inscription->eleve_id]) }}" id="home-tab" role="tab">Élève</a>
                </li>
                <li role="presentation" class="active">
                    <a href="{{ route('parent.info', ['id' => $inscription->parent_id]) }}" role="tab" id="profile-tab" >Parent d'élève</a>
                </li>
                <li role="presentation" class="">
                    <a href="{{ route('inscriptions.show', ['id' => $inscription->id]) }}" role="tab">Afficher informations</a>
                </li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="tab_content1" aria-labelledby="home-tab">
                    {!! Form::open(['route' => ['parent.update', $inscription->parent_id], 'method' => 'PUT']) !!}
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    {!! Form::label('nom_parent', "Nom du parent") !!}
                                    {!! Form::text('nom_parent', $inscription->par_nom, ['class' => 'form-control', 'required' => '']) !!}
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    {!! Form::label('prenoms_parent', "Prénom(s) du parent") !!}
                                    {!! Form::text('prenoms_parent', $inscription->par_prenoms, ['class' => 'form-control', 'required' => '']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-6">
                                <div class="form-group">
                                    {!! Form::label('tel_parent', "Tel") !!}
                                    {!! Form::text('tel_parent', $inscription->par_tel, ['class' => 'form-control', 'required' => '']) !!}
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <div class="form-group">
                                    {!! Form::label('mail_parent', "Adresse email") !!}
                                    {!! Form::email('mail_parent', $inscription->par_email, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    {!! Form::label('sexe_parent', "Sexe") !!}
                                    <select name="sexe_parent" id="sexe_parent" class="form-control">
                                        @include('partials.sexe-options')
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class='form-group text-center'>
                            {{ Form::submit("Modifier", array('class' => 'btn btn-success ')) }}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop