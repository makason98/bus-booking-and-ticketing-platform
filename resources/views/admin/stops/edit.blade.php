@extends('layouts.app')

@section('content')
<h1 class="text-2xl text-center font-bold mb-6">Modifică oprire pentru ruta '{{ $route->route_tur }} - {{ $route->route_retur }}'</h1>
    <a href="{{ route('admin.stops.index', $route) }}" class="inline-block mb-6 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-900">Înapoi</a>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
        <form action="{{ route('admin.stops.update', [$route, $stop]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid gap-6 mb-6 md:grid-cols-2 mx-4 mt-6">
                <div>
                    <label for="route_stop" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Oprire</label>
                    <input type="text" id="route_stop" name="route_stop" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('route_tur') border-red-500 @enderror" placeholder="Ex:Chișinău" value="{{ $stop->route_stop }}" required />
                    @error('route_stop')
                        <p class="text-red-500 text-xs mt-1 rounded-md">{{ $message }}</p>
                    @enderror
                </div>
                   <div>
                    <label for="pickup" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Locul preluarii</label>
                    <input type="text" id="pickup" name="pickup" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('pickup') border-red-500 @enderror" placeholder="MOL Centura" value="{{ $stop->pickup }}" required />
                    @error('pickup')
                        <p class="text-red-500 text-xs mt-1 rounded-md">{{ $message }}</p>
                    @enderror
                </div> 
                <div class="w-full max-w-xs">
                    <label for="stop_time" class="block text-lg font-medium text-gray-700">Alege Ora</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input type="text" id="stop_time" name="stop_time" class="timepicker block w-full pl-3 pr-10 sm:text-sm border-gray-300 rounded-md @error('time') border-red-500 @enderror" value="{{ $stop->stop_time }}" required>
                        @error('stop_time')
                            <p class="text-red-500 text-xs mt-1 rounded-md">{{ $message }}</p>
                        @enderror
                    </div>
                </div> 
                <div>
                    <label for="price" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Preț MDL</label>
                    <input type="number" step="0.01" id="price" name="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('price') border-red-500 @enderror" placeholder="Ex:200" value="{{ $stop->price  }}" required />
                    @error('price')
                        <p class="text-red-500 text-xs mt-1 rounded-md">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="price_ron" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Preț RON</label>
                    <input type="number" step="0.01" id="price_ron" name="price_ron" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('price_ron') border-red-500 @enderror" placeholder="Ex:200" value="{{ $stop->price_ron }}" required />
                    @error('price_ron')
                        <p class="text-red-500 text-xs mt-1 rounded-md">{{ $message }}</p>
                    @enderror
                </div>             
            </div>
            <button type="submit" class="text-white ml-4 mb-4 bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-md w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.timepicker');
        M.Timepicker.init(elems, {
            twelveHour: false, // 24-hour format
            defaultTime: 'now',
            vibrate: true
        });
    });
</script>
@endsection