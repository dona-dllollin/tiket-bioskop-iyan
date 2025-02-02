@extends('layouts.app')

@section('title', 'Detail Pemesanan')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detail Pemesanan</h5>
            <a href="{{ route('bookings.print', $booking) }}" class="btn btn-primary btn-sm" target="_blank">
                <i class="fas fa-print"></i> Cetak Tiket
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th width="200">Nomor Order</th>
                            <td>: {{ $booking->order_number }}</td>
                        </tr>
                        <tr>
                            <th>Kode Booking</th>
                            <td>: {{ $booking->booking_code }}</td>
                        </tr>
                        <tr>
                            <th>Nama Pemesan</th>
                            <td>: {{ $booking->customer_name }}</td>
                        </tr>
                        <tr>
                            <th>Judul Film</th>
                            <td>: {{ $booking->movieSchedule->movie->title }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Tayang</th>
                            <td>: {{ $booking->movieSchedule->show_date->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Jam Tayang</th>
                            <td>: {{ $booking->movieSchedule->show_time }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah Tiket</th>
                            <td>: {{ $booking->number_of_tickets }}</td>
                        </tr>
                        <tr>
                            <th>Nomor Kursi</th>
                            <td>: {{ $booking->seats->pluck('seat_number')->implode(', ') }}</td>
                        </tr>
                        <tr>
                            <th>Total Pembayaran</th>
                            <td>: Rp {{ number_format($booking->total_price) }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>: <span class="badge bg-success">{{ $booking->status }}</span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 