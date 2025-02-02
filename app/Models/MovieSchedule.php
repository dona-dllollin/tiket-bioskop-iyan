<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'movie_id',
        'show_date',
        'show_time',
        'available_seats',
        'is_active'
    ];

    protected $casts = [
        'show_date' => 'date',
        'show_time' => 'datetime',
        'is_active' => 'boolean'
    ];

    
    // Relasi dengan film
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    // Relasi dengan booking
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

}
