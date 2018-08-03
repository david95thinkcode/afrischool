@extends('templates.app')

@section('title')
    Details sur le professeur {{ $p->prof_prenoms }} {{ $p->prof_nom }}
@endsection

@section('section-title')
    Professeur {{ $p->prof_prenoms }} {{ $p->prof_nom }}
@endsection

@section('content')

@endsection