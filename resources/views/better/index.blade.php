@extends('layouts.app')
@section('content')
    @if (session('status_success'))
        <div class="alert alert-success" role="alert">{{ session('status_success') }}</div>
    @endif
    @if (session('status_error'))
        <div class="alert alert-danger" role="alert">{{ session('status_error') }}</div>
    @endif
    <div class="card-body">
        <form class="form-inline" action="{{ route('better.index') }}" method="GET">
            <select name="horse_id" id="" class="form-control">
                <option value="" selected disabled>Pasirinkite arklį:</option>
                @foreach ($horses as $horse)
                    <option value="{{ $horse->id }}" @if ($horse->id == app('request')->input('horse_id')) selected="selected" @endif>{{ $horse->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-dark ml-3">Filtruoti</button>
            <a class="btn btn-info ml-2" href={{ route('better.index') }}>Rodyti visus</a>
        </form>
    </div>
    <div class="card-body">
        <table class="table">
            <tr>
                <th>Vardas</th>
                <th>Arklys</th>
                <th>Statoma suma</th>
                <th>Veiksmai</th>
            </tr>
            @foreach ($betters as $better)
                <tr>
                    <td>{{ $better->name }} {{ $better->surname }}</td>
                    <td>{{ $better->horse->name }}</td>
                    <td>
                        {{ $better->bet }} &euro;
                    </td>
                    <td>
                        <div class="d-flex flex-column ">
                            <div class="d-flex flex-wrap">
                                <a class="btn btn-success btn-sm mr-2"
                                    href={{ route('better.edit', $better->id) }}>Redaguoti</a>
                                <form action={{ route('better.destroy', $better->id) }} method="POST">
                                    @csrf @method('delete')
                                    <input type="submit" class="btn btn-danger btn-sm mt-md-0 mt-sm-2" value="Ištrinti">
                                </form>
                            </div>
                            <div>
                                <a href="{{ route('better.info', $better->id) }}" class="badge badge-light">Daugiau
                                    info</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
        <div>
            <a href="{{ route('better.create') }}" class="btn btn-success btn-lg btn-block">Pridėti lažybininką</a>
        </div>
    </div>
@endsection
