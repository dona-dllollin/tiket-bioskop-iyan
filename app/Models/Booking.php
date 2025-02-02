<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'booking_code',
        'user_id',
        'movie_schedule_id',
        'customer_name',
        'number_of_tickets',
        'total_price',
        'status'
    ];

    protected $casts = [
        'total_price' => 'decimal:2'
    ];

    // Generate kode booking otomatis
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            $booking->order_number = 'ORD' . date('YmdHis') . rand(1000, 9999);
            $booking->booking_code = 'BK' . date('YmdHis') . rand(100, 999);
        });
    }

    // Relasi dengan user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan jadwal film
    public function movieSchedule()
    {
        return $this->belongsTo(MovieSchedule::class);
    }


    // Relasi dengan kursi
    public function seats()
    {
        return $this->belongsToMany(Seat::class);
    }
}
