<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return view('movies.index', compact('movies'));
    }


    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request)
    {


        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'poster' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'price' => 'required|numeric|min:0',
            'release_date' => 'required|date',
            'category' => 'required|in:anak-anak,dewasa,semua umur',
            'is_showing' => 'boolean'
        ]);

        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
            $validated['poster'] = $posterPath;
        }

        $validated['is_showing'] = $request->has('is_showing') ? true : false;


        Movie::create($validated);
        return redirect()->route('movies.index')->with('success', 'Film berhasil ditambahkan');
    }

    public function edit(Movie $movie)
    {
        return view('movies.edit', compact('movie'));
    }

    public function update(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'price' => 'required|numeric|min:0',
            'release_date' => 'required|date',
            'category' => 'required|in:anak-anak,dewasa,semua umur',
            'is_showing' => 'boolean'
        ]);

        if ($request->hasFile('poster')) {
            // Hapus poster lama
            if ($movie->poster) {
                Storage::disk('public')->delete($movie->poster);
            }
            $posterPath = $request->file('poster')->store('posters', 'public');
            $validated['poster'] = $posterPath;
        }
        $validated['is_showing'] = $request->has('is_showing') ? true : false;

        $movie->update($validated);
        return redirect()->route('movies.index')->with('success', 'Film berhasil diperbarui');
    }


    public function destroy(Movie $movie)
    {
        if ($movie->poster) {
            Storage::disk('public')->delete($movie->poster);
        }
        $movie->delete();
        return redirect()->route('movies.index')->with('success', 'Film berhasil dihapus');
    }


    public function search(Request $request)
    {
        $query = $request->get('query');
        $movies = Movie::where('title', 'like', "%{$query}%")->get();
        return view('movies.index', compact('movies'));
    }
}
