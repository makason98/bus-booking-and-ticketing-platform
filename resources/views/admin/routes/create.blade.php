@extends('layouts.app')

@section('content')
    <h1 class="text-2xl text-center font-bold mb-6">Crează Rută Nouă</h1>
    <a href="{{ url()->previous() }}" class="inline-block mb-6 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-900">Înapoi</a>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
        <form action="{{ route('admin.routes.store') }}" method="POST">
            @csrf
            <div class="grid gap-6 mb-6 md:grid-cols-2 mx-4 mt-6">
               <div>
                    <label for="route_tur" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Ruta-Pornire</label>
                    <select id="route_tur" name="route_tur" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('route_tur') border-red-500 @enderror" required>
                        @foreach($destinations as $destination)
                                                <option value="{{ $destination->route_tur }}">
                                                    {{ $destination->route_tur }}
                                                </option>
                                            @endforeach
                    </select>
                    @error('route_tur')
                        <p class="text-red-500 text-xs mt-1 rounded-md">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="route_retur" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Ruta-Destinație</label>
                    <select id="route_retur" name="route_retur" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('route_retur') border-red-500 @enderror" required>
                        @foreach($destinations_invers as $destination_invers)
                                                <option value="{{ $destination_invers->route_tur }}">
                                                    {{ $destination_invers->route_tur }}
                                                </option>
                                            @endforeach
                    </select>
                    @error('route_retur')
                        <p class="text-red-500 text-xs mt-1 rounded-md">{{ $message }}</p>
                    @enderror
                </div>
                 <div>
                    <label for="start_place" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Loc Pornire</label>
                    <input type="text" id="start_place" name="start_place" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('start_place') border-red-500 @enderror" placeholder="Autogara Centru" value="{{ old('start_place') }}" required />
                    @error('start_place')
                        <p class="text-red-500 text-xs mt-1 rounded-md">{{ $message }}</p>
                    @enderror
                </div> 
                 <div>
                    <label for="end_place" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Loc Destinație</label>
                    <input type="text" id="end_place" name="end_place" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('end_place') border-red-500 @enderror" placeholder="Autogara Fanny" value="{{ old('end_place') }}" required />
                    @error('end_place')
                        <p class="text-red-500 text-xs mt-1 rounded-md">{{ $message }}</p>
                    @enderror
                </div> 
                <div>
                    <label for="price" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Preț MDL</label>
                    <input type="number" step="0.01" id="price" name="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('price') border-red-500 @enderror" placeholder="Ex:200" value="{{ old('price') }}" required />
                    @error('price')
                        <p class="text-red-500 text-xs mt-1 rounded-md">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="price_ron" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Preț RON</label>
                    <input type="number" step="0.01" id="price_ron" name="price_ron" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('price_ron') border-red-500 @enderror" placeholder="Ex:200" value="{{ old('price_ron') }}" required />
                    @error('price_ron')
                        <p class="text-red-500 text-xs mt-1 rounded-md">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-full max-w-xs">
                    <label for="start_time" class="block text-lg font-medium text-gray-700">Selectează Timp-pornire</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input type="text" id="start_time" name="start_time" class="timepicker block w-full pl-3 pr-10 sm:text-sm border-gray-300 rounded-md @error('start_time') border-red-500 @enderror" value="{{ old('start_time') }}" required>
                        @error('time')
                            <p class="text-red-500 text-xs mt-1 rounded-md">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="w-full max-w-xs mt-4">
                    <label for="arrival_time" class="block text-lg font-medium text-gray-700">Selecteza Timp-destinație</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input type="text" id="arrival_time" name="arrival_time" class="timepicker block w-full pl-3 pr-10 sm:text-sm border-gray-300 rounded-md @error('arrival_time') border-red-500 @enderror" value="{{ old('arrival_time') }}" required>
                        @error('arrival_time')
                            <p class="text-red-500 text-xs mt-1 rounded-md">{{ $message }}</p>
                        @enderror
                    </div>
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
