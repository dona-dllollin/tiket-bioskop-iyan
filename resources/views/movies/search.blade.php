@extends('layouts.app')

@section('title', 'Cari Film')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Cari Film</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('movies.search') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="query" class="form-control" 
                           placeholder="Masukkan judul film..." value="{{ request('query') }}">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
            </form>

            @if(isset($movies))
                <div class="row">
                    @forelse($movies as $movie)
                        <div class="col-md-3 mb-4">
                            <div class="card h-100">
                                <img src="{{ Storage::url($movie->poster) }}" 
                                     class="card-img-top" alt="{{ $movie->title }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $movie->title }}</h5>
                                    <p class="card-text">
                                        <small class="text-muted">Kategori: {{ $movie->category }}</small><br>
                                        <small class="text-muted">Harga: Rp {{ number_format($movie->price) }}</small>
                                    </p>
                                    <a href="{{ route('bookings.create', ['movie' => $movie->id]) }}" 
                                       class="btn btn-primary btn-sm">Pesan Tiket</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info">
                                Tidak ada film yang ditemukan.
                            </div>
                        </div>
                    @endforelse
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 