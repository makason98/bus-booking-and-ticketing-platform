<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Route;
use App\Models\Destination;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index()
    {
        $routes = Route::all();
        return view('admin.routes.index', compact('routes'));
    }

    public function create()
    {
        $destinations = Destination::all();
        $destinations_invers = Destination::orderBy('created_at', 'desc')->get();
        return view('admin.routes.create', compact('destinations','destinations_invers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'route_tur' => 'required|string|max:255',
            'route_retur' => 'required|string|max:255',
            'start_place' => 'required|string|max:255',
            'end_place' => 'required|string|max:255',
            'start_time' => 'required',
            'arrival_time' => 'required',
            'price' => 'required|numeric',
            'price_ron' => 'required|numeric'
        ]);

        Route::create($request->all());
        return redirect()->route('admin.routes.index')->with('success', 'Rută creeată cu succes.');
    }

    public function show(Route $route)
    {
        return view('admin.routes.show', compact('route'));
    }

    public function edit(Route $route)
    {
        return view('admin.routes.edit', compact('route'));
    }

    public function update(Request $request, Route $route)
    {
        $request->validate([
            'route_tur' => 'required|string|max:255',
            'route_retur' => 'required|string|max:255',
            'start_place' => 'required|string|max:255',
            'end_place' => 'required|string|max:255',
            'start_time' => 'required',
            'arrival_time' => 'required',
            'price' => 'required|numeric',
            'price_ron' => 'required|numeric'
        ]);

        $route->update($request->all());
        return redirect()->route('admin.routes.index')->with('success', 'Rută modificată cu succes');
    }

    public function destroy(Route $route)
    {
        $route->delete();
        return redirect()->route('admin.routes.index')->with('success', 'Rută stearsă cu succes');
    }
}

