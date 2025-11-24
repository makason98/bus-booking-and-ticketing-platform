<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;

class Destinations extends Controller
{
    public function index()
    {
        $destinations = Destination::all();
        return view('admin.destinations.index', compact('destinations'));
    }

    public function create()
    {
        return view('admin.destinations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'route_tur' => 'required|string|max:255',
        ]);

        Destination::create($request->all());
        return redirect()->route('admin.destinations.index')->with('success', 'Destinație creeată cu succes.');
    }

    public function edit(Destination $destination)
    {
        return view('admin.destinations.edit', compact('destination')  );
    }

    public function update(Request $request, Destination $destination)
    {
        $request->validate([
            'route_tur' => 'required|string|max:255',
        ]);

        $destination->update($request->all());
        return redirect()->route('admin.destinations.index')->with('success', 'Destinație modificată cu succes');
    }

    public function destroy(Destination $destination)
    {
        $destination->delete();
        return redirect()->route('admin.destinations.index')->with('success', 'Destinație stearsă cu succes');
    }
}

