<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieSchedule;
use App\Models\Seat;
use Illuminate\Http\Request;

class MovieScheduleController extends Controller
{
    public function index()
    {
        $schedules = MovieSchedule::with('movie')->get();
        return view('schedules.index', compact('schedules'));
    }

    public function create()
    {
        $movies = Movie::where('is_showing', true)->get();
        return view('schedules.create', compact('movies'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'show_date' => 'required|date|after_or_equal:today',
            'show_time' => 'required',
            'available_seats' => 'required|integer|min:1|max:70',
            'is_active' => 'boolean'
        ]);

        MovieSchedule::create($validated);

        $rows = ['A', 'B', 'C', 'D', 'F', 'G'];
        $totalSeats = $request->available_seats;
        $seats = [];
        $seatIndex = 0;

        for ($i = 0; $i < $totalSeats; $i++) {
            $row = $rows[intdiv($seatIndex, 10)]; // Tentukan baris berdasarkan index kursi (maks 10 per baris)
            $number = ($seatIndex % 10) + 1; // Nomor kursi dari 1-10
            $seats[] = [
                'movie_schedule_id' => $request->movie_id,
                'seat_number' => $row . $number,
                'is_available' => true, // Default status
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $seatIndex++;
        }

        // Simpan ke database
        Seat::insert($seats);


        return redirect()->route('schedules.index')
            ->with('success', 'Jadwal tayang berhasil ditambahkan');
    }

    public function edit(MovieSchedule $schedule)
    {
        $movies = Movie::where('is_showing', true)->get();
        return view('schedules.edit', compact('schedule', 'movies'));
    }


    public function update(Request $request, MovieSchedule $schedule)
    {
        $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'show_date' => 'required|date',
            'show_time' => 'required',
            'available_seats' => 'required|integer|min:1',
            'is_active' => 'boolean'
        ]);

        $schedule->update($validated);
        return redirect()->route('schedules.index')
            ->with('success', 'Jadwal tayang berhasil diperbarui');
    }


    public function destroy(MovieSchedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedules.index')
            ->with('success', 'Jadwal tayang berhasil dihapus');
    }
}
