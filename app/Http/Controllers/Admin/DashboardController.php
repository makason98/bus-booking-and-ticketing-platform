<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\BusRoute;
use App\Models\Route;
use PDF;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservation::with('busRoute')->latest();
    
        if ($request->filled('date') && $request->filled('route')) {
            $query->where('date', $request->input('date'))
                  ->where('route', $request->input('route'));
        } elseif ($request->filled('search')) {
            $query->where('reservation_number', 'like', "%{$request->input('search')}%");
        }
    
        $reservations = $query->paginate(50);
    
        $routes = Route::orderBy('start_time', 'asc')->get();


       
            
           

        $selectedRouteDetails = null;
        if ($request->filled('route')) {
            $selectedRoute = Route::find($request->input('route'));
            if ($selectedRoute) {
                $selectedRouteDetails = [
                    'route_tur' => $selectedRoute->route_tur,
                    'route_retur' => $selectedRoute->route_retur,
                ];
            }
        }
    
        return view('admin.dashboards.index', compact('reservations', 'routes', 'selectedRouteDetails'));
    }

     public function show($id)
    {
        $reservation = Reservation::with('busRoute')->findOrFail($id);

        return view('admin.dashboards.show', compact('reservation'));
    }

    public function downloadPdf(Request $request)
{
    $date = $request->input('date');
    $route = $request->input('route');

    $reservations = Reservation::where('date', $date)
                                ->where('route', $route)
                                ->with('busRoute')
                                ->get();

    $busRoutes = BusRoute::where('date', $date)
                         ->where('direction', $route)
                         ->get();

    $occupiedSeats = 0;

    foreach ($busRoutes as $busRoute) {
        for ($i = 1; $i <= 20; $i++) {
            if ($busRoute->{'seat_' . $i}) {
                $occupiedSeats++;
            }
        }
    }
    $selectedRouteDetails = null;
    if ($request->filled('route')) {
        $selectedRoute = Route::find($request->input('route'));
        if ($selectedRoute) {
            $selectedRouteDetails = [
                'route_tur' => $selectedRoute->route_tur,
                'route_retur' => $selectedRoute->route_retur,
            ];
        }
    }

    $data = [
        'selectedRouteDetails' => $selectedRouteDetails,
        'reservations' => $reservations,
        'occupiedSeats' => $occupiedSeats,
    ];

    $pdf = PDF::loadView('admin.dashboards.pdf', $data);
    $filename = 'reservations_' . $date . '.pdf'; // Dynamic filename based on date
    return $pdf->download($filename);
}

    
}
