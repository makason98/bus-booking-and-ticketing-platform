@extends('layouts.app')

@section('content')
<div class="pb-48">
    <h1 class="text-2xl text-center font-bold mb-6">Rezervari</h1>

    <!-- Display Success or Error Messages -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-8" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M14.348 14.849a1 1 0 010 1.414l-8.484 8.485a1 1 0 01-1.415-1.415l8.485-8.484a1 1 0 011.414 0z"/></svg>
            </span>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-8" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M14.348 14.849a1 1 0 010 1.414l-8.484 8.485a1 1 0 01-1.415-1.415l8.485-8.484a1 1 0 011.414 0z"/></svg>
            </span>
        </div>
    @endif

    <h1 class="text-2xl text-center font-bold mb-6">Cautare după data și Rută</h1>

    <form method="GET" action="{{ route('admin.dashboards.index') }}" class="mb-6">
        <div class="flex flex-wrap md:flex-nowrap space-y-4 md:space-y-0 md:space-x-4">
            <div class="w-full md:w-1/3">
                <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Selectează Dată:</label>
                <input type="date" id="date" name="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="w-full md:w-1/3">
                <label for="route" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selectează Rută:</label>
                <select id="route" name="route" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <option value="" disabled selected>Selectează o rută</option>
                    @foreach($routes as $route)
                        <option value="{{ $route->id }}">{{ $route->route_tur }} - {{ $route->route_retur }} ({{ $route->start_time }})</option>
                    @endforeach
                </select>
            </div>
        </div>
       <div class="text-center">
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
        Caută
    </button>
</div>

    </form>

    <h1 class="text-2xl text-center font-bold mb-6">Cautare după nr de rezervare</h1>
    <form method="GET" action="{{ route('admin.dashboards.index') }}" class="mb-6">
        <div class="flex flex-wrap md:flex-nowrap space-y-4 md:space-y-0 md:space-x-4">
            <div class="w-full md:w-1/3">
                <input type="text" name="search" placeholder="Căutare..." class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div class="w-full md:w-auto">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Caută
                </button>
            </div>
        </div>
    </form>

<div class="flex items-start mt-24">
@if(!request()->has('date') && !request()->has('route'))
    <h1 class="text-2xl text-center font-bold mb-6">Ultimele Rezervari ( Toate Rutele )</h1>
@endif
@if($selectedRouteDetails)
        <h1 class="text-2xl text-center font-bold mb-6">Rezervari pentru ruta : {{ $selectedRouteDetails['route_tur'] }} - {{ $selectedRouteDetails['route_retur'] }}</h1>
    @endif
   
</div>

    <!-- Display Search Results -->
    @if(isset($reservations) && $reservations->isNotEmpty())
        <div class="overflow-x-auto mt-6">
            <table class="table-auto w-full border border-black">
               <thead>
            <tr class="border border-black">
                <th class="px-4 py-2 border border-black">NR</th>
                <th class="px-4 py-2 border border-black">Nume</th>
                <th class="px-4 py-2 border border-black">Prenume</th>
                <th class="px-4 py-2 border border-black">Telefon</th>
                <th class="px-4 py-2 border border-black">Nr.Rezervare</th>
                <th class="px-4 py-2 border border-black">Dată</th>
                <th class="px-4 py-2 border border-black">Ora-preluării</th>
                <th class="px-4 py-2 border border-black">Pornire-Oprire</th>
                <th class="px-4 py-2 border border-black">Mențiuni</th>
            </tr>
        </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                        <tr class="border border-black">
                    <td class="border border-black px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="border border-black px-4 py-2">{{ $reservation->first_name }}</td>
                    <td class="border border-black px-4 py-2">{{ $reservation->last_name }}</td>
                    <td class="border border-black px-4 py-2">{{ $reservation->phone }}</td>
                    <td class="border border-black px-4 py-2">{{ $reservation->reservation_number }}</td>
                    <td class="border border-black px-4 py-2">{{ $reservation->date }}</td>
                    <td class="border border-black px-4 py-2">{{ $reservation->time }}</td>
                    {{-- <td class="border border-black px-4 py-2">{{ $reservation->busRoute->route_tur }} - {{ $reservation->busRoute->route_retur }}</td> --}}
                    <td class="border border-black px-4 py-2">{{ $reservation->from }}-{{ $reservation->to }}</td>
                    <td class="border border-black px-4 py-2">{{ $reservation->remarks }}</td>
                </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="flex justify-center mt-8">
                @if ($reservations->hasPages())
                    <div class="inline-flex rounded-md shadow-sm" role="navigation" aria-label="Pagination">
                        {{-- Previous Page Link --}}
                        @if ($reservations->onFirstPage())
                            <span class="px-3 py-2 rounded-l-md border border-gray-300 bg-gray-100 text-sm font-medium text-gray-400 cursor-not-allowed">
                                &lt;
                            </span>
                        @else
                            <a href="{{ $reservations->previousPageUrl() }}" class="px-3 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                &lt;
                            </a>
                        @endif
            
                        {{-- Pagination Elements --}}
                        @foreach ($reservations->getUrlRange(max($reservations->currentPage() - 2, 1), min($reservations->currentPage() + 2, $reservations->lastPage())) as $page => $url)
                            @if ($page == $reservations->currentPage())
                                <span aria-current="page" class="px-4 py-2 border-t border-b border-gray-300 bg-blue-50 text-sm font-medium text-blue-600">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" class="px-4 py-2 border-t border-b border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
            
                        {{-- Next Page Link --}}
                        @if ($reservations->hasMorePages())
                            <a href="{{ $reservations->nextPageUrl() }}" class="px-3 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                &gt;
                            </a>
                        @else
                            <span class="px-3 py-2 rounded-r-md border border-gray-300 bg-gray-100 text-sm font-medium text-gray-400 cursor-not-allowed">
                                &gt;
                            </span>
                        @endif
                    </div>
                @endif
            </div>
        </div>
<div class="flex items-center justify-center mt-24">
    @if(request()->has('date') && request()->has('route'))
        <form method="GET" action="{{ route('admin.dashboards.downloadPdf') }}">
            <input type="hidden" name="date" value="{{ request()->input('date') }}">
            <input type="hidden" name="route" value="{{ request()->input('route') }}">
            <button type="submit" class="bg-green-500 !important hover:bg-green-700 !important text-white !important font-bold !important py-2 !important px-4 !important rounded">
                Descarcă PDF
            </button>
        </form>
    @endif
</div>

    @else
        <p class="text-center text-gray-500 mt-6">Nu sunt rezervări pentru această căutare</p>
    @endif
</div>
@endsection