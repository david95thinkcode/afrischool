@extends('templates.app')
@section('title') Bulletins @endsection
@section('section-title') Bulletin de {!! $eleve['eleve']->nom !!} {!! $eleve['eleve']->prenoms !!} @endsection
@section('content')
<div class="row">
    <div class="col-sm-8">
        
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