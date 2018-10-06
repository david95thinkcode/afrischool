@extends('templates.app')
@section('title') Information des parents @endsection
@section('section-title') Inscrire un élève @endsection
@section('content')
    <div class="col-sm-12">
        <div class="x-content">
            {!! Form::open(['action' => ['InscriptionController@sessionParent'], 'method' => 'POST']) !!}

                <fieldset>
                    <legend>Informations sur un parent</legend>
                    @include('inscriptions.partials.parent')
                </fieldset>

                <fieldset>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                              <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                  Personne à contacter en cas d'urgence
                                </a>
                              </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    @include('inscriptions.partials.personne-a-contacter')
                                </div>
                            </div>
                        </div>
                </fieldset>

                <br>
                <div class='form-group text-center'>
                    {{ Form::submit("Suivant", array('class' => 'btn btn-success ')) }}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection