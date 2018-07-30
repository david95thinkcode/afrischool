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
            <table class="table ">
                <thead>
                    <th>Matière</th>
                    <th>Interrogation</th>
                    <th>1er Devoir</th>
                    <th>2e Devoir</th>
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
                            
                            {{-- Interrogations --}}
                            @if (($typeEvaluation == 'interrogation') && (count($notes) > 0))
                                <td>
                                @foreach ($notes as $note)
                                    {!! $note->not_note !!}
                                @endforeach
                                </td>
                            @elseif(($typeEvaluation == 'interrogation') && (count($notes) == 0))
                                <td>aucune note</td>
                            @endif
                            
                            {{-- Les devoirs --}}
                            @if (($typeEvaluation == 'devoir') && (count($notes) == 0))
                                <td>aucune note</td>
                                <td>aucune note</td>
                            @elseif (($typeEvaluation == 'devoir') && (count($notes) == 1))
                                <td>{!! $notes->not_note !!}</td>
                                <td>aucune note</td>
                            @elseif (($typeEvaluation == 'devoir') && (count($notes) == 2))
                                @foreach ($notes as $note)
                                    <td>{!! $note->not_note !!}</td>                                
                                @endforeach
                            @endif

                        @endforeach
                        
                        <td>{!! $item['details']->coefficient !!}</td>
                        {{-- moyenne et mentions --}}
                        <td class="b-moy"></td>
                        <td class="b-mention"></td>
                        <td>{!! $item['details']->professeur->prof_nom !!} {!! $item['details']->professeur->prof_prenoms !!} </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
