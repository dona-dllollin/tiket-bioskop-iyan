<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Movie;
use App\Models\MovieSchedule;
use App\Models\Seat;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    public function index()
    {
        $bookings = Booking::with(['movieSchedule.movie', 'seats'])->latest()->get();
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $movies = Movie::where('is_showing', true)->get();
        // $schedules = MovieSchedule::where('is_active', true)->get();
        $seats = Seat::where('is_available', true)->get();
        return view('bookings.create', compact('movies', 'seats'));
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'movie_schedule_id' => 'required|exists:movie_schedules,id',
            'customer_name' => 'required|string|max:255',
            'number_of_tickets' => 'required|integer|min:1',
            'seat_ids' => 'required|array|min:1',
            'seat_ids.*' => 'exists:seats,id'
        ]);

        // Hitung total harga
        $schedule = MovieSchedule::with('movie')->find($validated['movie_schedule_id']);
        $totalPrice = $schedule->movie->price * $validated['number_of_tickets'];

        // Buat booking
        $booking = Booking::create([
            'user_id' => auth()->id(),
            'movie_schedule_id' => $validated['movie_schedule_id'],
            'customer_name' => $validated['customer_name'],
            'number_of_tickets' => $validated['number_of_tickets'],
            'total_price' => $totalPrice,
            'status' => 'paid'
        ]);

        // Attach kursi yang dipilih
        $booking->seats()->attach($validated['seat_ids']);

        // Update ketersediaan kursi
        Seat::whereIn('id', $validated['seat_ids'])->update(['is_available' => false]);

        // Update jumlah kursi tersedia di jadwal
        $schedule->decrement('available_seats', $validated['number_of_tickets']);

        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Pemesanan tiket berhasil');
    }

    public function show(Booking $booking)
    {
        $booking->load(['movieSchedule.movie', 'seats']);
        return view('bookings.show', compact('booking'));
    }

    public function getSchedules($movie)
    {
        $schedules = MovieSchedule::where('movie_id', $movie)
            ->where('show_date', '>=', now()->toDateString())
            ->where('is_active', true)
            ->where('available_seats', '>', 0)
            ->get();

        if ($schedules->isEmpty()) {
            return response()->json(['error' => 'No schedules found'], 404);
        }
        return response()->json($schedules);
    }

    public function printTicket(Booking $booking)
    {
        $booking->load(['movieSchedule.movie', 'seats']);
        return view('bookings.ticket', compact('booking'));
    }
}
