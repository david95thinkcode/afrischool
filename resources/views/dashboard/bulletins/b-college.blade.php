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
    <div class="col-sm-offset-1 col-sm-10">
        <div class="table-responsive">
            <table class="table" id='bulletinTable'>
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

                        {{-- {{ dd($item['notes']) }} --}}
                        @foreach ($item['notes'] as $typeEvaluation => $notes)

                            {{-- Interrogations --}}
                            @if (($typeEvaluation == 'interrogation') && (count($notes) > 0))
                                <td class="b-interro">
                                @php
                                    $increment = 0;
                                    $variable = 0;
                                @endphp
                                @foreach ($notes as $note)
                                    @php
                                      $increment++;
                                      $variable +=  $note->not_note;
                                      @endphp
                                @endforeach
                                {{-- AVG --}}
                                {!! $variable / $increment !!}
                                </td>
                            @elseif(($typeEvaluation == 'interrogation') && (count($notes) == 0))
                                <td class="b-interro">aucune note</td>
                            @endif

                            {{-- Les devoirs --}}
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
                        {{-- moyenne et mentions --}}
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
    {!! Html::script('js/bulletins/job-college.js') !!}
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
    <script>
        $(document).ready(function() {
            //event click btn id='pdf'
            $('#pdf').click(function(e) {
                e.preventDefault();
                var pdf = new jsPDF('p', 'pt', 'letter'),
                    source = $('#vue-app'),
                    name = {!! $eleve['eleve']->nom !!}{!! $eleve['eleve']->prenoms !!}'.pdf',                    specialElementHandlers = {
                        '#table_stock': function(element, renderer) {
                            return true
                        }
                    }
                margins = {
                    top: 60,
                    bottom: 60,
                    left: 40,
                    width: 522
                };
                alert(name);
                pdf.fromHTML(
                    source, margins.left, margins.top, {
                        'width': margins.width,
                        'elementHandlers': specialElementHandlers
                    },
                    function(dispose) {
                        pdf.save(name);
                    },
                    margins
                )
            });
        });
    </script>
@endsection