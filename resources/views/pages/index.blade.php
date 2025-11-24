@extends('layouts.view')

@section('content')

<div class="flex items-center justify-center mt-12 mb-12">
    <div class="p-4 bg-white rounded-lg shadow-lg w-6/6 max-w-6xl">
        @if(isset($searchResults))
            <button id="toggle-form" class="block md:hidden mt-6 md:ml-12 p-2 w-full md:w-24 bg-blue-500 text-white rounded-md shadow-sm hover:bg-blue-600">Arată căutarea</button>
            <div id="search-form" class="hidden md:block">
        @else
            <div id="search-form" class="block">
        @endif
            <form method="POST" action="{{ route('home') }}">
                @csrf
                <div class="flex flex-col md:flex-row items-center justify-between mb-4">
                    <div class="flex items-center space-x-4 mb-4 md:mb-0">
                        <label class="flex items-center">
                            <input type="radio" name="trip_type" class="form-radio text-blue-600" value="dus" 
                            @if((isset($searchResults['trip_type']) && $searchResults['trip_type'] == 'dus') || !isset($searchResults['trip_type'])) checked @endif onclick="toggleReturnDate()">
                            <span class="ml-2">Dus</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="trip_type" class="form-radio text-blue-600" value="dus-intors" 
                            @if(isset($searchResults['trip_type']) && $searchResults['trip_type'] == 'dus-intors') checked @endif onclick="toggleReturnDate()">
                            <span class="ml-2">Dus-Întors</span>
                        </label>
                    </div>
                    <ul class="flex w-100 gap-6">
                        <li>
                            <input type="radio" id="currency-mdl" name="currency" value="mdl" class="hidden peer" 
                            @if((isset($searchResults['currency']) && $searchResults['currency'] == 'mdl') || !isset($searchResults['currency'])) checked @endif />
                            <label for="currency-mdl" class="inline-flex items-center justify-between w-full p-3 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">MDL</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="currency-ron" name="currency" value="ron" class="hidden peer"
                            @if(isset($searchResults['currency']) && $searchResults['currency'] == 'ron') checked @endif />
                            <label for="currency-ron" class="inline-flex items-center justify-between w-full p-3 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">RON</div>
                                </div>
                            </label>
                        </li>
                    </ul>
                </div>
                <div class="flex flex-col md:grid md:grid-cols-3 lg:flex lg:flex-row items-center space-x-0 md:space-x-4 gap-4 w-full">
                    <div class="w-full mb-4 md:mb-0">
                        <label for="from" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Din</label>
                        <select id="from" name="from" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach($destinations as $destination)
                                <option value="{{ $destination->route_tur }}" {{ (isset($searchResults['from']) && $searchResults['from'] == $destination->route_tur) ? 'selected' : '' }}>
                                    {{ $destination->route_tur }}
                                </option>
                            @endforeach
                        </select>
                    </div>                
                    <div class="w-full mb-4 md:mb-0">
                        <label for="to" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Spre</label>
                        <select id="to" name="to" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach($destinations_invers as $destination_invers)
                                <option value="{{ $destination_invers->route_tur }}" {{ (isset($searchResults['to']) && $searchResults['to'] == $destination_invers->route_tur) ? 'selected' : '' }}>
                                    {{ $destination_invers->route_tur }}
                                </option>
                            @endforeach
                        </select>
                    </div>                
                    <div class="w-full mb-4 md:mb-0">
                        <label for="depart" class="block text-sm font-medium text-gray-700">Dus</label>
                        <input type="date" id="depart" name="depart" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                        value="{{ old('depart', $today) }}">
                    </div>
                    <div class="w-full mb-4 md:mb-0" id="return-container" style="display: none;">
                        <label for="return" class="block text-sm font-medium text-gray-700">Întors</label>
                        <input type="date" id="return" name="return" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                        value="{{ old('return', $today) }}">
                    </div>
                    <div class="relative w-full mb-4 md:mb-0">
                        <label for="quantity-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pasageri:</label>
                        <div class="relative flex items-center">
                            <button type="button" id="decrement-button" data-input-counter-decrement="quantity-input" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                </svg>
                            </button>
                            <input type="text" id="quantity-input" name="passangers" value="{{ $searchResults['passangers'] ?? 1 }}" data-input-counter aria-describedby="helper-text-explanation" class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                            <button type="button" id="increment-button" data-input-counter-increment="quantity-input" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="w-full">
                        <button type="submit" class="mt-6 md:ml-12 p-2 w-full md:w-24 bg-blue-500 text-white rounded-md shadow-sm hover:bg-blue-600">Caută</button>
                    </div>
                </div>
                <input type="hidden" name="selectedDusRoute" id="selectedDusRoute" value="{{ session('selectedDusRoute') }}">
                <input type="hidden" name="selectedIntorsRoute" id="selectedIntorsRoute" value="{{ session('selectedIntorsRoute') }}">
            </form>
        </div>

        @if ($searchResults1->isNotEmpty() || $searchResults2->isNotEmpty())
            <div class="mt-12">
                <h2 class="text-xl font-semibold text-center">Rezultatele căutării:</h2>
                @if($searchResults['trip_type'] == 'dus')
              @foreach ($searchResults1->merge($searchResults3) as $result)
                <div class="w-12/12 sm:w-12/12 md:w-4/4 lg:w-10/12 xl:w-6/12 mx-auto">
                    @php
                        $stops = $result->stops->pluck('route_stop')->toArray();
                        $isStopSearch = (in_array($searchResults['from'], $stops) && $result->route_retur == $searchResults['to']) ||
                                        ($result->route_tur == $searchResults['from'] && in_array($searchResults['to'], $stops));
                        $matchedStops = $result->stops->whereIn('route_stop', [$searchResults['from'], $searchResults['to']]);
                        $isStopSearch1 = (in_array($searchResults['from'], $stops) && in_array($searchResults['to'], $stops));
                        $matchedStops1 = $result->stops->whereIn('route_stop', [$searchResults['from'], $searchResults['to']]);
                        $hasBothStops1 = $matchedStops1->count() === 2; // Check if both stops exist in the route

                        $isFromStop = $matchedStops->firstWhere('route_stop', $searchResults['from']);
                        $isToStop = $matchedStops->firstWhere('route_stop', $searchResults['to']);
                        $isFromRoute = $result->route_tur == $searchResults['from'] || $result->route_retur == $searchResults['from'];
                        $isToRoute = $result->route_tur == $searchResults['to'] || $result->route_retur == $searchResults['to'];
                    @endphp

        <div class="mb-2 p-4 flex justify-between items-center"> 
            <span class="text-center text-gray-700 font-semibold mx-auto">
                {{ $searchResults['depart_formatted'] ?? '' }}
            </span>
            <div class='font-semibold'>Locuri disponibile :</div>
            @php
                $totalSeats = 20;
                $occupiedSeatsCount = isset($occupiedSeats[$result->id][$result->start_time]) ? count($occupiedSeats[$result->id][$result->start_time]) : 0;
                $freeSeats = $totalSeats - $occupiedSeatsCount;
            @endphp
            <div class="{{ $freeSeats < 4 ? 'text-red-500' : 'text-green-500' }}">{{ $freeSeats }}</div>
        </div>

        <div class="bg-gray-100 rounded-lg shadow-md mb-8 p-4 hover:bg-blue-100 transition duration-300">
            @if(($isFromStop && $isToRoute) || ($isFromRoute && $isToStop))
                <div class="flex justify-between items-center mb-2">
                    <div>
                        <div class="text-2xl font-bold">Pornire:</div>
                        @if($isFromStop)
                            <div class="text-2xl font-bold">{{ \Carbon\Carbon::parse($isFromStop->stop_time)->format('H:i') }}</div>
                            <div class="text2xl-gray-600">{{ $isFromStop->route_stop }}</div>
                            <div class="text-sm text-gray-500">{{ $isFromStop->pickup }}</div>
                        @else
                            <div class="text-2xl font-bold">{{ \Carbon\Carbon::parse($result->start_time)->format('H:i') }}</div>
                            <div class="text2xl-gray-600">{{ $result->route_tur }}</div>
                            <div class="text-sm text-gray-500">{{ $result->start_place }}</div>
                        @endif
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold">Destinație</div>
                        @if($isToStop)
                            <div class="text-2xl font-bold">{{ \Carbon\Carbon::parse($isToStop->stop_time)->format('H:i') }}</div>
                            <div class="text2xl-gray-600">{{ $isToStop->route_stop }}</div>
                            <div class="text-sm text-gray-500">{{ $isToStop->pickup }}</div>
                        @else
                            <div class="text-2xl font-bold">{{ \Carbon\Carbon::parse($result->arrival_time)->format('H:i') }}</div>
                            <div class="text2xl-gray-600">{{ $result->route_retur }}</div>
                            <div class="text-sm text-gray-500">{{ $result->end_place }}</div>
                        @endif
                    </div>
                </div>
                <div class="text-left mb-4">
                    <div class="flex justify-between items-center text-2xl border-b pb-2 font-bold text-gray-800">
                        <div>
                            @if(isset($searchResults['currency']) && $searchResults['currency'] == 'mdl')
                                {{ $isFromStop ? $result->price-$isFromStop->price : ($isToStop ? $isToStop->price : $result->price) }} MDL
                            @elseif(isset($searchResults['currency']) && $searchResults['currency'] == 'ron')
                                {{ $isFromStop ? $result->price_ron - $isFromStop->price_ron : ($isToStop ? $isToStop->price_ron : $result->price_ron) }} RON
                            @else
                                {{ $isFromStop ? $isFromStop->price : ($isToStop ? $isToStop->price : $result->price) }} MDL
                            @endif
                        </div>
                        <div class="flex space-x-2 text-gray-600">
                            <span><i class="bi bi-wifi"></i></span>
                            <span><i class="bi bi-plug"></i></span>
                            <span><i class="bi bi-usb"></i></span>
                            <span>❄️</span>
                        </div>
                    </div>
                </div>
            @elseif($hasBothStops1)
                @php
                    $stopFrom = $matchedStops1->firstWhere('route_stop', $searchResults['from']);
                    $stopTo = $matchedStops1->firstWhere('route_stop', $searchResults['to']);
                @endphp

                @if(isset($stopFrom) && isset($stopTo))
                    <div class="flex justify-between items-center mb-2">
                        <div>
                            <div class="text-2xl font-bold">Pornire:</div>
                            <div class="text-2xl font-bold">{{ \Carbon\Carbon::parse($stopFrom->stop_time)->format('H:i') }}</div>
                            <div class="text2xl-gray-600">{{ $stopFrom->route_stop }}</div>
                            <div class="text-sm text-gray-500">{{ $stopFrom->pickup }}</div>
                        </div>
                        <div class="text-right">
                            <div class="text-2xl font-bold">Destinație:</div>
                            <div class="text-2xl font-bold">{{ \Carbon\Carbon::parse($stopTo->stop_time)->format('H:i') }}</div>
                            <div class="text2xl-gray-600">{{ $stopTo->route_stop }}</div>
                            <div class="text-sm text-gray-500">{{ $stopTo->pickup }}</div>
                        </div>
                    </div>
                    <div class="text-left mb-4">
                        <div class="flex justify-between items-center text-2xl border-b pb-2 font-bold text-gray-800">
                            <div>
                                @if(isset($searchResults['currency']) && $searchResults['currency'] == 'mdl')
                                    {{ $stopTo->price - $stopFrom->price }} MDL
                                @elseif(isset($searchResults['currency']) && $searchResults['currency'] == 'ron')
                                    {{ $stopTo->price_ron - $stopFrom->price_ron }} RON
                                @else
                                    {{ $stopTo->price - $stopFrom->price }} MDL
                                @endif
                            </div>
                            <div class="flex space-x-2 text-gray-600">
                                <span><i class="bi bi-wifi"></i></span>
                                <span><i class="bi bi-plug"></i></span>
                                <span><i class="bi bi-usb"></i></span>
                                <span>❄️</span>
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <div class="flex justify-between items-center mb-2">
                    <div>
                        <div class="text-2xl font-bold">Pornire:</div>
                        <div class="text-2xl font-bold">{{ \Carbon\Carbon::parse($result->start_time)->format('H:i') }}</div>
                        <div class="text2xl-gray-600">{{ $result->route_tur }}</div>
                        <div class="text-sm text-gray-500">{{ $result->start_place }}</div>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold">Destinație</div>
                        <div class="text-2xl font-bold">{{ \Carbon\Carbon::parse($result->arrival_time)->format('H:i') }}</div>
                        <div class="text2xl-gray-600">{{ $result->route_retur }}</div>
                        <div class="text-sm text-gray-500">{{ $result->end_place }}</div>
                    </div>
                </div>
                <div class="text-left mb-4">
                    <div class="flex justify-between items-center text-2xl border-b pb-2 font-bold text-gray-800">
                        <div>
                            @if(isset($searchResults['currency']) && $searchResults['currency'] == 'mdl')
                                {{ $result->price }} MDL
                            @elseif(isset($searchResults['currency']) && $searchResults['currency'] == 'ron')
                                {{ $result->price_ron }} RON
                            @else
                                {{ $result->price }} MDL
                            @endif
                        </div>
                        <div class="flex space-x-2 text-gray-600">
                            <span><i class="bi bi-wifi"></i></span>
                            <span><i class="bi bi-plug"></i></span>
                            <span><i class="bi bi-usb"></i></span>
                            <span>❄️</span>
                        </div>
                    </div>
                </div>
            @endif

            <div class="flex justify-between items-center">
                <button class="bg-green-500 text-white px-4 py-1 rounded-full text-sm">Direct</button>
                @if($freeSeats > 0 && $freeSeats >= $searchResults['passangers'])
                    <div class="flex justify-end items-center">
                        <form method="POST" action="{{ route('create') }}">
                            @csrf
                            @if(($isFromStop && $isToRoute) || ($isFromRoute && $isToStop))
                                <input type="hidden" name="selectedStop1" value="{{ json_encode($isFromStop) }}">
                                <input type="hidden" name="selectedStop2" value="{{ json_encode($isToStop) }}">
                            @endif
                            @if($hasBothStops1 && isset($stopFrom) && isset($stopTo))
                                <input type="hidden" name="selectedStops1" value="{{ json_encode($stopFrom) }}">
                                <input type="hidden" name="selectedStops2" value="{{ json_encode($stopTo) }}">
                            @endif
                            <input type="hidden" name="searchResults" value="{{ json_encode($searchResults) }}">
                            <input type="hidden" name="selectedRoute" value="{{ json_encode($result) }}">
                            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">
                                Continuă
                            </button>
                        </form>
                    </div>
                    @else
                   <div class='font-semibold text-red-500'>Pasageri > Locuri libere</div>
                @endif

            </div>
        </div>
        <div class='border-b border-gray-400 mt'></div>
    </div>
@endforeach
        
                @elseif($searchResults['trip_type'] == 'dus-intors')
                
                       @foreach ($searchResults1->merge($searchResults3) as $result1)
                <div class="w-12/12 sm:w-12/12 md:w-4/4 lg:w-10/12 xl:w-6/12 mx-auto">
                    @php
                        $stops = $result1->stops->pluck('route_stop')->toArray();
                        $isStopSearch = (in_array($searchResults['from'], $stops) && $result1->route_retur == $searchResults['to']) ||
                                        ($result1->route_tur == $searchResults['from'] && in_array($searchResults['to'], $stops));
                        $matchedStops = $result1->stops->whereIn('route_stop', [$searchResults['from'], $searchResults['to']]);
                        $isStopSearch1 = (in_array($searchResults['from'], $stops) && in_array($searchResults['to'], $stops));
                        $matchedStops1 = $result1->stops->whereIn('route_stop', [$searchResults['from'], $searchResults['to']]);
                        $hasBothStops1 = $matchedStops1->count() === 2; // Check if both stops exist in the route

                        $isFromStop = $matchedStops->firstWhere('route_stop', $searchResults['from']);
                        $isToStop = $matchedStops->firstWhere('route_stop', $searchResults['to']);
                        $isFromRoute = $result1->route_tur == $searchResults['from'] || $result1->route_retur == $searchResults['from'];
                        $isToRoute = $result1->route_tur == $searchResults['to'] || $result1->route_retur == $searchResults['to'];
                    @endphp

        <div class="mb-2 p-4 flex justify-between items-center"> 
            <span class="text-center text-gray-700 font-semibold mx-auto">
                {{ $searchResults['depart_formatted'] ?? '' }}
            </span>
            <div class='font-semibold'>Locuri disponibile :</div>
            @php
                $totalSeats = 20;
                $occupiedSeatsCount = isset($occupiedSeats[$result1->id][$result1->start_time]) ? count($occupiedSeats[$result1->id][$result1->start_time]) : 0;
                $freeSeats = $totalSeats - $occupiedSeatsCount;
            @endphp
            <div class="{{ $freeSeats < 4 ? 'text-red-500' : 'text-green-500' }}">{{ $freeSeats }}</div>
        </div>

        <div class="bg-gray-100 rounded-lg shadow-md mb-8 p-4 hover:bg-blue-100 transition duration-300">
            @if(($isFromStop && $isToRoute) || ($isFromRoute && $isToStop))
                <div class="flex justify-between items-center mb-2">
                    <div>
                        <div class="text-2xl font-bold">Pornire:</div>
                        @if($isFromStop)
                            <div class="text-2xl font-bold">{{ \Carbon\Carbon::parse($isFromStop->stop_time)->format('H:i') }}</div>
                            <div class="text2xl-gray-600">{{ $isFromStop->route_stop }}</div>
                            <div class="text-sm text-gray-500">{{ $isFromStop->pickup }}</div>
                        @else
                            <div class="text-2xl font-bold">{{ \Carbon\Carbon::parse($result1->start_time)->format('H:i') }}</div>
                            <div class="text2xl-gray-600">{{ $result1->route_tur }}</div>
                            <div class="text-sm text-gray-500">{{ $result1->start_place }}</div>
                        @endif
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold">Destinație</div>
                        @if($isToStop)
                            <div class="text-2xl font-bold">{{ \Carbon\Carbon::parse($isToStop->stop_time)->format('H:i') }}</div>
                            <div class="text2xl-gray-600">{{ $isToStop->route_stop }}</div>
                            <div class="text-sm text-gray-500">{{ $isToStop->pickup }}</div>
                        @else
                            <div class="text-2xl font-bold">{{ \Carbon\Carbon::parse($result1->arrival_time)->format('H:i') }}</div>
                            <div class="text2xl-gray-600">{{ $result1->route_retur }}</div>
                            <div class="text-sm text-gray-500">{{ $result1->end_place }}</div>
                        @endif
                    </div>
                </div>
                <div class="text-left mb-4">
                    <div class="flex justify-between items-center text-2xl border-b pb-2 font-bold text-gray-800">
                        <div>
                            @if(isset($searchResults['currency']) && $searchResults['currency'] == 'mdl')
                                {{ $isFromStop ? $result1->price-$isFromStop->price : ($isToStop ? $isToStop->price : $result1->price) }} MDL
                            @elseif(isset($searchResults['currency']) && $searchResults['currency'] == 'ron')
                                {{ $isFromStop ? $result1->price_ron - $isFromStop->price_ron : ($isToStop ? $isToStop->price_ron : $result1->price_ron) }} RON
                            @else
                                {{ $isFromStop ? $isFromStop->price : ($isToStop ? $isToStop->price : $result1->price) }} MDL
                            @endif
                        </div>
                        <div class="flex space-x-2 text-gray-600">
                            <span><i class="bi bi-wifi"></i></span>
                            <span><i class="bi bi-plug"></i></span>
                            <span><i class="bi bi-usb"></i></span>
                            <span>❄️</span>
                        </div>
                    </div>
                </div>
            @elseif($hasBothStops1)
                @php
                    $stopFrom = $matchedStops1->firstWhere('route_stop', $searchResults['from']);
                    $stopTo = $matchedStops1->firstWhere('route_stop', $searchResults['to']);
                @endphp

                @if(isset($stopFrom) && isset($stopTo))
                    <div class="flex justify-between items-center mb-2">
                        <div>
                            <div class="text-2xl font-bold">Pornire:</div>
                            <div class="text-2xl font-bold">{{ \Carbon\Carbon::parse($stopFrom->stop_time)->format('H:i') }}</div>
                            <div class="text2xl-gray-600">{{ $stopFrom->route_stop }}</div>
                            <div class="text-sm text-gray-500">{{ $stopFrom->pickup }}</div>
                        </div>
                        <div class="text-right">
                            <div class="text-2xl font-bold">Destinație:</div>
                            <div class="text-2xl font-bold">{{ \Carbon\Carbon::parse($stopTo->stop_time)->format('H:i') }}</div>
                            <div class="text2xl-gray-600">{{ $stopTo->route_stop }}</div>
                            <div class="text-sm text-gray-500">{{ $stopTo->pickup }}</div>
                        </div>
                    </div>
                    <div class="text-left mb-4">
                        <div class="flex justify-between items-center text-2xl border-b pb-2 font-bold text-gray-800">
                            <div>
                                @if(isset($searchResults['currency']) && $searchResults['currency'] == 'mdl')
                                    {{ $stopTo->price - $stopFrom->price }} MDL
                                @elseif(isset($searchResults['currency']) && $searchResults['currency'] == 'ron')
                                    {{ $stopTo->price_ron - $stopFrom->price_ron }} RON
                                @else
                                    {{ $stopTo->price - $stopFrom->price }} MDL
                                @endif
                            </div>
                            <div class="flex space-x-2 text-gray-600">
                                <span><i class="bi bi-wifi"></i></span>
                                <span><i class="bi bi-plug"></i></span>
                                <span><i class="bi bi-usb"></i></span>
                                <span>❄️</span>
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <div class="flex justify-between items-center mb-2">
                    <div>
                        <div class="text-2xl font-bold">Pornire:</div>
                        <div class="text-2xl font-bold">{{ \Carbon\Carbon::parse($result1->start_time)->format('H:i') }}</div>
                        <div class="text2xl-gray-600">{{ $result1->route_tur }}</div>
                        <div class="text-sm text-gray-500">{{ $result1->start_place }}</div>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold">Destinație</div>
                        <div class="text-2xl font-bold">{{ \Carbon\Carbon::parse($result1->arrival_time)->format('H:i') }}</div>
                        <div class="text2xl-gray-600">{{ $result1->route_retur }}</div>
                        <div class="text-sm text-gray-500">{{ $result1->end_place }}</div>
                    </div>
                </div>
                <div class="text-left mb-4">
                    <div class="flex justify-between items-center text-2xl border-b pb-2 font-bold text-gray-800">
                        <div>
                            @if(isset($searchResults['currency']) && $searchResults['currency'] == 'mdl')
                                {{ $result1->price }} MDL
                            @elseif(isset($searchResults['currency']) && $searchResults['currency'] == 'ron')
                                {{ $result1->price_ron }} RON
                            @else
                                {{ $result1->price }} MDL
                            @endif
                        </div>
                        <div class="flex space-x-2 text-gray-600">
                            <span><i class="bi bi-wifi"></i></span>
                            <span><i class="bi bi-plug"></i></span>
                            <span><i class="bi bi-usb"></i></span>
                            <span>❄️</span>
                        </div>
                    </div>
                </div>
            @endif

            <div class="flex justify-between items-center">
                <button class="bg-green-500 text-white px-4 py-1 rounded-full text-sm">Direct</button>
               @if($freeSeats > 0 && $freeSeats >= $searchResults['passangers'])
                    <div class="flex justify-end items-center">
                        <form method="POST" action="{{ route('selectIntors') }}">
                                            @csrf
                                            @if(($isFromStop && $isToRoute) || ($isFromRoute && $isToStop))
                                            <input type="hidden" name="selectedDusStop1" value="{{ json_encode($isFromStop) }}">
                                            <input type="hidden" name="selectedDusStop2" value="{{ json_encode($isToStop) }}">
                                        @endif
                                        @if($hasBothStops1 && isset($stopFrom) && isset($stopTo))
                                            <input type="hidden" name="selectedDusStops1" value="{{ json_encode($stopFrom) }}">
                                            <input type="hidden" name="selectedDusStops2" value="{{ json_encode($stopTo) }}">
                                        @endif
                                            <input type="hidden" name="searchResults" value="{{ json_encode($searchResults) }}">
                                            <input type="hidden" name="selectedDusRoute" value="{{ json_encode($result1) }}">
                                            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded mt-2">
                                                Selectează Dus
                                            </button>
                                        </form>
                    </div>
                     @else
                   <div class='font-semibold text-red-500'>Pasageri > Locuri libere</div>
                @endif
            </div>
        </div>
        <div class='border-b border-gray-400 mt'></div>
    </div>
@endforeach

                   @yield('content')


                    <!-- Form to submit selected routes -->


                @endif
            </div>
        @endif
        
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const today = "{{ $today }}";
        const searchResults = @json($searchResults);

        // Set depart date input value
        const departInput = document.getElementById('depart');
        if (departInput) {
            departInput.value = searchResults?.depart ?? "{{ old('depart', $today) }}";
        }

        // Set return date input value if trip type is dus-intors
        const returnInput = document.getElementById('return');
        const returnContainer = document.getElementById('return-container');
        if (searchResults && searchResults.trip_type === 'dus-intors') {
            if (returnInput) {
                returnInput.value = searchResults.return ?? "{{ old('return', $today) }}";
            }
            if (returnContainer) {
                returnContainer.style.display = 'block';
            }
        } else {
            if (returnContainer) {
                returnContainer.style.display = 'none';
            }
        }

        // Toggle return date visibility based on trip type selection
        const tripTypeInputs = document.querySelectorAll('input[name="trip_type"]');
        if (tripTypeInputs) {
            tripTypeInputs.forEach(input => input.addEventListener('change', toggleReturnDate));
        }

        function toggleReturnDate() {
            const tripType = document.querySelector('input[name="trip_type"]:checked')?.value;
            const returnContainer = document.getElementById('return-container');
            if (tripType === 'dus-intors') {
                returnContainer.style.display = 'block';
            } else {
                returnContainer.style.display = 'none';
            }
        }

        // Initialize toggleReturnDate on load
        toggleReturnDate();

        // Toggle search form on mobile view
        const toggleFormButton = document.getElementById('toggle-form');
        if (toggleFormButton) {
            toggleFormButton.addEventListener('click', function() {
                const form = document.getElementById('search-form');
                if (form) {
                    form.style.display = 'block';
                }
                this.style.display = 'none';
            });
        }
    });

let selectedDusRoute = null;
let selectedIntorsRoute = null;

function selectDusRoute(route) {
    selectedDusRoute = route;
    console.log('Selected Dus Route:', selectedDusRoute); // Debugging log

    // Set the value of the hidden input field for selectedDusRoute
    const dusRouteInput = document.getElementById('selectedDusRoute');
    if (dusRouteInput) {
        dusRouteInput.value = JSON.stringify(selectedDusRoute);
    }

    // Show the modal for selecting the return route
    const modal = document.getElementById('searchResults2Modal');
    if (modal) {
        modal.classList.remove('hidden');
    } else {
        console.error('searchResults2Modal element not found');
    }
}

function selectIntorsRoute(route) {
    selectedIntorsRoute = route;
    console.log('Selected Intors Route:', selectedIntorsRoute); // Debugging log

    // Set the value of the hidden input field for selectedIntorsRoute
    const intorsRouteInput = document.getElementById('selectedIntorsRoute');
    if (intorsRouteInput) {
        intorsRouteInput.value = JSON.stringify(selectedIntorsRoute);
    }

    // Submit the form
    const submitButton = document.getElementById('submitFormButton');
    if (submitButton) {
        submitButton.click();
    } else {
        console.error('submitFormButton element not found');
    }
}
</script>
@endsection

