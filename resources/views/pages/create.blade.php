@extends('layouts.view')

@section('content')

<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-7xl mx-auto bg-white shadow-md rounded-md p-6 border border-gray-300">
        <!-- Header -->
        <div class="flex items-center space-x-2 mb-6">
            <a href="{{ route('home') }}" class="bg-blue-600 text-white font-bold py-1 px-4 rounded-full hover:bg-blue-700 transition duration-300">Înapoi</a>
            <h1 class="text-xl font-semibold">Datele pasagerilor</h1>
        </div>

        <!-- Main Content and Sidebar -->
        <div class="md:flex md:space-x-6 items-start">
            <!-- Main Content -->
            <div class="flex-1">
               <form action="{{ route('reservations.store') }}" method="POST" id="reservationForm">
                    @csrf
                    <div class="bg-white rounded-lg shadow p-4 mb-6 border border-gray-300">
                        <div class="flex items-center space-x-2 text-blue-600 mb-4">
                            <div class="bg-blue-600 text-white rounded-full w-8 h-8 flex items-center justify-center">1</div>
                            <h2 class="font-semibold text-black">Pasageri</h2>
                        </div>
                        @php
                            $numberOfPassangers = $searchResults['passangers'] ?? 0; // Ensure $searchResults['passangers'] exists
                        @endphp
                        @for ($i = 1; $i <= $numberOfPassangers; $i++)
                        <div class="mb-4">
                            <label class="block mb-2">Pasager {{ $i }}</label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="nume_{{ $i }}" class="block text-sm font-medium text-gray-700">Nume*</label>
                                    <input type="text" name="first_name[]" id="nume_{{ $i }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                </div>
                                <div>
                                    <label for="prenume_{{ $i }}" class="block text-sm font-medium text-gray-700">Prenume*</label>
                                    <input type="text" name="last_name[]" id="prenume_{{ $i }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>

                                        <!-- Select Seat Section Dus -->
                            <div class="bg-white rounded-lg shadow p-4 mb-6 border border-gray-300">
                                <div class="flex items-center space-x-2 text-blue-600 mb-4">
                                    <div class="bg-blue-600 text-white rounded-full w-8 h-8 flex items-center justify-center">2</div>
                                    <h2 class="font-semibold text-black">Selectare loc - Dus</h2>
                                </div>
                                <div>
                                    <a href="#" id="selectSeatBtn" class="block bg-white border border-blue-600 text-black font-bold rounded-full px-4 py-2 text-center">Selectează-ți locul</a>
                                </div>
                            </div>

                            @if(isset($searchResults) && $searchResults['trip_type'] === 'dus-intors')
                            <!-- Select Seat Section Întors-->
                            <div class="bg-white rounded-lg shadow p-4 mb-6 border border-gray-300">
                                <div class="flex items-center space-x-2 text-blue-600 mb-4">
                                    <div class="bg-blue-600 text-white rounded-full w-8 h-8 flex items-center justify-center">2</div>
                                    <h2 class="font-semibold text-black">Selectare loc - Întors</h2>
                                </div>
                                <div>
                                    <a href="#" id="selectSeatBtnIntors" class="block bg-white border border-blue-600 text-black font-bold rounded-full px-4 py-2 text-center">Selectează-ți locul</a>
                                </div>
                            </div>
                            @endif

                    <!-- Contact Information Section -->
                    <div class="bg-white rounded-lg shadow p-4 mb-6 border border-gray-300">
                        <div class="flex items-center space-x-2 text-blue-600 mb-4">
                            <div class="bg-blue-600 text-white rounded-full w-8 h-8 flex items-center justify-center">3</div>
                            <h2 class="font-semibold text-black">Date de contact</h2>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Telefon*</label>
                                <div class="mt-1">
                                    <input type="tel" name="phone" id="phone" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                </div>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email*</label>
                                <input type="email" name="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-4 mb-6 border border-gray-300">
                        <div class="flex items-center space-x-2 text-blue-600 mb-4">
                            <div class="bg-blue-600 text-white rounded-full w-8 h-8 flex items-center justify-center">4</div>
                            <h2 class="font-semibold text-black">Mentiuni</h2>
                        </div>
                        <div>
                            <label for="remarks" class="block text-sm font-medium text-gray-700">Mentiuni</label>
                            <input type="text" name="remarks" id="remarks" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>
                    @if(isset($searchResults) && $searchResults['trip_type'] === 'dus')
                     <input type="hidden" name="isset" value="{{ $selectedRoute->id }}">
                     <input type="hidden" name="trip" value="{{ $searchResults['trip_type'] ?? '' }}">
                    <input type="hidden" name="currency" value="{{ $searchResults['currency'] }}">
                    <input type="hidden" name="pasageri" value="{{ $searchResults['passangers'] ?? '' }}">
                    <input type="hidden" name="date" value="{{ $searchResults['depart'] }}">
                    <input type="hidden" name="route" value="{{ $selectedRoute->id }}">
                    <input type="hidden" name="time_arrival" value="{{ $selectedRoute->arrival_time }}">
                    <input type="hidden" name="from" value="{{ $searchResults['from']}}">
                    <input type="hidden" name="to" value="{{ $searchResults['to'] }}">
                    @if($selectedStops1 && !is_null($selectedStops1))
                        <input type="hidden" name="time" value="{{ $selectedStops1->stop_time }}">
                    @else
                        @if(($selectedStop1 && !is_null($selectedStop1)) || ($selectedStop2 && !is_null($selectedStop2)))
                            <input type="hidden" name="time" value="{{ $selectedStop1->stop_time ?? ($selectedRoute->start_time ?? '') }}">
                        @else
                          <input type="hidden" name="time" value="{{ $timeDus}}">
                        @endif
                    @endif
                    @if($selectedStops1 && !is_null($selectedStops1))
                        <input type="hidden" name="time_arrival" value="{{ $selectedStops2->stop_time }}">
                    @else
                        @if(($selectedStop1 && !is_null($selectedStop1)) || ($selectedStop2 && !is_null($selectedStop2)))
                            <input type="hidden" name="time_arrival" value="{{ $selectedStop2->stop_time ?? ($selectedRoute->arrival_time ?? '') }}">
                        @else
                          <input type="hidden" name="time_arrival" value="{{ $selectedRoute->arrival_time}}">
                        @endif
                    @endif
                   @if($selectedStops1 && !is_null($selectedStops1))
                        <input type="hidden" name="start_place" value="{{ $selectedStops1->pickup }}">
                    @else
                        @if(($selectedStop1 && !is_null($selectedStop1)) || ($selectedStop2 && !is_null($selectedStop2)))
                            <input type="hidden" name="start_place" value="{{ $selectedStop1->pickup ?? ($selectedRoute->start_place ?? '') }}">
                        @else
                            <input type="hidden" name="start_place" value="{{ $selectedRoute->start_place }}">
                        @endif
                    @endif
                    @if($selectedStops2 && !is_null($selectedStops2))
                        <input type="hidden" name="end_place" value="{{ $selectedStops2->pickup }}">
                    @else
                        @if(($selectedStop1 && !is_null($selectedStop1)) || ($selectedStop2 && !is_null($selectedStop2)))
                            <input type="hidden" name="end_place" value="{{ $selectedStop2->pickup ?? ($selectedRoute->end_place ?? '') }}">
                        @else
                            <input type="hidden" name="end_place" value="{{ $selectedRoute->end_place }}">
                        @endif
                     @endif
                    <!-- Adding the price hidden input here after it's defined -->
 @php
                         // Ensure $searchResults['passangers'] exists
    if($searchResults['trip_type'] == 'dus-intors') {
        if ($selectedInapoiStop1 || $selectedInapoiStop2) {
            if(isset($searchResults['currency']) && $searchResults['currency'] == 'mdl'){
                $price = isset($selectedInapoiStop1)
                    ? ((($selectedStop2->price + ($selectedRoute->price - $selectedInapoiStop1->price)) * 2) * $numberOfPassangers)
                    : ((($selectedInapoiStop2->price + ($selectedRoute->price - $selectedStop1->price)) * 2) * $numberOfPassangers);
            } elseif(isset($searchResults['currency']) && $searchResults['currency'] == 'ron') {
                $price = isset($selectedInapoiStop1)
                    ? ((($selectedStop2->price_ron + ($selectedRoute->price_ron - $selectedInapoiStop1->price_ron)) * 2) * $numberOfPassangers)
                    : ((($selectedInapoiStop2->price_ron + ($selectedRoute->price_ron - $selectedStop1->price_ron)) * 2) * $numberOfPassangers);
            }
        } elseif ($selectedInapoiStops2) {
            if(isset($searchResults['currency']) && $searchResults['currency'] == 'mdl') {
                $price = ((($selectedStops2->price - $selectedStops1->price) + ($selectedInapoiStops2->price - $selectedInapoiStops1->price)) * 2) * $numberOfPassangers;
            } elseif(isset($searchResults['currency']) && $searchResults['currency'] == 'ron') {
                $price = ((($selectedStops2->price_ron - $selectedStops1->price_ron) + ($selectedInapoiStops2->price_ron - $selectedInapoiStops1->price_ron)) * 2) * $numberOfPassangers;
            }
        } else {
             if(isset($searchResults['currency']) && $searchResults['currency'] == 'mdl') {
            $price = ($selectedRetourRoute->price * 2) * $numberOfPassangers;
            } elseif(isset($searchResults['currency']) && $searchResults['currency'] == 'ron') {
            }
        }
    } else {
        if ($selectedStop1 || $selectedStop2) {
           if(isset($searchResults['currency']) && $searchResults['currency'] == 'mdl') {
                $price = isset($selectedStop1)
                    ? ($selectedRoute->price - $selectedStop1->price) * $numberOfPassangers
                    : ($selectedStop2->price) * $numberOfPassangers;
            } elseif(isset($searchResults['currency']) && $searchResults['currency'] == 'ron') {
                $price = isset($selectedStop1)
                    ? ($selectedRoute->price_ron - $selectedStop1->price_ron) * $numberOfPassangers
                    : ($selectedStop2->price_ron) * $numberOfPassangers;
            }
        } elseif ($selectedStops2) {
           if(isset($searchResults['currency']) && $searchResults['currency'] == 'mdl') {
                $price = ($selectedStops2->price - $selectedStops1->price) * $numberOfPassangers;
            } elseif(isset($searchResults['currency']) && $searchResults['currency'] == 'ron') {
                $price = ($selectedStops2->price_ron - $selectedStops1->price_ron) * $numberOfPassangers;
            }
        } else {
            if(isset($searchResults['currency']) && $searchResults['currency'] == 'mdl') {
            $price = $selectedRoute->price * $numberOfPassangers;
            } elseif(isset($searchResults['currency']) && $searchResults['currency'] == 'ron') {
                 $price = $selectedRoute->price_ron * $numberOfPassangers;
            }
        }
    }
                            @endphp
                    
                     <input type="hidden" name="price" value="{{ $price }}">
                   <input type="hidden" name="seats" id="selectedSeatsInput">
                    @endif


                    @if(isset($searchResults) && $searchResults['trip_type'] === 'dus-intors')
                    <input type="hidden" name="isset_return" value="{{ $selectedRetourRoute->id }}">
                    <input type="hidden" name="trip" value="{{ $searchResults['trip_type'] ?? '' }}">
                    <input type="hidden" name="currency" value="{{ $searchResults['currency'] ?? '' }}">
                     <input type="hidden" name="pasageri" value="{{ $searchResults['passangers'] ?? '' }}">
                    <input type="hidden" name="date" value="{{ $searchResults['depart'] ?? '' }}">
                    <input type="hidden" name="date_return" value="{{ $searchResults['return'] ?? '' }}">
                    <input type="hidden" name="route" value="{{ $selectedRoute->id ?? '' }}">
                    <input type="hidden" name="route_return" value="{{ $selectedRetourRoute->id ?? '' }}">







                   

                    <!-- Adding the price hidden input here after it's defined -->


                             @if($selectedStop1 && !is_null($selectedStop1) || $selectedStop2 && !is_null($selectedStop2))
                            <input type="hidden" name="from" value="{{ $selectedStop1->route_stop ?? ($selectedRoute->route_tur?? '') }}">
                             <input type="hidden" name="start_place" value="{{ $selectedStop1->pickup ?? ($selectedRoute->start_place ?? '') }}">
                              @elseif($selectedStops1 && !is_null($selectedStops1))
                              <input type="hidden" name="from" value="{{ $selectedStops1->route_stop ?? '' }}">
                             <input type="hidden" name="start_place" value="{{ $selectedStops1->pickup ?? '' }}">
                              @else
                            <input type="hidden" name="from" value="{{ $searchResults['from'] ?? '' }}">
                              <input type="hidden" name="start_place" value="{{ $selectedRoute->start_place ?? '' }}">
                               @endif
                               @if($selectedStop1 && !is_null($selectedStop1) || $selectedStop2 && !is_null($selectedStop2))
                               <input type="hidden" name="to" value="{{ $selectedStop2->route_stop ?? ($selectedRoute->route_retur?? '') }}">
                               <input type="hidden" name="end_place" value="{{ $selectedStop2->pickup ?? ($selectedRoute->end_place ?? '') }}">
                                 @elseif($selectedStops2 && !is_null($selectedStops2))
                                <input type="hidden" name="to" value="{{ $selectedStops2->route_stop ?? '' }}">
                               <input type="hidden" name="end_place" value="{{ $selectedStops2->pickup ?? '' }}">
                                @else
                                 <input type="hidden" name="to" value="{{ $searchResults['to'] ?? '' }}">
                                 <input type="hidden" name="end_place" value="{{ $selectedRoute->end_place ?? '' }}">
                                  @endif
                                @if($selectedStop1 && !is_null($selectedStop1) || $selectedStop2 && !is_null($selectedStop2))
                                <input type="hidden" name="time" value="{{ \Carbon\Carbon::parse($selectedStop1->stop_time ?? ($selectedRoute->start_time ?? ''))->format('H:i') }}">
                                 <input type="hidden" name="time_arrival" value="{{ \Carbon\Carbon::parse($selectedStop2->stop_time ?? ($selectedRoute->arrival_time ?? ''))->format('H:i') }}">
                                @elseif($selectedStops2 && !is_null($selectedStops2))
                                 <input type="hidden" name="time" value="{{ \Carbon\Carbon::parse($selectedStops1->stop_time ?? '')->format('H:i') }}">
                                 <input type="hidden" name="time_arrival" value="{{ \Carbon\Carbon::parse($selectedStops2->stop_time ?? '')->format('H:i') }}">
                                 @else
                                  <input type="hidden" name="time" value="{{ $timeDus ?? '' }}">
                                   <input type="hidden" name="time_arrival" value="{{ $selectedRoute->arrival_time ?? '' }}">
                                @endif
                           @if($selectedInapoiStop1 && !is_null($selectedInapoiStop1) || $selectedInapoiStop2 && !is_null($selectedInapoiStop2))
                             <input type="hidden" name="from_return" value="{{ $selectedInapoiStop1->route_stop ?? ($selectedRetourRoute->route_tur?? '') }}">
                              <input type="hidden" name="start_place_inapoi" value="{{ $selectedInapoiStop1->pickup ?? ($selectedRetourRoute->start_place ?? '') }}">
                                @elseif($selectedInapoiStops1 && !is_null($selectedInapoiStops1))
                               <input type="hidden" name="from_return" value="{{ $selectedInapoiStops1->route_stop ?? '' }}">
                              <input type="hidden" name="start_place_inapoi" value="{{ $selectedInapoiStops1->pickup ?? '' }}">
                              @else
                              <input type="hidden" name="from_return" value="{{ $searchResults['to'] ?? '' }}">
                              <input type="hidden" name="start_place_inapoi" value="{{ $selectedRetourRoute->start_place ?? '' }}">
                             @endif
                             @if($selectedInapoiStop1 && !is_null($selectedInapoiStop1) || $selectedInapoiStop2 && !is_null($selectedInapoiStop2))
                             <input type="hidden" name="to_return" value="{{ $selectedInapoiStop2->route_stop ?? ($selectedRetourRoute->route_retur?? '') }}">
                              <input type="hidden" name="end_place_inapoi" value="{{ $selectedInapoiStop2->pickup ?? ($selectedRetourRoute->end_place ?? '') }}">
                               @elseif($selectedInapoiStops2 && !is_null($selectedInapoiStops2))
                               <input type="hidden" name="to_return" value="{{ $selectedInapoiStops2->route_stop ?? '' }}">
                              <input type="hidden" name="end_place_inapoi" value="{{ $selectedInapoiStops2->pickup ?? '' }}">
                               @else
                                <input type="hidden" name="to_return" value="{{ $searchResults['from'] ?? '' }}">
                                 <input type="hidden" name="end_place_inapoi" value="{{ $selectedRetourRoute->end_place ?? '' }}">
                               @endif
                             @if($selectedInapoiStop1 && !is_null($selectedInapoiStop1) || $selectedInapoiStop2 && !is_null($selectedInapoiStop2))
                             <input type="hidden" name="time_return" value="{{ \Carbon\Carbon::parse($selectedInapoiStop1->stop_time ?? ($selectedRetourRoute->start_time ?? ''))->format('H:i') }}">
                              <input type="hidden" name="time_arrival_return" value="{{ \Carbon\Carbon::parse($selectedInapoiStop2->stop_time ?? ($selectedRetourRoute->arrival_time ?? ''))->format('H:i') }}">
                               @elseif($selectedInapoiStops2 && !is_null($selectedInapoiStops2))
                            <input type="hidden" name="time_return" value="{{ \Carbon\Carbon::parse($selectedInapoiStops1->stop_time ?? '')->format('H:i') }}">
                              <input type="hidden" name="time_arrival_return" value="{{ \Carbon\Carbon::parse($selectedInapoiStops2->stop_time ?? '')->format('H:i') }}">
                              @else
                              <input type="hidden" name="time_return" value="{{ $timeIntors ?? '' }}">
                             <input type="hidden" name="time_arrival_return" value="{{ $selectedRetourRoute->arrival_time ?? '' }}">
                               @endif


                     @php
                         // Ensure $searchResults['passangers'] exists
    if($searchResults['trip_type'] == 'dus-intors') {
        if ($selectedInapoiStop1 || $selectedInapoiStop2) {
            if(isset($searchResults['currency']) && $searchResults['currency'] == 'mdl'){
                $price = isset($selectedInapoiStop1)
                    ? ((($selectedStop2->price + ($selectedRoute->price - $selectedInapoiStop1->price)) * 2) * $numberOfPassangers)
                    : ((($selectedInapoiStop2->price + ($selectedRoute->price - $selectedStop1->price)) * 2) * $numberOfPassangers);
            } elseif(isset($searchResults['currency']) && $searchResults['currency'] == 'ron') {
                $price = isset($selectedInapoiStop1)
                    ? ((($selectedStop2->price_ron + ($selectedRoute->price_ron - $selectedInapoiStop1->price_ron)) * 2) * $numberOfPassangers)
                    : ((($selectedInapoiStop2->price_ron + ($selectedRoute->price_ron - $selectedStop1->price_ron)) * 2) * $numberOfPassangers);
            }
        } elseif ($selectedInapoiStops2) {
            if(isset($searchResults['currency']) && $searchResults['currency'] == 'mdl') {
                $price = ((($selectedStops2->price - $selectedStops1->price) + ($selectedInapoiStops2->price - $selectedInapoiStops1->price)) * 2) * $numberOfPassangers;
            } elseif(isset($searchResults['currency']) && $searchResults['currency'] == 'ron') {
                $price = ((($selectedStops2->price_ron - $selectedStops1->price_ron) + ($selectedInapoiStops2->price_ron - $selectedInapoiStops1->price_ron)) * 2) * $numberOfPassangers;
            }
        } else {
             if(isset($searchResults['currency']) && $searchResults['currency'] == 'mdl') {
            $price = ($selectedRetourRoute->price * 2) * $numberOfPassangers;
            } elseif(isset($searchResults['currency']) && $searchResults['currency'] == 'ron') {
                $price = ($selectedRetourRoute->price_ron * 2) * $numberOfPassangers;
            }
        }
    } else {
        if ($selectedStop1 || $selectedStop2) {
           if(isset($searchResults['currency']) && $searchResults['currency'] == 'mdl') {
                $price = isset($selectedStop1)
                    ? ($selectedRoute->price - $selectedStop1->price) * $numberOfPassangers
                    : ($selectedStop2->price) * $numberOfPassangers;
            } elseif(isset($searchResults['currency']) && $searchResults['currency'] == 'ron') {
                $price = isset($selectedStop1)
                    ? ($selectedRoute->price_ron - $selectedStop1->price_ron) * $numberOfPassangers
                    : ($selectedStop2->price_ron) * $numberOfPassangers;
            }
        } elseif ($selectedStops2) {
           if(isset($searchResults['currency']) && $searchResults['currency'] == 'mdl') {
                $price = ($selectedStops2->price - $selectedStops1->price) * $numberOfPassangers;
            } elseif(isset($searchResults['currency']) && $searchResults['currency'] == 'ron') {
                $price = ($selectedStops2->price_ron - $selectedStops1->price_ron) * $numberOfPassangers;
            }
        } else {
            if(isset($searchResults['currency']) && $searchResults['currency'] == 'mdl') {
            $price = $selectedRoute->price * $numberOfPassangers;
            } elseif(isset($searchResults['currency']) && $searchResults['currency'] == 'ron') {
                 $price = $selectedRoute->price_ron * $numberOfPassangers;
            }
        }
    }
                            @endphp
                    <input type="hidden" name="price" value="{{$price}}">
                   <input type="hidden" name="seats_dus" id="selectedSeatsInputDus">
                   <input type="hidden" name="seats_inapoi" id="selectedSeatsInputIntors">
                    @endif
                </form>
            </div>

            <!-- Sidebar -->
            <div class="w-full md:w-1/3 space-y-6 mt-10 md:mt-0">
                <!-- Reservation Details Section -->
                <div class="bg-white rounded-lg shadow p-4 border border-gray-300">
                    <div class="flex items-center space-x-2 mb-4">
                        <span class="bg-green-500 text-white rounded-full px-3 py-1 text-sm">Direct</span>
                        <div class="text-gray-700 font-semibold">{{ $searchResults['depart_formatted'] ?? '' }}</div>
                        <h2 class="font-semibold text-black">
                            @if(isset($searchResults) && $searchResults['trip_type'] === 'dus-intors')Direcție- Dus 
                            @endif
                            </h2>
                    </div>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <div class="text-gray-700">
                                <div class="flex items-center relative">
                                    <span class="dot"></span>
                                    <div class="absolute left-1.5 top-6">
                                        <div class="line"></div>
                                    </div>
                                    <div class="ml-2">
                                                @if($selectedStop1 && !is_null($selectedStop1) || $selectedStop2 && !is_null($selectedStop2))
                                                    <div>{{ $selectedStop1->route_stop ?? ($selectedRoute->route_tur?? '') }}</div>
                                                   <div>{{ $selectedStop1->pickup ?? ($selectedRoute->start_place ?? '') }}</div>
                        
                                                @elseif($selectedStops1 && !is_null($selectedStops1))
                                                     <div>{{ $selectedStops1->route_stop ?? '' }}</div>
                                                   <div>{{ $selectedStops1->pickup ?? '' }}</div>
                                                @else
                                                
                                                    <div>{{ $selectedRoute->route_tur ?? '' }}</div>
                                                    <div class="text-sm text-gray-500">{{ $selectedRoute->start_place ?? '' }}</div>
                                                @endif
                                                
                                            </div>

                                </div>
                                <div class="mt-2 flex items-center">
                                    <span class="dot active"></span>
                                     <div class="ml-2">
                                                 @if($selectedStop1 && !is_null($selectedStop1) || $selectedStop2 && !is_null($selectedStop2))
                                                    <div>{{ $selectedStop2->route_stop ?? ($selectedRoute->route_retur?? '') }}</div>
                                                   <div>{{ $selectedStop2->pickup ?? ($selectedRoute->end_place ?? '') }}</div>
                                                @elseif($selectedStops2 && !is_null($selectedStops2))
                                                     <div>{{ $selectedStops2->route_stop ?? '' }}</div>
                                                   <div>{{ $selectedStops2->pickup ?? '' }}</div>
                                                @else
                                                     <div>{{ $selectedRoute->route_retur ?? '' }}</div>
                                                    <div class="text-sm text-gray-500">{{ $selectedRoute->end_place ?? '' }}</div>
                                                @endif
                                     </div>
                                </div>
                            </div>
                            <div class="text-right">
                                           @if($selectedStop1 && !is_null($selectedStop1) || $selectedStop2 && !is_null($selectedStop2))
                                                  <div>{{ \Carbon\Carbon::parse($selectedStop1->stop_time ?? ($selectedRoute->start_time ?? ''))->format('H:i') }}</div>
                                                    <div class="mt-4">{{ \Carbon\Carbon::parse($selectedStop2->stop_time ?? ($selectedRoute->arrival_time ?? ''))->format('H:i') }}</div>
                                                @elseif($selectedStops2 && !is_null($selectedStops2))
                                                    <div>{{ \Carbon\Carbon::parse($selectedStops1->stop_time ?? '')->format('H:i') }}</div>
                                <div class="mt-4">{{ \Carbon\Carbon::parse($selectedStops2->stop_time ?? '')->format('H:i') }}</div>
                                                @else
                                                    <div>{{ \Carbon\Carbon::parse($selectedRoute->start_time ?? '')->format('H:i') }}</div>
                                                    <div class="mt-4">{{ \Carbon\Carbon::parse($selectedRoute->arrival_time ?? '')->format('H:i') }}</div>
                                                @endif
                            </div>
                        </div>
                        @if(isset($searchResults) && $searchResults['trip_type'] === 'dus-intors')
                        <div class="flex items-center space-x-2 mb-4">
                            <span class="bg-green-500 text-white rounded-full px-3 py-1 text-sm">Direct</span>
                            <div class="text-gray-700 font-semibold">{{ $searchResults['return_formatted'] ?? '' }}</div>
                            <h2 class="font-semibold text-black">Direcție - Întors</h2>
                        </div>
                                    <div class="space-y-4">
                                        <div class="flex justify-between items-center">
                                            <div class="text-gray-700">
                                                <div class="flex items-center relative">
                                                    <span class="dot"></span>
                                                    <div class="absolute left-1.5 top-6">
                                                        <div class="line"></div>
                                                    </div>
                                                    <div class="ml-2">
                                                       @if($selectedInapoiStop1 && !is_null($selectedInapoiStop1) || $selectedInapoiStop2 && !is_null($selectedInapoiStop2))
                                                    <div>{{ $selectedInapoiStop1->route_stop ?? ($selectedRetourRoute->route_tur?? '') }}</div>
                                                   <div>{{ $selectedInapoiStop1->pickup ?? ($selectedRetourRoute->start_place ?? '') }}</div>
                        
                                                @elseif($selectedInapoiStops1 && !is_null($selectedInapoiStops1))
                                                     <div>{{ $selectedInapoiStops1->route_stop ?? '' }}</div>
                                                   <div>{{ $selectedInapoiStops1->pickup ?? '' }}</div>
                                                @else
                                                    <div>{{ $selectedRetourRoute->route_tur ?? '' }}</div>
                                                        <div class="text-sm text-gray-500">{{ $selectedRetourRoute->start_place ?? '' }}</div>
                                                @endif
                                                    </div>
                                                </div>
                                                <div class="mt-2 flex items-center">
                                                    <span class="dot active"></span>
                                                    <div class="ml-2">
                                                       @if($selectedInapoiStop1 && !is_null($selectedInapoiStop1) || $selectedInapoiStop2 && !is_null($selectedInapoiStop2))
                                                    <div>{{ $selectedInapoiStop2->route_stop ?? ($selectedRetourRoute->route_retur?? '') }}</div>
                                                   <div>{{ $selectedInapoiStop2->pickup ?? ($selectedRetourRoute->end_place ?? '') }}</div>
                                                @elseif($selectedInapoiStops2 && !is_null($selectedInapoiStops2))
                                                     <div>{{ $selectedInapoiStops2->route_stop ?? '' }}</div>
                                                   <div>{{ $selectedInapoiStops2->pickup ?? '' }}</div>
                                                @else
                                                     <div>{{ $selectedRetourRoute->route_retur ?? '' }}</div>
                                                        <div class="text-sm text-gray-500">{{ $selectedRetourRoute->end_place ?? '' }}</div>
                                                @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                           @if($selectedInapoiStop1 && !is_null($selectedInapoiStop1) || $selectedInapoiStop2 && !is_null($selectedInapoiStop2))
                                                  <div>{{ \Carbon\Carbon::parse($selectedInapoiStop1->stop_time ?? ($selectedRetourRoute->start_time ?? ''))->format('H:i') }}</div>
                                                    <div class="mt-4">{{ \Carbon\Carbon::parse($selectedInapoiStop2->stop_time ?? ($selectedRetourRoute->arrival_time ?? ''))->format('H:i') }}</div>
                                                @elseif($selectedInapoiStops2 && !is_null($selectedInapoiStops2))
                                                    <div>{{ \Carbon\Carbon::parse($selectedInapoiStops1->stop_time ?? '')->format('H:i') }}</div>
                                <div class="mt-4">{{ \Carbon\Carbon::parse($selectedInapoiStops2->stop_time ?? '')->format('H:i') }}</div>
                                                @else
                                                     <div>{{ \Carbon\Carbon::parse($selectedRetourRoute->start_time ?? '')->format('H:i') }}</div>
                                                <div class="mt-4">{{ \Carbon\Carbon::parse($selectedRetourRoute->arrival_time ?? '')->format('H:i') }}</div>
                                                @endif
                            </div>
                                        </div>
                                        <div class="border-t border-gray-200 pt-4">
                                        </div>
                                    </div>
                            @endif

                        <div class="border-t border-gray-200 pt-4">
                        @if(isset($searchResults) && $searchResults['trip_type'] === 'dus-intors')
                        <div id="selectedSeatsDisplayDus"></div>
                            <div id="selectedSeatsDisplayIntors"></div>
                            @else
                            <div id="selectedSeatsDisplay"></div>
                            @endif
                            
                        </div>
                        <div class="border-t border-gray-200 pt-4">
                            <div>{{ $numberOfPassangers }} Persoane</div>
                        </div>
                        <div class="font-semibold text-xl">
                        @if(isset($searchResults) && $searchResults['trip_type'] === 'dus-intors')
                           Preț pentru o persoană dus-întors:
                           @else
                            Preț pentru o persoană:
                        @endif
                         @if(isset($searchResults) && $searchResults['trip_type'] === 'dus-intors')
                         @if($selectedInapoiStop1 && !is_null($selectedInapoiStop1) || $selectedInapoiStop2 && !is_null($selectedInapoiStop2))
                               @if(isset($searchResults['currency']) && $searchResults['currency'] == 'mdl')
                               {{ number_format(
                                    isset($selectedInapoiStop1) ? ((($selectedStop2->price ) +($selectedRoute->price - $selectedInapoiStop1->price) ) *2): 
                                    (isset($selectedInapoiStop2) ? (($selectedInapoiStop2->price ) +($selectedRoute->price - $selectedStop1->price) ) *2 : 0), 
                                0) }} MDL
                            @elseif(isset($searchResults['currency']) && $searchResults['currency'] == 'ron')
                               {{ number_format(
                                   isset($selectedInapoiStop1) ? ((($selectedStop2->price_ron ) +($selectedRoute->price_ron - $selectedInapoiStop1->price_ron) ) *2): 
                                    (isset($selectedInapoiStop2) ? (($selectedInapoiStop2->price_ron ) +($selectedRoute->price_ron - $selectedStop1->price_ron) ) *2 : 0), 
                                0) }} RON
                            @else
                               {{ number_format(
                                   isset($selectedInapoiStop1) ? ((($selectedStop2->price ) +($selectedRoute->price - $selectedInapoiStop1->price) ) *2): 
                                    (isset($selectedInapoiStop2) ? (($selectedInapoiStop2->price ) +($selectedRoute->price - $selectedStop1->price) ) *2 : 0), 
                                0) }} MDL
                            @endif                   



                             @elseif($selectedInapoiStops2 && !is_null($selectedInapoiStops2))
                            @if(isset($searchResults['currency']) && $searchResults['currency'] == 'mdl')
                                {{ number_format((($selectedStops2->price - $selectedStops1->price) + ($selectedInapoiStops2->price - $selectedInapoiStops1->price)) * 2 , 0) }} MDL
                            @elseif(isset($searchResults['currency']) && $searchResults['currency'] == 'ron')
                                {{ number_format((($selectedStops2->price_ron - $selectedStops1->price_ron) + ($selectedInapoiStops2->price_ron - $selectedInapoiStops1->price_ron)) * 2 , 0) }} RON
                            @else
                                 {{ number_format((($selectedStops2->price - $selectedStops1->price) + ($selectedInapoiStops2->price - $selectedInapoiStops1->price)) * 2 , 0) }} MDL
                            @endif
                            {{-- deafult --}}
                            @elseif(isset($searchResults['currency']) && $searchResults['currency'] == 'mdl')
                                {{ number_format($selectedRetourRoute->price*2, 0) }} MDL
                            @elseif(isset($searchResults['currency']) && $searchResults['currency'] == 'ron')
                                {{ number_format($selectedRetourRoute->price_ron*2, 0) }} RON
                            @else
                                {{ number_format($selectedRetourRoute->price*2, 0) }} MDL
                            @endif
                            
                            @else
                            @if($selectedStop1 && !is_null($selectedStop1) || $selectedStop2 && !is_null($selectedStop2))
                               @if(isset($searchResults['currency']) && $searchResults['currency'] == 'mdl')
                               {{ number_format(
                                    isset($selectedStop1) ? $selectedRoute->price - $selectedStop1->price : 
                                    (isset($selectedStop2) ? $selectedStop2->price : 0), 
                                0) }} MDL
                            @elseif(isset($searchResults['currency']) && $searchResults['currency'] == 'ron')
                               {{ number_format(
                                    isset($selectedStop1) ? $selectedRoute->price_ron - $selectedStop1->price_ron : 
                                    (isset($selectedStop2) ? $selectedStop2->price_ron : 0), 
                                0) }} RON
                            @else
                               {{ number_format(
                                    isset($selectedStop1) ? $selectedRoute->price - $selectedStop1->price : 
                                    (isset($selectedStop2) ? $selectedRoute->price - $selectedStop2->price : 0), 
                                0) }} MDL
                            @endif                   



                             @elseif($selectedStops2 && !is_null($selectedStops2))
                            @if(isset($searchResults['currency']) && $searchResults['currency'] == 'mdl')
                                {{ number_format($selectedStops2->price - $selectedStops1->price , 0) }} MDL
                            @elseif(isset($searchResults['currency']) && $searchResults['currency'] == 'ron')
                                {{ number_format($selectedStops2->price_ron - $selectedStops1->price_ron, 0) }} RON
                            @else
                                {{ number_format($selectedStops2->price - $selectedStops1->price, 0) }} MDL
                            @endif
                             @else
                             @if(isset($searchResults['currency']) && $searchResults['currency'] == 'mdl')
                                {{ number_format($selectedRoute->price, 0) }} MDL
                            @elseif(isset($searchResults['currency']) && $searchResults['currency'] == 'ron')
                                {{ number_format($selectedRoute->price_ron, 0) }} RON
                            @else
                                {{ number_format($selectedRoute->price, 0) }} MDL
                            @endif
                             @endif
                            @endif
                        </div>
                        <!-- Payment Section -->
                        <div class="flex justify-between items-center bg-white rounded-lg shadow p-4 border border-gray-300">
                            <div class="text-xl font-bold">Total:
                            @if(isset($searchResults) && $searchResults['trip_type'] === 'dus-intors')
                               @if($selectedInapoiStop1 && !is_null($selectedInapoiStop1) || $selectedInapoiStop2 && !is_null($selectedInapoiStop2))
                               @if(isset($searchResults['currency']) && $searchResults['currency'] == 'mdl')
                               {{ number_format(
                                    isset($selectedInapoiStop1) ? (((($selectedStop2->price ) +($selectedRoute->price - $selectedInapoiStop1->price) ) * 2 ) * $numberOfPassangers ): 
                                    (isset($selectedInapoiStop2) ? ((($selectedInapoiStop2->price ) +($selectedRoute->price - $selectedStop1->price) ) *2) * $numberOfPassangers : 0), 
                                0) }} MDL
                            @elseif(isset($searchResults['currency']) && $searchResults['currency'] == 'ron')
                               {{ number_format(
                                   isset($selectedInapoiStop1) ? (((($selectedStop2->price_ron ) +($selectedRoute->price_ron - $selectedInapoiStop1->price_ron) ) *2 ) * $numberOfPassangers): 
                                    (isset($selectedInapoiStop2) ? ((($selectedInapoiStop2->price_ron ) +($selectedRoute->price_ron - $selectedStop1->price_ron) ) *2 ) * $numberOfPassangers : 0), 
                                0) }} RON
                            @else
                               {{ number_format(
                                    isset($selectedInapoiStop1) ? (((($selectedStop2->price ) +($selectedRoute->price - $selectedInapoiStop1->price) ) * 2 ) * $numberOfPassangers ): 
                                    (isset($selectedInapoiStop2) ? ((($selectedInapoiStop2->price ) +($selectedRoute->price - $selectedStop1->price) ) *2) * $numberOfPassangers : 0), 
                                0) }} MDL
                            @endif                   



                             @elseif($selectedInapoiStops2 && !is_null($selectedInapoiStops2))
                            @if(isset($searchResults['currency']) && $searchResults['currency'] == 'mdl')
                                {{ number_format(((($selectedStops2->price - $selectedStops1->price) + ($selectedInapoiStops2->price - $selectedInapoiStops1->price)) * 2) *$numberOfPassangers , 0) }} MDL
                            @elseif(isset($searchResults['currency']) && $searchResults['currency'] == 'ron')
                                {{ number_format(((($selectedStops2->price_ron - $selectedStops1->price_ron) + ($selectedInapoiStops2->price_ron - $selectedInapoiStops1->price_ron)) * 2 ) *$numberOfPassangers, 0) }} RON
                            @else
                                {{ number_format(((($selectedStops2->price - $selectedStops1->price) + ($selectedInapoiStops2->price - $selectedInapoiStops1->price)) * 2) *$numberOfPassangers , 0) }} MDL
                            @endif
                            {{-- deafult --}}
                            @elseif(isset($searchResults['currency']) && $searchResults['currency'] == 'mdl')
                                {{ number_format(($selectedRetourRoute->price * 2) * $numberOfPassangers, 0) }} MDL
                            @elseif(isset($searchResults['currency']) && $searchResults['currency'] == 'ron')
                                {{ number_format(($selectedRetourRoute->price_ron * 2 ) * $numberOfPassangers, 0) }} RON
                            @else
                                {{ number_format(($selectedRetourRoute->price * 2) * $numberOfPassangers, 0) }} MDL
                            @endif
                                @else


                                @if($selectedStop1 && !is_null($selectedStop1) || $selectedStop2 && !is_null($selectedStop2))
                               @if(isset($searchResults['currency']) && $searchResults['currency'] == 'mdl')
                               {{ number_format(
                                    isset($selectedStop1) ? ( $selectedRoute->price - $selectedStop1->price) * $numberOfPassangers : 
                                    (isset($selectedStop2) ? ( $selectedStop2->price) * $numberOfPassangers : 0), 
                                0) }} MDL
                            @elseif(isset($searchResults['currency']) && $searchResults['currency'] == 'ron')
                               {{ number_format(
                                    isset($selectedStop1) ? ( $selectedRoute->price_ron - $selectedStop1->price_ron) * $numberOfPassangers : 
                                    (isset($selectedStop2) ? ( $selectedStop2->price_ron ) * $numberOfPassangers : 0), 
                                0) }} RON
                            @else
                               {{ number_format(
                                    isset($selectedStop1) ? $selectedRoute->price - $selectedStop1->price : 
                                    (isset($selectedStop2) ? $selectedRoute->price - $selectedStop2->price : 0), 
                                0) }} MDL
                            @endif  

                                  
                                                   
                             @elseif($selectedStops2 && !is_null($selectedStops2))
                            @if(isset($searchResults['currency']) && $searchResults['currency'] == 'mdl')
                                {{ number_format(($selectedStops2->price - $selectedStops1->price )* $numberOfPassangers , 0) }} MDL
                            @elseif(isset($searchResults['currency']) && $searchResults['currency'] == 'ron')
                                {{ number_format(($selectedStops2->price_ron - $selectedStops1->price_ron )* $numberOfPassangers, 0) }} RON
                            @else
                                {{ number_format(($selectedStops2->price - $selectedStops1->price )* $numberOfPassangers, 0) }} MDL
                            @endif
                                                @else
                                                   @if(isset($searchResults['currency']) && $searchResults['currency'] == 'mdl')
                                    {{ number_format($selectedRoute->price * $numberOfPassangers, 0) }} MDL
                                @elseif(isset($searchResults['currency']) && $searchResults['currency'] == 'ron')
                                    {{ number_format($selectedRoute->price_ron * $numberOfPassangers, 0) }} RON
                                @else
                                    {{ number_format($selectedRoute->price * $numberOfPassangers, 0) }} MDL
                                @endif
                             @endif
                                 @endif
                            </div>
                           
                           <div class="space-x-4">
    <button id="submitReservationBtn" class="bg-blue-600 text-white rounded-full px-6 py-2 hover:bg-blue-800 hover:text-gray-100">Rezervă</button>
</div>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
</div>
@if(isset($searchResults) && $searchResults['trip_type'] === 'dus')
<!-- Seat Selection Modal -->
<div id="seatModal" class="modal fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center overflow-y-auto hidden">
    <div class="bg-white rounded-lg shadow p-6 w-4/4 md:w-1/2 lg:w-1/3">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-black">Alege-ți locul</h2>
            <button id="closeModal" class="text-black font-bold">&times;</button>
        </div>
        <div class="grid grid-cols-4 gap-2 mb-4">
            <!-- Custom arrangement of seats with white spaces -->
            @php $skip = false; @endphp
            @foreach(range(1, 19) as $seatNumber)
                @if($seatNumber == 1 && !$skip)
                    <div class="border rounded-lg p-4 text-center">--</div>
                    <div class="white-space"></div> <!-- White space -->
                    <div class="white-space"></div> <!-- White space -->
                    <div class="seat {{ in_array(20, $occupiedSeatsDus) ? 'occupied' : 'available' }} border rounded-lg p-4 text-center">20</div>
                    @php $skip = true; @endphp
                @endif
                <div class="seat {{ in_array($seatNumber, $occupiedSeatsDus) ? 'occupied' : 'available' }} border rounded-lg p-4 text-center">{{ $seatNumber }}</div>
                @if(in_array($seatNumber, [2, 5, 8, 11, 14]))
                    <div class="white-space"></div> <!-- White space -->
                @endif
            @endforeach
        </div>
        <div class="flex items-center justify-between">
            <div class="flex-wrap items-center space-x-2">
                <div class="flex items-center space-x-1">
                    <span class="bg-red-500 w-4 h-4 rounded-full inline-block"></span>
                    <span>Ocupat</span>
                </div>
                <div class="flex items-center space-x-1">
                    <span class="bg-green-500 w-4 h-4 rounded-full inline-block"></span>
                    <span>Libere</span>
                </div>
                <div class="flex items-center space-x-1">
                    <span class="bg-blue-500 w-4 h-4 rounded-full inline-block"></span>
                    <span>Selectat</span>
                </div>
            </div>
            <button id="confirmSelection" class="bg-blue-600 text-white font-bold rounded-full px-4 py-2">Confirmă selecția</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const seats = document.querySelectorAll('.seat.available');
    let selectedSeats = [];
    const numberOfPassangers = {{ $numberOfPassangers }}; // Dynamic value

    seats.forEach(seat => {
        seat.addEventListener('click', function () {
            const seatNumber = this.innerText;

            if (selectedSeats.includes(seatNumber)) {
                selectedSeats = selectedSeats.filter(seat => seat !== seatNumber);
                this.classList.remove('selected');
            } else {
                if (selectedSeats.length < numberOfPassangers) {
                    selectedSeats.push(seatNumber);
                    this.classList.add('selected');
                } else {
                    alert(`Poți selecta până la ${numberOfPassangers} locuri, câte unul per persoană.`);
                }
            }

            // Update the display of selected seats
            updateSelectedSeatsDisplay(selectedSeats);
        });
    });

    document.getElementById('selectSeatBtn').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('seatModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    });

    document.getElementById('closeModal').addEventListener('click', function() {
        document.getElementById('seatModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    });

    document.getElementById('confirmSelection').addEventListener('click', function () {
        if (selectedSeats.length < numberOfPassangers) {
            alert('Numărul de locuri selectate nu este suficient pentru toți pasagerii.');
            return;
        }

        const date = '{{ $searchResults['depart'] }}'; // Dynamic date
        const direction = '{{ $selectedRoute->id }}-{{ $searchResults['to'] }}'; // Dynamic direction
        const time = '{{ $selectedRoute->start_place }}'; // Dynamic direction

        // Close the modal
        document.getElementById('seatModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');

        // Update the hidden input with the selected seats
        document.getElementById('selectedSeatsInput').value = selectedSeats.join(',');

        // Update the display
        updateSelectedSeatsDisplay(selectedSeats);

        // Proceed with the fetch request (if required)
        fetch('/save-seats', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ seats: selectedSeats, date: date, direction: direction, time: time })
        })
        .then(response => response.json())
        .then(data => {
            // Handle the response
            alert('Seats saved successfully');
        })
        .catch(error => console.error('Error:', error));
    });

    // Function to update the display of selected seats
    function updateSelectedSeatsDisplay(seats) {
        const displayElement = document.getElementById('selectedSeatsDisplay');
        if (seats.length === 0) {
            displayElement.innerText = 'Nu sunt locuri selectate';
        } else {
            displayElement.innerText = 'Locuri selectate: ' + seats.join(', ');
        }
    }

    // Initialize display
    updateSelectedSeatsDisplay(selectedSeats);

    // Function to validate the form
    function validateForm() {
        const form = document.getElementById('reservationForm');
        const requiredFields = form.querySelectorAll('[required]');
        let valid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('border-red-500');
                valid = false;
            } else {
                field.classList.remove('border-red-500');
            }
        });

        return valid;
    }
    // Handle form submission with the external button
    document.getElementById('submitReservationBtn').addEventListener('click', function (event) {
        event.preventDefault();
        if (selectedSeats.length < numberOfPassangers) {
            alert('Trebuie să selectați locuri = pasageri loc.');
            return;
        }

        if (validateForm()) {
            document.getElementById('reservationForm').submit();
        } else {
            alert('Completați câmpurile obligatorii.');
        }
    });
});

</script>  

@else

@if(isset($searchResults) && $searchResults['trip_type'] === 'dus-intors')
<!-- Seat Selection Modal for Dus -->
<div id="seatModalDus" class="modal fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center overflow-y-auto hidden">
    <div class="bg-white rounded-lg shadow p-6 w-4/4 md:w-1/2 lg:w-1/3">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-black">Alege-ți locul pentru Dus</h2>
            <button id="closeModalDus" class="text-black font-bold">&times;</button>
        </div>
        <div class="grid grid-cols-4 gap-2 mb-4">
            <!-- Custom arrangement of seats with white spaces -->
            @php $skip = false; @endphp
            @foreach(range(1, 19) as $seatNumber)
                @if($seatNumber == 1 && !$skip)
                    <div class="border rounded-lg p-4 text-center">--</div>
                    <div class="white-space"></div> <!-- White space -->
                    <div class="white-space"></div> <!-- White space -->
                    <div class="seat dus {{ in_array(20, $occupiedSeatsDus) ? 'occupied' : 'available' }} border rounded-lg p-4 text-center">20</div>
                    @php $skip = true; @endphp
                @endif
                <div class="seat dus {{ in_array($seatNumber, $occupiedSeatsDus) ? 'occupied' : 'available' }} border rounded-lg p-4 text-center">{{ $seatNumber }}</div>
                @if(in_array($seatNumber, [2, 5, 8, 11, 14]))
                    <div class="white-space"></div> <!-- White space -->
                @endif
            @endforeach
        </div>
        <div class="flex items-center justify-between">
            <div class="flex-wrap items-center space-x-2">
                <div class="flex items-center space-x-1">
                    <span class="bg-red-500 w-4 h-4 rounded-full inline-block"></span>
                    <span>Ocupat</span>
                </div>
                <div class="flex items-center space-x-1">
                    <span class="bg-green-500 w-4 h-4 rounded-full inline-block"></span>
                    <span>Libere</span>
                </div>
                <div class="flex items-center space-x-1">
                    <span class="bg-blue-500 w-4 h-4 rounded-full inline-block"></span>
                    <span>Selectat</span>
                </div>
            </div>
            <button id="confirmSelectionDus" class="bg-blue-600 text-white font-bold rounded-full px-4 py-2">Confirmă selecția</button>
        </div>
    </div>
</div>



<!-- Seat Selection Modal for Întors -->
<div id="seatModalIntors" class="modal fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center overflow-y-auto hidden">
    <div class="bg-white rounded-lg shadow p-6 w-4/4 md:w-1/2 lg:w-1/3">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-black">Alege-ți locul pentru Întors</h2>
            <button id="closeModalIntors" class="text-black font-bold">&times;</button>
        </div>
        <div class="grid grid-cols-4 gap-2 mb-4">
            <!-- Custom arrangement of seats with white spaces -->
            @php $skip = false; @endphp
            @foreach(range(1, 19) as $seatNumber)
                @if($seatNumber == 1 && !$skip)
                    <div class="border rounded-lg p-4 text-center">--</div>
                    <div class="white-space"></div> <!-- White space -->
                    <div class="white-space"></div> <!-- White space -->
                    <div class="seat intors {{ in_array(20, $occupiedSeatsIntors) ? 'occupied' : 'available' }} border rounded-lg p-4 text-center">20</div>
                    @php $skip = true; @endphp
                @endif
                <div class="seat intors {{ in_array($seatNumber, $occupiedSeatsIntors) ? 'occupied' : 'available' }} border rounded-lg p-4 text-center">{{ $seatNumber }}</div>
                @if(in_array($seatNumber, [2, 5, 8, 11, 14]))
                    <div class="white-space"></div> <!-- White space -->
                @endif
            @endforeach
        </div>
        <div class="flex items-center justify-between">
            <div class="flex-wrap items-center space-x-2">
                <div class="flex items-center space-x-1">
                    <span class="bg-red-500 w-4 h-4 rounded-full inline-block"></span>
                    <span>Ocupat</span>
                </div>
                <div class="flex items-center space-x-1">
                    <span class="bg-green-500 w-4 h-4 rounded-full inline-block"></span>
                    <span>Libere</span>
                </div>
                <div class="flex items-center space-x-1">
                    <span class="bg-blue-500 w-4 h-4 rounded-full inline-block"></span>
                    <span>Selectat</span>
                </div>
            </div>
            <button id="confirmSelectionIntors" class="bg-blue-600 text-white font-bold rounded-full px-4 py-2">Confirmă selecția</button>
        </div>
    </div>
</div>
@endif



<script>
document.addEventListener('DOMContentLoaded', function() {
    const seatsDus = document.querySelectorAll('.seat.available.dus');
    const seatsIntors = document.querySelectorAll('.seat.available.intors');
    let selectedSeatsDus = [];
    let selectedSeatsIntors = [];
    const numberOfPassangers = {{ $numberOfPassangers ?? 0 }}; // Dynamic value
    const searchResults = @json($searchResults); // Make sure this is defined in your blade template

    function handleSeatClick(seats, selectedSeats, seat, seatType) {
        const seatNumber = seat.innerText;

        if (selectedSeats.includes(seatNumber)) {
            selectedSeats = selectedSeats.filter(s => s !== seatNumber);
            seat.classList.remove('selected');
        } else {
            if (selectedSeats.length < numberOfPassangers) {
                selectedSeats.push(seatNumber);
                seat.classList.add('selected');
            } else {
                alert(`Poți selecta până la ${numberOfPassangers} locuri, câte unul per persoană.`);
            }
        }

        updateSelectedSeatsDisplay(seatType, selectedSeats);
        return selectedSeats;
    }

    seatsDus.forEach(seat => {
        seat.addEventListener('click', function () {
            selectedSeatsDus = handleSeatClick(seatsDus, selectedSeatsDus, this, 'dus');
        });
    });

    seatsIntors.forEach(seat => {
        seat.addEventListener('click', function () {
            selectedSeatsIntors = handleSeatClick(seatsIntors, selectedSeatsIntors, this, 'intors');
        });
    });

    document.getElementById('selectSeatBtn').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('seatModalDus').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    });

    document.getElementById('selectSeatBtnIntors').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('seatModalIntors').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    });

    document.getElementById('closeModalDus').addEventListener('click', function() {
        document.getElementById('seatModalDus').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    });

    document.getElementById('closeModalIntors').addEventListener('click', function() {
        document.getElementById('seatModalIntors').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    });

    document.getElementById('confirmSelectionDus').addEventListener('click', function () {
        if (selectedSeatsDus.length !== numberOfPassangers) {
            alert('Numărul de locuri selectate nu este suficient pentru toți pasagerii.');
            return;
        }

        const dateDus = '{{ $searchResults['depart'] ?? '' }}'; // Dynamic date for dus
        const directionDus = '{{ $selectedRoute->id ?? '' }}-{{ $searchResults['to'] ?? '' }}'; // Dynamic direction for dus
        const timeDus = '{{ $selectedRoute->start_place ?? '' }}'; // Dynamic time for dus

        document.getElementById('seatModalDus').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');

        document.getElementById('selectedSeatsInputDus').value = selectedSeatsDus.join(',');
        updateSelectedSeatsDisplay('dus', selectedSeatsDus);

        fetch('/save-seats', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                seatsDus: selectedSeatsDus,
                dateDus: dateDus,
                directionDus: directionDus,
                timeDus: timeDus,
            })
        })
        .then(response => response.json())
        .then(data => {
            alert('Seats saved successfully');
        })
        .catch(error => console.error('Error:', error));
    });

    document.getElementById('confirmSelectionIntors').addEventListener('click', function () {
        if (selectedSeatsIntors.length !== numberOfPassangers) {
            alert('Numărul de locuri selectate nu este suficient pentru toți pasagerii.');
            return;
        }

        const dateIntors = '{{ $searchResults['return'] ?? '' }}'; // Dynamic date for intors
        const directionIntors = '{{ $selectedRetourRoute->id ?? '' }}-{{ $searchResults['from'] ?? '' }}'; // Dynamic direction for intors
        const timeIntors = '{{ $selectedRetourRoute->start_place ?? '' }}'; // Dynamic time for intors

        document.getElementById('seatModalIntors').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');

        document.getElementById('selectedSeatsInputIntors').value = selectedSeatsIntors.join(',');
        updateSelectedSeatsDisplay('intors', selectedSeatsIntors);

        fetch('/save-seats', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                seatsIntors: selectedSeatsIntors,
                dateIntors: dateIntors,
                directionIntors: directionIntors,
                timeIntors: timeIntors,
            })
        })
        .then(response => response.json())
        .then(data => {
            alert('Seats saved successfully');
        })
        .catch(error => console.error('Error:', error));
    });

    function updateSelectedSeatsDisplay(type, seats) {
        const displayElement = document.getElementById('selectedSeatsDisplay' + type.charAt(0).toUpperCase() + type.slice(1));
        if (seats.length === 0) {
            displayElement.innerText = 'Nu sunt locuri selectate';
        } else {
            displayElement.innerText = 'Locuri selectate: ' + seats.join(', ');
        }
    }

    updateSelectedSeatsDisplay('dus', selectedSeatsDus);
    updateSelectedSeatsDisplay('intors', selectedSeatsIntors);

    function validateForm() {
        const form = document.getElementById('reservationForm');
        const requiredFields = form.querySelectorAll('[required]');
        let valid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('border-red-500');
                valid = false;
            } else {
                field.classList.remove('border-red-500');
            }
        });

        return valid;
    }

    document.getElementById('submitReservationBtn').addEventListener('click', function (event) {
        event.preventDefault();
        if (selectedSeatsDus.length < numberOfPassangers || 
            (searchResults.trip_type === 'dus-intors' && selectedSeatsIntors.length < numberOfPassangers)) {
            alert('Trebuie să selectați locuri = pasageri dus și întors.');
            return;
        }

        if (validateForm()) {
            document.getElementById('reservationForm').submit();
        } else {
            alert('Completați câmpurile obligatorii.');
        }
    });
});


</script>


@endif
@endsection
