@extends('layouts.app')

@section('title', 'Edit Jadwal Tayang')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit Jadwal Tayang</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('schedules.update', $schedule) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="movie_id" class="form-label">Film</label>
                            <select class="form-select @error('movie_id') is-invalid @enderror" 
                                    id="movie_id" name="movie_id" required>
                                <option value="">Pilih Film</option>
                                @foreach($movies as $movie)
                                    <option value="{{ $movie->id }}" 
                                            {{ old('movie_id', $schedule->movie_id) == $movie->id ? 'selected' : '' }}>
                                        {{ $movie->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('movie_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="show_date" class="form-label">Tanggal Tayang</label>
                            <input type="date" class="form-control @error('show_date') is-invalid @enderror" 
                                   id="show_date" name="show_date" 
                                   value="{{ old('show_date', $schedule->show_date->format('Y-m-d')) }}" required>
                            @error('show_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="show_time" class="form-label">Jam Tayang</label>
                            <input type="time" class="form-control @error('show_time') is-invalid @enderror" 
                                   id="show_time" name="show_time" 
                                   value="{{ old('show_time', $schedule->show_time) }}" required>
                            @error('show_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="available_seats" class="form-label">Jumlah Kursi Tersedia</label>
                            <input type="number" class="form-control @error('available_seats') is-invalid @enderror" 
                                   id="available_seats" name="available_seats" 
                                   value="{{ old('available_seats', $schedule->available_seats) }}" 
                                   min="1" required>
                            @error('available_seats')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       id="is_active" name="is_active" value="1" 
                                       {{ old('is_active', $schedule->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Jadwal Aktif
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Update Jadwal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 