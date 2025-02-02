@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h2 class="mb-4">Dashboard Admin</h2>
    
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Pemesanan Hari Ini</h5>
                    <h2>{{ $todayBookings }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h5 class="card-title mb-0">Film yang Sedang Tayang</h5>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($activeMovies as $movie)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="{{ Storage::url($movie->poster) }}" class="card-img-top" alt="{{ $movie->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $movie->title }}</h5>
                            <p class="card-text">
                                <small class="text-muted">{{ $movie->category }}</small>
                            </p>
                            <a href="{{ route('bookings.create', ['movie' => $movie->id]) }}" 
                               class="btn btn-primary btn-sm">Pesan Tiket</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection 