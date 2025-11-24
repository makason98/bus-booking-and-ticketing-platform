@extends('layouts.app')

@section('content')
    <h1 class="text-2xl text-center  font-bold mb-6">Rute</h1>
<!-- Display Success or Error Messages -->
@if (session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-8" role="alert">
    <strong class="font-bold">Success!</strong>
    <span class="block sm:inline">{{ session('success') }}</span>
    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
        <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M14.348 14.849a1 1 0 010 1.414l-8.484 8.485a1 1 0 01-1.415-1.415l8.485-8.484a1 1 0 011.414 0zm1.415-11.314a1 1 0 010 1.414L7.767 14.849a1 1 0 01-1.414-1.414l8.485-8.485a1 1 0 011.414 0z"/></svg>
    </span>
</div>
@endif

@if (session('error'))
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-8" role="alert">
    <strong class="font-bold">Error!</strong>
    <span class="block sm:inline">{{ session('error') }}</span>
    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M14.348 14.849a1 1 0 010 1.414l-8.484 8.485a1 1 0 01-1.415-1.415l8.485-8.484a1 1 0 011.414 0zm1.415-11.314a1 1 0 010 1.414L7.767 14.849a1 1 0 01-1.414-1.414l8.485-8.485a1 1 0 011.414 0z"/></svg>
    </span>
</div>
@endif
    <a href="{{ route('admin.routes.create') }}" class="inline-block mb-6 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Crează Rute</a>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-md text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Nr.</th>
                    <th scope="col" class="px-6 py-3">Ruta-Pornire</th>
                    <th scope="col" class="px-6 py-3">Ruta-Destinație</th>
                    <th scope="col" class="px-6 py-3">Timp-Pornire</th>
                    <th scope="col" class="px-6 py-3">Timp-Destinație</th>
                    <th scope="col" class="px-6 py-3">Opriri</th>
                    <th scope="col" class="px-6 py-3">Acțiune</th>
                    <th scope="col" class="px-6 py-3">Acțiune</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($routes as $route)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $route->route_tur }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $route->route_retur }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $route->start_time }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $route->arrival_time }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.stops.index', $route) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Stații</a>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.routes.edit', $route) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline ">Modifică</a>
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.routes.destroy', $route) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Șterge</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
