@extends('layouts.app')

@section('title', 'Manager Dashboard')

@section('content')
<div class="container">
    <h2 class="mb-4">Dashboard Manager</h2>
    
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Film</h5>
                    <h2>{{ $totalMovies }}</h2>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Film Aktif</h5>
                    <h2>{{ $activeMovies }}</h2>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Pendapatan Bulan Ini</h5>
                    <h2>Rp {{ number_format($monthlyRevenue) }}</h2>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title">Pendapatan Tahun Ini</h5>
                    <h2>Rp {{ number_format($yearlyRevenue) }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 