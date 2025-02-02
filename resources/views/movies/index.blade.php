@extends('layouts.app')

@section('title', 'Manajemen Film')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Film</h5>
            <a href="{{ route('movies.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Film
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Poster</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Tanggal Rilis</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($movies as $movie)
                            <tr>
                                <td>
                                    <img src="{{ Storage::url($movie->poster) }}" 
                                         alt="{{ $movie->title }}" 
                                         style="height: 50px;">
                                </td>
                                <td>{{ $movie->title }}</td>
                                <td>{{ $movie->category }}</td>
                                <td>Rp {{ number_format($movie->price) }}</td>
                                <td>{{ $movie->release_date->translatedFormat('l, d F Y') }}</td>
                                <td>
                                    <span class="badge bg-{{ $movie->is_showing ? 'success' : 'danger' }}">
                                        {{ $movie->is_showing ? 'Tayang' : 'Tidak Tayang' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('movies.edit', $movie) }}" 
                                       class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('movies.destroy', $movie) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-danger btn-sm" 
                                                onclick="return confirm('Yakin ingin menghapus?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data film</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 