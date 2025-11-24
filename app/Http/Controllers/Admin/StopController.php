<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Route;
use App\Models\Destination;
use App\Models\Stop;
use Illuminate\Http\Request;

class StopController extends Controller
{
    public function index(Route $route)
    {
        $stops = $route->stops;
        return view('admin.stops.index', compact('route', 'stops'));
    }

    public function create(Route $route)
    {
        $destinations = Destination::all();
        $destinations_invers = Destination::orderBy('created_at', 'desc')->get();
        return view('admin.stops.create', compact('route','destinations','destinations_invers'));
    }

    public function store(Request $request, Route $route)
    {
        $request->validate([
            'route_stop' => 'required|string|max:255',
            'pickup' => 'required|string|max:255',
            'stop_time' => 'required',
            'price' => 'required|numeric',
            'price_ron' => 'required|numeric'
        ]);

        $route->stops()->create($request->all());
        return redirect()->route('admin.stops.index', $route)->with('success', 'Oprire creată cu succes');
    }

    public function show(Route $route, Stop $stop)
    {
        return view('admin.stops.show', compact('route', 'stop'));
    }

    public function edit(Route $route, Stop $stop)
    {
        return view('admin.stops.edit', compact('route', 'stop'));
    }

    public function update(Request $request, Route $route, Stop $stop)
    {
        $request->validate([
            'route_stop' => 'required|string|max:255',
            'pickup' => 'required|string|max:255',
            'stop_time' => 'required',
            'price' => 'required|numeric',
            'price_ron' => 'required|numeric'
        ]);

        $stop->update($request->all());
        return redirect()->route('admin.stops.index', $route)->with('success', 'Oprire modificată cu succes');
    }

    public function destroy(Route $route, Stop $stop)
    {
        $stop->delete();
        return redirect()->route('admin.stops.index', $route)->with('success', 'Oprire ștearsă cu succes');
    }
}
