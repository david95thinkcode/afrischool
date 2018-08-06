@extends('templates.app')
@section('title') Bulletins @endsection
@section('section-title') Bulletin de {!! $eleve['eleve']->nom !!} {!! $eleve['eleve']->prenoms !!} @endsection
@section('content')
<div class="row">
    <div class="col-md-5">
        <address class="col-md-8 col-md-offset-1">
            <h5>Ministère Enseignements Secondaire, <br><span class="pl-2"> Technique et Professionnel</span></h5>
            <div class="col-md-offset-2">
                <strong>Bulletin du :</strong>  1 trimestre<br>
                <strong>Nom :  ____ {!! $eleve['eleve']->nom !!}  ___</strong> <br>
                <strong>Prénom(s) :  ____ {!! $eleve['eleve']->prenoms !!} ___</strong>
            </div>
        </address>
    </div>
    <div class="col-md-5 col-md-offset-2">
        <address class="col-md-8 col-md-offset-4">
            <h5>RÉPUBLIQUE BÉNINOISE</h5>
            <div class="col-md-offset-1">
                <strong>Classe :</strong> {!! Session::get('classe.cla_intitule') !!}  <br>
                <strong>Effectif :</strong> 10
            </div>
        </address>
    </div>
</div>
<div class='row'>
    <div class="col-sm-offset-2 col-sm-8">
        <div class="table-responsive">
            <table class="table" id='bulletinTable'>
                <thead>
                    <th>Matière</th>
                    <th>1ere Composition</th>
                    <th>2e Composition</th>
                    <th>Coef.</th>
                    <th>Moyenne</th>
                    <th>Mention</th>
                    <th>Enseignant</th>
                </thead>
                <tbody>
                @foreach ($notesOrdonnes as $matiere => $item)
                    <tr>
                        <td>{{ $matiere }}</td>

                        @foreach ($item['notes'] as $typeEvaluation => $notes)
                            
                            @if (($typeEvaluation == 'devoir') && (count($notes) == 0))
                                <td class="b-devoir">aucune note</td>
                                <td class="b-devoir">aucune note</td>
                            @elseif (($typeEvaluation == 'devoir') && (count($notes) == 1))
                                <td class="b-devoir">{!! $notes[0]->not_note !!}</td>
                                <td class="b-devoir">aucune note</td>
                            @elseif (($typeEvaluation == 'devoir') && (count($notes) == 2))
                                @foreach ($notes as $note)
                                    <td class="b-devoir">{!! $note->not_note !!}</td>                                
                                @endforeach
                            @endif

                        @endforeach
                        
                        <td class="b-coef">{!! $item['details']->coefficient !!}</td>
                        <td class="b-moy"></td>
                        <td class="b-mention"></td>
                        <td>{!! $item['details']->professeur->prof_nom !!} {!! $item['details']->professeur->prof_prenoms !!} </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div>
            <h5>Moyenne Générale : 
                <span class='badge badge-primary' id="GAVG"></span>
            </h5>
        </div>
    </div>
</div>
@endsection

@section('custom-js')
    {!! Html::script('js/bulletins/job-primaire.js') !!}
@endsection