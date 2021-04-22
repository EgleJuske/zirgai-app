@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <div>
                <h1>Lažybutis</h1>
                <h3>Žirgų lenktynių lažybų valdymo sistema</h1>
            </div>
            <div>
                Šia sistema gali naudotis tik prisijungę vadybininkai.
                <div>Prisijungę jūs galėsite:
                    <ul>
                        <li>Pridėti, redaguoti ir ištrinti arklius</li>
                        <li>Pridėti, redaguoti ir ištrinti lažybininkus</li>
                        <li>Išsifiltruoti vadybininkus, pagal jų pasirinktus arklius</li>
                        <li>Matyti detalesnę informaciją apie kiekvieno lažybininko statymą</li>
                    </ul>
                </div>
            </div>
            <div>
                @if (!auth()->check())
                    <a class="btn btn-lg btn-outline-info px-5" href="{{ route('login') }}">Prisijungti</a>
                @endif
            </div>
        </div>
    </div>
@endsection
