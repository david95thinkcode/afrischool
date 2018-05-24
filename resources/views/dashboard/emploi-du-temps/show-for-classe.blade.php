@extends('templates.app')
@section('title') Emploi du temps @endsection
@section('section-title')
    Emploi du temps de {{ $c->cla_intitule }}
@endsection
@section('content')
<div class='row'>
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table ">
                <thead>
                    <th>#</th>
                    <th>Jour</th>
                    <th>Horaire</th>
                </thead>
                <tbody>
                @foreach ($horaires as $h)
                    <tr>
                        @switch($h->jour_id)

                            @case(1)
                                
                                @break
                            
                            @case(2)
                                @break
                            
                            @case(3)
                                @break
                            
                            @case(4)
                                @break
                            
                            @case(5)
                                @break
                            
                            @case(6)
                                @break
                            
                            @case(7)
                                @break
                        @endswitch                        
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
