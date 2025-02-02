<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'poster',
        'price',
        'release_date',
        'category',
        'is_showing'
    ];

    protected $casts = [
        'release_date' => 'date',
        'price' => 'decimal:2',
        'is_showing' => 'boolean'
    ];

    // Relasi dengan jadwal tayang
    public function schedules()
    {
        return $this->hasMany(MovieSchedule::class);
    }


}
