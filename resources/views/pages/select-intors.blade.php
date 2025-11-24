@extends('layouts.view')

@section('content')
<!-- Display selected Dus route details if needed -->

<!-- Modal for SearchResults2 -->
<div id="searchResults2Modal" class="fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-1 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <span class="sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle w-full sm:w-6/6 md:w-2/4">
            <div class="bg-white  pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-center">
                    <div class="mt-3 w-full text-center sm:mt-0 sm:text-left">
                     <a href="{{ route('home') }}" class="bg-blue-600 text-white font-bold py-1 px-4 rounded-full hover:bg-blue-700 transition duration-300">Înapoi</a>
                        <h3 class="text-xl text-center leading-6 font-medium text-gray-900">Selectează Ruta de Întoarcere</h3>
                        <div class="mt-2">
                            @foreach ($searchResults2 as $result2)
                             <div class="w-12/12 sm:w-12/12 md:w-4/4 lg:w-10/12 xl:w-10/12 mx-auto">
                    @php
                        $stops = $result2->stops->pluck('route_stop')->toArray();
                        $isStopSearch = (in_array($searchResults['from'], $stops) && $result2->route_retur == $searchResults['to']) ||
                                        ($result2->route_tur == $searchResults['from'] && in_array($searchResults['to'], $stops));
                        $matchedStops = $result2->stops->whereIn('route_stop', [$searchResults['from'], $searchResults['to']]);
                        $isStopSearch1 = (in_array($searchResults['from'], $stops) && in_array($searchResults['to'], $stops));
                        $matchedStops1 = $result2->stops->whereIn('route_stop', [$searchResults['from'], $searchResults['to']]);
                        $hasBothStops1 = $matchedStops1->count() === 2; // Check if both stops exist in the route

                        $isFromStop = $matchedStops->firstWhere('route_stop', $searchResults['to']);
                        $isToStop = $matchedStops->firstWhere('route_stop', $searchResults['from']);
                        $isFromRoute = $result2->route_tur == $searchResults['to'] || $result2->route_retur == $searchResults['to'];
                        $isToRoute = $result2->route_tur == $searchResults['from'] || $result2->route_retur == $searchResults['from'];
                    @endphp

        <div class="mb-2 p-4 flex justify-between items-center"> 
            <span class="text-center text-gray-700 font-semibold mx-auto">
                {{ $searchResults['return_formatted'] ?? '' }}
            </span>
            <div class='font-semibold'>Locuri disponibile :</div>
            @php
                $totalSeats = 20;
                $occupiedSeatsCount = isset($occupiedSeats[$result2->id][$result2->start_time]) ? count($occupiedSeats[$result2->id][$result2->start_time]) : 0;
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
                            <div class="text-2xl font-bold">{{ \Carbon\Carbon::parse($result2->start_time)->format('H:i') }}</div>
                            <div class="text2xl-gray-600">{{ $result2->route_tur }}</div>
                            <div class="text-sm text-gray-500">{{ $result2->start_place }}</div>
                        @endif
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold">Destinație</div>
                        @if($isToStop)
                            <div class="text-2xl font-bold">{{ \Carbon\Carbon::parse($isToStop->stop_time)->format('H:i') }}</div>
                            <div class="text2xl-gray-600">{{ $isToStop->route_stop }}</div>
                            <div class="text-sm text-gray-500">{{ $isToStop->pickup }}</div>
                        @else
                            <div class="text-2xl font-bold">{{ \Carbon\Carbon::parse($result2->arrival_time)->format('H:i') }}</div>
                            <div class="text2xl-gray-600">{{ $result2->route_retur }}</div>
                            <div class="text-sm text-gray-500">{{ $result2->end_place }}</div>
                        @endif
                    </div>
                </div>
                <div class="text-left mb-4">
                    <div class="flex justify-between items-center text-2xl border-b pb-2 font-bold text-gray-800">
                        <div>
                            @if(isset($searchResults['currency']) && $searchResults['currency'] == 'mdl')
                                {{ $isFromStop ? $result2->price-$isFromStop->price : ($isToStop ? $isToStop->price : $result2->price) }} MDL
                            @elseif(isset($searchResults['currency']) && $searchResults['currency'] == 'ron')
                                {{ $isFromStop ? $result2->price_ron - $isFromStop->price_ron : ($isToStop ? $isToStop->price_ron : $result2->price_ron) }} RON
                            @else
                                {{ $isFromStop ? $isFromStop->price : ($isToStop ? $isToStop->price : $result2->price) }} MDL
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
                    $stopFrom = $matchedStops1->firstWhere('route_stop', $searchResults['to']);
                    $stopTo = $matchedStops1->firstWhere('route_stop', $searchResults['from']);
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
                        <div class="text-2xl font-bold">{{ \Carbon\Carbon::parse($result2->start_time)->format('H:i') }}</div>
                        <div class="text2xl-gray-600">{{ $result2->route_tur }}</div>
                        <div class="text-sm text-gray-500">{{ $result2->start_place }}</div>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold">Destinație</div>
                        <div class="text-2xl font-bold">{{ \Carbon\Carbon::parse($result2->arrival_time)->format('H:i') }}</div>
                        <div class="text2xl-gray-600">{{ $result2->route_retur }}</div>
                        <div class="text-sm text-gray-500">{{ $result2->end_place }}</div>
                    </div>
                </div>
                <div class="text-left mb-4">
                    <div class="flex justify-between items-center text-2xl border-b pb-2 font-bold text-gray-800">
                        <div>
                            @if(isset($searchResults['currency']) && $searchResults['currency'] == 'mdl')
                                {{ $result2->price }} MDL
                            @elseif(isset($searchResults['currency']) && $searchResults['currency'] == 'ron')
                                {{ $result2->price_ron }} RON
                            @else
                                {{ $result2->price }} MDL
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
                                                    @if(($selectedStop1) || ($selectedStop2))
                                                    <input type="hidden" name="selectedStop1" value="{{ json_encode($selectedStop1) }}">
                                                    <input type="hidden" name="selectedStop2" value="{{ json_encode($selectedStop2) }}">
                                                     @endif
                                                     @if($selectedStops1  && $selectedStops2)
                                                    <input type="hidden" name="selectedStops1" value="{{ json_encode($selectedStops1) }}">
                                                    <input type="hidden" name="selectedStops2" value="{{ json_encode($selectedStops2) }}">
                                                    @endif
                                                    @if(($isFromStop && $isToRoute) || ($isFromRoute && $isToStop))
                                                        <input type="hidden" name="selectedInapoiStop1" value="{{ json_encode($isFromStop) }}">
                                                        <input type="hidden" name="selectedInapoiStop2" value="{{ json_encode($isToStop) }}">
                                                    @endif
                                                    @if($hasBothStops1 && isset($stopFrom) && isset($stopTo))
                                                        <input type="hidden" name="selectedInapoiStops1" value="{{ json_encode($stopFrom) }}">
                                                        <input type="hidden" name="selectedInapoiStops2" value="{{ json_encode($stopTo) }}">
                                                    @endif

                                                    <input type="hidden" name="searchResults" value="{{ json_encode($searchResults) }}">
                                                    <input type="hidden" name="selectedDusRoute" value="{{ json_encode($selectedDusRoute) }}">
                                                    <input type="hidden" name="selectedIntorsRoute" value="{{ json_encode($result2) }}">
                                                    <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded mt-2">
                                                        Selectează Întors
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
