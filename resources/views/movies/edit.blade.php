@extends('layouts.app')

@section('title', 'Edit Film')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit Film: {{ $movie->title }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('movies.update', $movie) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Film</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $movie->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3">{{ old('description', $movie->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Kategori</label>
                            <select class="form-select @error('category') is-invalid @enderror" 
                                    id="category" name="category" required>
                                <option value="">Pilih Kategori</option>
                                <option value="anak-anak" {{ old('category', $movie->category) == 'anak-anak' ? 'selected' : '' }}>
                                    Anak-anak
                                </option>
                                <option value="dewasa" {{ old('category', $movie->category) == 'dewasa' ? 'selected' : '' }}>
                                    Dewasa
                                </option>
                                <option value="semua umur" {{ old('category', $movie->category) == 'semua umur' ? 'selected' : '' }}>
                                    Semua Umur
                                </option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="price" class="form-label">Harga Tiket</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                   id="price" name="price" value="{{ old('price', $movie->price) }}" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="release_date" class="form-label">Tanggal Rilis</label>
                            <input type="date" class="form-control @error('release_date') is-invalid @enderror" 
                                   id="release_date" name="release_date" 
                                   value="{{ old('release_date', $movie->release_date->format('Y-m-d')) }}" required>
                            @error('release_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="poster" class="form-label">Poster Film</label>
                            <input type="file" class="form-control @error('poster') is-invalid @enderror" 
                                   id="poster" name="poster" accept="image/*">
                            <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah poster</small>
                            @if($movie->poster)
                                <div class="mt-2">
                                    <img src="{{ Storage::url($movie->poster) }}" 
                                         alt="Current Poster" 
                                         style="max-height: 100px;">
                                </div>
                            @endif
                            @error('poster')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       id="is_showing" name="is_showing" value="1" 
                                       {{ old('is_showing', $movie->is_showing) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_showing">
                                    Film Sedang Tayang
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Update Film</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 