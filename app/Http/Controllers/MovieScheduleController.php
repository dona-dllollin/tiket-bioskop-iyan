<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieSchedule;
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
            'available_seats' => 'required|integer|min:1',
            'is_active' => 'boolean'
        ]);

        MovieSchedule::create($validated);
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
