@extends('layouts.app')

@section('title', 'Jadwal Tayang')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Jadwal Tayang</h5>
            <a href="{{ route('schedules.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Jadwal
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Film</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Kursi Tersedia</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($schedules as $schedule)
                            <tr>
                                <td>{{ $schedule->movie->title }}</td>
                                <td>{{ $schedule->show_date->translatedFormat('l, d F Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($schedule->show_time)->format('H:i') }}</td>
                                <td>{{ $schedule->available_seats }}</td>
                                <td>
                                    <span class="badge bg-{{ $schedule->is_active ? 'success' : 'danger' }}">
                                        {{ $schedule->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('schedules.edit', $schedule) }}" 
                                       class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('schedules.destroy', $schedule) }}" 
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
                                <td colspan="6" class="text-center">Tidak ada jadwal tayang</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 