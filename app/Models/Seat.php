<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = [
        'seat_number',
        'is_available'
    ];

    protected $casts = [
        'is_available' => 'boolean'
    ];

    // Relasi dengan booking
    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_seat');
    }
}
