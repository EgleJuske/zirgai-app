@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">Statymo informacija</div>
        <div class="card-body">
            <h5>Lažybininkas: {{ $better->name }} {{ $better->surname }}</h5>
            <h5>Statoma suma: {{ $better->bet }} &euro;</h5>
            <hr>
            <h5>Arklys: {{ $better->horse->name }}</h5>
            <div>Laimėtų rungtynių skaičius: {{ $better->horse->wins }}</div>
            <div>Dalyvautų rungtynių skaičius: {{ $better->horse->runs }}</div>
            <div>Aprašymas: {!! $better->horse->about !!}</div>

        </div>
    </div>
@endsection
