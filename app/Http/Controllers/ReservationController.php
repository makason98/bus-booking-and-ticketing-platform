<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\BusRoute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\ReservationConfirmed;
use Illuminate\Support\Facades\Storage;

class ReservationController extends Controller
{
    public function store(Request $request)
{
    try {
        $request->merge([
            'currency' => strtoupper($request->input('currency')),
            'isset' => $request->input('isset'),
            'isset_return' => $request->input('isset_return'),
            'pasageri' => $request->input('pasageri'),
        ]);
         $pasageri = $request->input('pasageri');
        $reservations = [];
        if (isset($request->isset)) {
            $validator = Validator::make($request->all(), [
                'first_name.*' => 'required|string|max:255',
                'last_name.*' => 'required|string|max:255',
                'start_place' => 'required|string|max:255',
                'end_place' => 'required|string|max:255',
                'from' => 'required|string|max:255',
                'to' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'email' => 'required|string|email|max:255',
                'remarks' => 'nullable|string',
                'date' => 'required|date',
                'time' => 'required|string|max:255',
                'time_arrival' => 'required|string|max:255',
                'route' => 'required|string|max:255',
                'seats' => 'required|string',
                'currency' => 'required|string|max:255',
                'price' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            ]);

            if ($validator->fails()) {
                return redirect()->route('reservations.show')
                    ->withErrors($validator)
                    ->withInput();
            }

            $reservationNumber = Reservation::generateReservationNumber();

            foreach ($request->first_name as $index => $firstName) {
                $reservation = Reservation::create([
                    'first_name' => $firstName,
                    'last_name' => $request->last_name[$index],
                    'start_place' => $request->start_place,
                    'from' => $request->from,
                    'to' => $request->to,
                    'end_place' => $request->end_place,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'remarks' => $request->remarks,
                    'date' => $request->date,
                    'time' => $request->time,
                    'time_arrival' => $request->time_arrival,
                    'route' => $request->route,
                    'price' => $request->price,
                    'seats' => $request->seats,
                    'currency' => $request->currency,
                    'reservation_number' => $reservationNumber,
                ]);

                $reservations[0] = $reservation;
            }

            $busRoute = BusRoute::firstOrNew([
                'date' => $request->date,
                'direction' => $request->route,
            ]);

            $selectedSeats = explode(',', $request->seats);

            foreach ($selectedSeats as $seat) {
                $busRoute->{'seat_' . $seat} = 1;
            }

            $busRoute->save();

            Storage::makeDirectory('reservations');
        }





        if (isset($request->isset_return)) {
            $validator = Validator::make($request->all(), [
                'first_name.*' => 'required|string|max:255',
                'last_name.*' => 'required|string|max:255',
                'start_place' => 'required|string|max:255',
                'end_place' => 'required|string|max:255',
                'from' => 'required|string|max:255',
                'to' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'email' => 'required|string|email|max:255',
                'remarks' => 'nullable|string',
                'date' => 'required|date',
                'time' => 'required|string|max:255',
                'time_arrival' => 'required|string|max:255',
                'route' => 'required|string|max:255',
                'seats_dus' => 'required|string',
                'currency' => 'required|string|max:255',
                'price' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            ]);

            if ($validator->fails()) {
                return redirect()->route('reservations.show')
                    ->withErrors($validator)
                    ->withInput();
            }

            $reservationNumber = Reservation::generateReservationNumber();

            foreach ($request->first_name as $index => $firstName) {
                $reservation = Reservation::create([
                    'first_name' => $firstName,
                    'last_name' => $request->last_name[$index],
                    'start_place' => $request->start_place,
                    'from' => $request->from,
                    'to' => $request->to,
                    'end_place' => $request->end_place,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'remarks' => $request->remarks,
                    'date' => $request->date,
                    'time' => $request->time,
                    'time_arrival' => $request->time_arrival,
                    'route' => $request->route,
                    'price' => $request->price,
                    'seats' => $request->seats_dus,
                    'currency' => $request->currency,
                    'reservation_number' => $reservationNumber,
                ]);

                $reservations[1] = $reservation;
            }

            $busRoute = BusRoute::firstOrNew([
                'date' => $request->date,
                'direction' => $request->route,
            ]);

            $selectedSeatsDus = explode(',', $request->seats_dus);

            foreach ($selectedSeatsDus as $seat) {
                $busRoute->{'seat_' . $seat} = 1;
            }

            $busRoute->save();

            Storage::makeDirectory('reservations');


            
            $validator = Validator::make($request->all(), [
                'first_name.*' => 'required|string|max:255',
                'last_name.*' => 'required|string|max:255',
                'from_return' => 'required|string|max:255',
                'to_return' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'email' => 'required|string|email|max:255',
                'remarks' => 'nullable|string',
                'time_return' => 'required|string|max:255',
                'time_arrival_return' => 'required|string|max:255',
                'currency' => 'required|string|max:255',
                'price' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
                'start_place_inapoi' => 'required|string|max:255',
                'end_place_inapoi' => 'required|string|max:255',
                'route_return' => 'required|string|max:255',
                'date_return' => 'required|date',
                'seats_inapoi' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->route('reservations.show')
                    ->withErrors($validator)
                    ->withInput();
            }

            $reservationNumber = Reservation::generateReservationNumber();

            foreach ($request->first_name as $index => $firstName) {
                $reservation = Reservation::create([
                    'first_name' => $firstName,
                    'last_name' => $request->last_name[$index],
                    'start_place' => $request->start_place_inapoi,
                    'end_place' => $request->end_place_inapoi,
                    'from' => $request->from_return,
                    'to' => $request->to_return,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'remarks' => $request->remarks,
                    'date' => $request->date_return,
                    'time' => $request->time_return,
                    'time_arrival' => $request->time_arrival_return,
                    'route' => $request->route_return,
                    'price' => $request->price,
                    'seats' => $request->seats_inapoi,
                    'currency' => $request->currency,
                    'reservation_number' => $reservationNumber,
                ]);

                $reservations[2] = $reservation;
            }

            $busRoute = BusRoute::firstOrNew([
                'date' => $request->date_return,
                'direction' => $request->route_return,
            ]);

            $selectedSeatsIntors = explode(',', $request->seats_inapoi);

            foreach ($selectedSeatsIntors as $seat) {
                $busRoute->{'seat_' . $seat} = 1;
            }

            $busRoute->save();

            Storage::makeDirectory('reservations');
        }

        Mail::to($request->email)->send(new ReservationConfirmed($reservations, $request->pasageri));

        // If no exceptions were thrown, redirect to the success page
        return redirect()->route('reservations.show')
            ->with('success', 'Rezervarea creată cu succes!!')
            ->with('isset', $request->isset ?? null)
            ->with('isset_return', $request->isset_return ?? null);
    } catch (\Exception $e) {
        // Log the error and handle the exception
        Log::error('Error creating reservation', [
            'message' => $e->getMessage(),
            'stack_trace' => $e->getTraceAsString(),
            'request_data' => $request->all(),
        ]);
    
        return redirect()->route('reservations.show')
            ->with('error', 'A aparut o eroare in proces, Rezervarea nu este înregistrată: ' . $e->getMessage());
    }
}


    public function show()
    {
        return view('pages.show');
    }
}
