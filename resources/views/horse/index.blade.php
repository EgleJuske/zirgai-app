@extends('layouts.app')
@section('content')
    @if (session('status_success'))
        <div class="alert alert-success" role="alert">{{ session('status_success') }}</div>
    @endif
    @if (session('status_error'))
        <div class="alert alert-danger" role="alert">{{ session('status_error') }}</div>
    @endif
    <div class="card-body">
        <table class="table">
            <tr>
                <th>Vardas</th>
                <th>Laimėtos rungtynės</th>
                <th>Dalyvauta rungtynių</th>
                <th>Laimėjimų procentas</th>
                <th>Veiksmai</th>
            </tr>
            @foreach ($horses as $horse)
                <tr>
                    <td>{{ $horse->name }}</td>
                    <td>{{ $horse->wins }}</td>
                    <td>{{ $horse->runs }}</td>
                    <td>{{ number_format(($horse->wins * 100) / $horse->runs, 1) }} &percnt;</td>
                    <td>
                        <div class="d-flex flex-wrap">
                            <a class="btn btn-info btn-sm mr-2 text-white"
                                href={{ route('horse.edit', $horse->id) }}>Redaguoti</a>
                            <form action={{ route('horse.destroy', $horse->id) }} method="POST">
                                @csrf @method('delete')
                                <input type="submit" class="btn btn-danger  btn-sm mt-md-0 mt-sm-2" value="Ištrinti">
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
        <div>
            <a href="{{ route('horse.create') }}" class="btn btn-success btn-lg btn-block">Pridėti arklį</a>
        </div>
    </div>
@endsection
