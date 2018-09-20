@extends('templates.app')
@section('title') Absences @endsection
@section('section-title') Cochez les élèves absents @endsection
@section('content')
    <div class='row'>
        <div class="col-md-5 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="x-content">
                        @if ($eleves->isEmpty())
                        <h5 class="text-center">Impossible de continuer car aucun éléve n'est inscrit dans cette classe.</h5>
                        @else 
                        {!! Form::open(['route' => ['absences.store'], 'method' => 'POST']) !!}
                        @foreach ($eleves as $e)
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('eleve['. $loop->index .']', $e->id, ['class' => 'form-control', 'required' => '']) !!} 
                                    {!! $e->eleve->nom !!} {!! $e->eleve->prenoms !!}
                                </label>
                            </div>
                        </div>
                        @endforeach
                        <div class="col-md-6 col-md-offset-4">
                            <input type="submit" class="btn btn-success" value="Enregistrer">
                        </div>
                        {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection