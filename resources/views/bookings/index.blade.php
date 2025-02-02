@extends('layouts.app')

@section('title', 'Daftar Pemesanan')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Pemesanan</h5>
            <a href="{{ route('bookings.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Pemesanan Baru
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Kode Booking</th>
                            <th>Nama Pemesan</th>
                            <th>Film</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Jumlah Tiket</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                            <tr>
                                <td>{{ $booking->booking_code }}</td>
                                <td>{{ $booking->customer_name }}</td>
                                <td>{{ $booking->movieSchedule->movie->title }}</td>
                                <td>{{ $booking->movieSchedule->show_date->format('d/m/Y') }}</td>
                                <td>{{ $booking->movieSchedule->show_time }}</td>
                                <td>{{ $booking->number_of_tickets }}</td>
                                <td>Rp {{ number_format($booking->total_price) }}</td>
                                <td>
                                    <span class="badge bg-success">{{ $booking->status }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('bookings.show', $booking) }}" 
                                       class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('bookings.print', $booking) }}" 
                                       class="btn btn-primary btn-sm" target="_blank">
                                        <i class="fas fa-print"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Tidak ada data pemesanan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 