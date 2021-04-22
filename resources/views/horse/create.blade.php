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
                    <div class="card-header">Pridėti naują arklį:</div>
                    <div class="card-body">
                        <form action="{{ route('horse.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Vardas: </label>
                                <input type="text" name="name" class="form-control">
                                @error('name')
                                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Laimėtų rungtynių skaičius: </label>
                                <input type="number" name="wins" class="form-control">
                                @error('wins')
                                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Dalyvautų rungtynių skaičius: </label>
                                <input type="number" name="runs" class="form-control">
                                @error('runs')
                                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Aprašymas: </label>
                                <textarea id="mce" name="about" rows=10 cols=100 class="form-control"></textarea>
                                @error('about')
                                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Pridėti arklį</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
