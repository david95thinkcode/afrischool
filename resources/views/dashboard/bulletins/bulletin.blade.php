@extends('templates.app')
@section('title') Bulletin
@endsection
@section('section-title')
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="text-center">
                <h1>Bulletin Scolaire</h1>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-5">
                    <address class="col-md-8 col-md-offset-1">
                        <h5>Ministère Enseignements Secondaire, <br><span class="pl-2"> Technique et Professionnel</span></h5>
                        <div class="col-md-offset-2">
                            <strong>Bulletin du :</strong>  1 trimestre<br>
                            <strong>Nom :  ____ AGBOGLO  ___</strong> <br>
                            <strong>Prénom :  ____ RAFIOU AGBAWA ___</strong>
                        </div>
                    </address>
                </div>
                <div class="col-md-5 col-md-offset-2">
                    <address class="col-md-8 col-md-offset-4">
                        <h5>RÉPUBLIQUE BÉNINOISE</h5>
                        <div class="col-md-offset-1">
                            <strong>Classe :</strong> 6 e<br>
                            <strong>Effectif :</strong> 10
                        </div>
                    </address>
                </div>
            </div>
        </div>
    </div>

    <div class='row'>
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Matière</th>
                            <th class="text-center">Interrogations</th>
                            <th class="text-center">Devoir</th>
                            <th class="text-center">Moyenne</th>
                            <th class="text-center">Obeservation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Français</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Expression Orale</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Dictée</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>EST</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>ES</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Dessin</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="no-line">Total</td>
                            <td class="no-line"></td>
                            <td class="no-line"></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="pl-4">
                            <h5 class="mb-1 font-weight-bold">Rang : ____ 3e ___sur ___ 10</h5>
                            <h5 class="font-weight-bold">observation et décisions du conseil</h5>
                        </td>
                        <td>
                            <u><strong>Appréciations</strong></u>
                            <h5 class="mb-1">Tableau d'honneur  <input type="checkbox"></h5>
                            <h5 class="mb-1">Félicitation  <input type="checkbox"></h5>
                            <h5 class="mb-1">Encouragement  <input type="checkbox" class="pl-6"></h5>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
@fore
@section('custom-css')
    <style>
        table {
            font-size: medium;
        }

        td {
            vertical-align: middle !important;
        }
        .table > tbody > tr > td.no-line {
            border-top: none;
            border-left: none;
            border-right: none;
         }

        .table > thead > tr > .no-line {
            border-bottom: none;
        }
    </style>
@endsection