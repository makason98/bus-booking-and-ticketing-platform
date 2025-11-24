<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Route;
use App\Models\Stop;
use App\Models\BusRoute;
use Illuminate\Http\Request;
use Carbon\Carbon;


class GuestRouteController extends Controller
{

    public function index(Request $request)
    {
        $destinations = Destination::all();
        $destinations_invers = Destination::orderBy('created_at', 'desc')->get();
    
        $searchResults = null;
        $searchResults1 = collect();
        $searchResults2 = collect();
        $searchResults3= collect();
        $stopResults1 = collect();
        $stopResults2 = collect();
        $occupiedSeats = [];
    
        if ($request->isMethod('post')) {
            $data = $request->all();
    
            if ($data['trip_type'] !== 'dus-intors') {
                unset($data['return']);
            }
    
            Carbon::setLocale('ro');
    
            if (isset($data['depart'])) {
                $data['depart_formatted'] = Carbon::parse($data['depart'])->translatedFormat('d F Y');
            }
    
            if (isset($data['return'])) {
                $data['return_formatted'] = Carbon::parse($data['return'])->translatedFormat('d F Y');
            }
    
            // Direct routes query
            $searchResults1 = Route::where('route_tur', $data['from'])
            ->where('route_retur', $data['to'])
            ->orderBy('start_time', 'ASC')
            ->get();
    
            $searchResults2 = Route::where('route_tur', $data['to'])
                                   ->where('route_retur', $data['from'])
                                    ->orderBy('start_time', 'ASC')
                                   
                                    
                                   ->get();
           $searchResults3 = Route::where('route_tur', $data['from'])
                                   ->where('route_retur', $data['to'])
                                   ->orderBy('start_time', 'ASC')
                                   ->get();                       
    
            // Fetch routes by stops
            $stopsFrom = Stop::where('route_stop', $data['from'])->with('route.stops')
            ->orderBy('stop_time', 'ASC')
            ->get();
            foreach ($stopsFrom as $stop) {
                if ($stop->route) {
                    $stops = $stop->route->stops->pluck('route_stop')->toArray();
                    $fromIndex = array_search($data['from'], $stops);
                    $toIndex = array_search($data['to'], $stops);
                    if ($fromIndex !== false && $toIndex !== false && $fromIndex < $toIndex) {
                        $stopResults1->push($stop->route);
                    }
                }
            }
    
            $stopsTo = Stop::where('route_stop', $data['to'])->with('route.stops')
            
            ->get();
            foreach ($stopsTo as $stop) {
                if ($stop->route) {
                    $stops = $stop->route->stops->pluck('route_stop')->toArray();
                    $fromIndex = array_search($data['from'], $stops);
                    $toIndex = array_search($data['to'], $stops);
                    if ($fromIndex !== false && $toIndex !== false && $fromIndex < $toIndex) {
                        $stopResults2->push($stop->route);
                    }
                }
            }
    
            // Fetch routes where either `route_tur` or `route_retur` matches with stops
            $stopToRouteQuery1 = Route::whereHas('stops', function ($query) use ($data) {
                $query->where('route_stop', $data['to']);
            })->where('route_tur', $data['from'])
            ->orderBy('start_time', 'ASC')
              ->get();
    
            $stopToRouteQuery2 = Route::whereHas('stops', function ($query) use ($data) {
                $query->where('route_stop', $data['from']);
            })->where('route_retur', $data['to'])
            ->orderBy('arrival_time', 'ASC')
              ->get();
    
            $searchResults1 = $searchResults1->merge($stopResults1)->merge($stopToRouteQuery1);
            $searchResults2 = $searchResults2->merge($stopResults2)->merge($stopToRouteQuery2);
            $searchResults3 = $searchResults3->merge($stopResults2)->merge($stopToRouteQuery2);
    
            $searchResults = $data;
    
            // Fetch bus routes for each route and time combination
            $combinedResults = $searchResults1->merge($searchResults2);
            foreach ($combinedResults as $result) {
                $time = $result->start_time;
                $routeId = $result->id;
                $busRoutes = BusRoute::where('date', $data['depart'])
                    ->where('direction', $routeId)
                    ->get();
    
                foreach ($busRoutes as $busRoute) {
                    for ($i = 1; $i <= 20; $i++) {
                        if ($busRoute->{'seat_' . $i}) {
                            $occupiedSeats[$result->id][$time][] = $i;
                        }
                    }
                }
            }
        }
    
        $today = Carbon::today()->toDateString();
    
        return view('pages.index', compact('destinations', 'destinations_invers', 'searchResults', 'searchResults1', 'searchResults2', 'today', 'occupiedSeats','searchResults3',));
    }
    
    
    


public function create(Request $request)
{
    $searchResults = json_decode($request->input('searchResults'), true);

    if ($searchResults['trip_type'] == 'dus-intors') {
        $dateDus = $searchResults['depart'];
        $dateIntors = $searchResults['return'];

        $selectedRoute = json_decode($request->input('selectedDusRoute'));
        $selectedRetourRoute = json_decode($request->input('selectedIntorsRoute'));
        $selectedStop1 = json_decode($request->input('selectedStop1'));
        $selectedStop2 = json_decode($request->input('selectedStop2'));
        $selectedStops1 = json_decode($request->input('selectedStops1'));
        $selectedStops2 = json_decode($request->input('selectedStops2'));

        $selectedInapoiStop1 = json_decode($request->input('selectedInapoiStop1'));
        $selectedInapoiStop2 = json_decode($request->input('selectedInapoiStop2'));
        $selectedInapoiStops1 = json_decode($request->input('selectedInapoiStops1'));
        $selectedInapoiStops2 = json_decode($request->input('selectedInapoiStops2'));

        $timeDus = $selectedRoute->start_time;
        $directionDus = $selectedRoute->id;

        $timeIntors = $selectedRetourRoute->start_time;
        $directionIntors = $selectedRetourRoute->id;

        // Retrieve the bus routes
        $busRouteDus = BusRoute::where('date', $dateDus)
            ->where('direction', $directionDus) 
            ->first();

        $busRouteIntors = BusRoute::where('date', $dateIntors)
            ->where('direction', $directionIntors)
            ->first();

        // Determine occupied seats
        $occupiedSeatsDus = [];
        $occupiedSeatsIntors = [];

        if ($busRouteDus) {
            for ($i = 1; $i <= 20; $i++) {
                if ($busRouteDus->{'seat_' . $i}) {
                    $occupiedSeatsDus[] = $i;
                }
            }
        }

        if ($busRouteIntors) {
            for ($i = 1; $i <= 20; $i++) {
                if ($busRouteIntors->{'seat_' . $i}) {
                    $occupiedSeatsIntors[] = $i;
                }
            }
        }
    } else {
        $occupiedSeatsIntors = null;
        $dateDus = $searchResults['depart'];
        $selectedRetourRoute = null;
        $dateIntors = null;
        $timeIntors = null;
        $directionIntors = null;
        $selectedRoute = json_decode($request->input('selectedRoute'));
        $selectedStop1 = json_decode($request->input('selectedStop1'));
        $selectedStop2 = json_decode($request->input('selectedStop2'));
        $selectedStops1 = json_decode($request->input('selectedStops1'));
        $selectedStops2 = json_decode($request->input('selectedStops2'));
        
        

        $selectedInapoiStop1 = null;
        $selectedInapoiStop2 = null;
        $selectedInapoiStops1 = null;
        $selectedInapoiStops2 = null;

        $occupiedSeatsDus = [];

        $timeDus = $selectedRoute->start_time;
        $directionDus = $selectedRoute->id;

        // Retrieve the bus route for dus
        $busRouteDus = BusRoute::where('date', $dateDus)
            ->where('direction', $directionDus)
            ->first();

        // Determine occupied seats for dus
        $occupiedSeatsDus = [];
        if ($busRouteDus) {
            for ($i = 1; $i <= 20; $i++) {
                if ($busRouteDus->{'seat_' . $i}) {
                    $occupiedSeatsDus[] = $i;
                }
            }
        }
    }
    $price = 0;

    $today = now()->format('Y-m-d');
    

    // Pass data to the view
    return view('pages.create', compact('searchResults', 'selectedRoute','selectedStop1','selectedStop2','selectedStops1','selectedStops2', 'occupiedSeatsDus', 'occupiedSeatsIntors', 'dateDus', 'dateIntors','today', 'timeDus', 'timeIntors', 'directionDus', 'directionIntors', 'selectedRetourRoute',
    'selectedInapoiStop1','selectedInapoiStop2','selectedInapoiStops1','selectedInapoiStops2', 'price'
    
));
}

    
public function selectIntors(Request $request)
{
    $searchResults = json_decode($request->input('searchResults'), true);
    $selectedDusRoute = json_decode($request->input('selectedDusRoute'), true);
    $selectedStop1 = json_decode($request->input('selectedDusStop1'), true);
    $selectedStop2 = json_decode($request->input('selectedDusStop2'), true);
    $selectedStops1 = json_decode($request->input('selectedDusStops1'), true);
    $selectedStops2 = json_decode($request->input('selectedDusStops2'), true);
    $occupiedSeats = []; // Initialize the variable for occupied seats

    // Fetch the "Întors" routes based on the "Dus" selection
    $searchResults2 = Route::where('route_tur', $selectedDusRoute['route_retur'])
                           ->where('route_retur', $selectedDusRoute['route_tur'])
                           ->orderBy('start_time', 'ASC')
                           ->get();

                           
                           foreach ($searchResults2 as $result) {
                            $time = $result->start_time;
                            $routeId = $result->id; // Assuming `id` is the field you want to use
                            $busRoutes = BusRoute::where('date', $searchResults['return'])
                                ->where('direction', $routeId)
                                ->get();
                
                            foreach ($busRoutes as $busRoute) {
                                for ($i = 1; $i <= 20; $i++) {
                                    if ($busRoute->{'seat_' . $i}) {
                                        $occupiedSeats[$result->id][$time][] = $i; // Store occupied seats by route id and time
                                    }
                                }
                            }
                        }

    return view('pages.select-intors', compact('searchResults', 'selectedDusRoute', 'searchResults2','occupiedSeats','selectedStop1','selectedStop2','selectedStops1','selectedStops2'));
}

public function saveSeats(Request $request)
{
    $seats = $request->input('seats');
    $date = $request->input('date');
    $time = $request->input('time');
    $direction = $request->input('direction');

    $seatsDus = $request->input('seatsDus');
    $dateDus = $request->input('dateDus');
    $timeDus = $request->input('timeDus');
    $directionDus = $request->input('directionDus');

    $seatsIntors = $request->input('seatsIntors');
    $dateIntors = $request->input('dateIntors');
    $timeIntors = $request->input('timeIntors');
    $directionIntors = $request->input('directionIntors');

    $request->validate([

        'seats' => 'required|array',
        'seats.*' => 'required|string',
        'date' => 'required|date',
        'time' => 'required|date_format:H:i:s',
        'direction' => 'required|string|max:255',

        'seatsDus' => 'required|array',
        'seatsDus.*' => 'required|string',
        'dateDus' => 'required|date',
        'timeDus' => 'required|date_format:H:i:s',
        'directionDus' => 'required|string|max:255',

        'seatsIntors' => 'required|array',
        'seatsIntors.*' => 'required|string',
        'dateIntors' => 'required|date',
        'timeIntors' => 'required|date_format:H:i:s',
        'directionIntors' => 'required|string|max:255',
    ]);

    session([
        
        'selectedSeats' => $seats,
        'date' => $date,
        'time' => $time,
        'direction' => $direction,

        'selectedSeatsDus' => $seatsDus,
        'dateDus' => $dateDus,
        'timeDus' => $timeDus,
        'directionDus' => $directionDus,

        'selectedSeatsIntors' => $seatsIntors,
        'dateIntors' => $dateIntors,
        'timeIntors' => $timeIntors,
        'directionIntors' => $directionIntors,
    ]);

    return response()->json(['selectedSeatsDus' => $seatsDus, 'selectedSeatsIntors' => $seatsIntors], ['selectedSeats' => $seats]);
}
    

}
