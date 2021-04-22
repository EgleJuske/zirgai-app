@extends('layouts.app')
@section('content')
    @if (session('status_success'))
        <div class="alert alert-success" role="alert">{{ session('status_success') }}</div>
    @endif
    @if (session('status_error'))
        <div class="alert alert-danger" role="alert">{{ session('status_error') }}</div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Pridėti naują lažybininką:</div>
                    <div class="card-body">
                        <form action="{{ route('better.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Vardas: </label>
                                <input type="text" name="name" class="form-control">
                                @error('name')
                                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Pavardė: </label>
                                <input type="text" name="surname" class="form-control">
                                @error('surname')
                                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Arklys: </label>
                                <select name="horse_id" id="" class="form-control">
                                    <option value="" selected disabled>Pasirinkite arklį</option>
                                    @foreach ($horses as $horse)
                                        <option value="{{ $horse->id }}">{{ $horse->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Statoma suma eur: </label>
                                <input type="number" name="bet" class="form-control">
                                @error('bet')
                                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Pridėti lažybininką</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
