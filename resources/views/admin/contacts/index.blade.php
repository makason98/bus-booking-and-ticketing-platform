@extends('layouts.app')

@section('content')
    <h1 class="text-2xl text-center  font-bold mb-6">Contacte</h1>
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
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-md text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Contact</th>
                    <th scope="col" class="px-6 py-3">Numar</th>
                    <th scope="col" class="px-6 py-3">Acțiune</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $contact->contact_name }}</td>
                         <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $contact->contact_number }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.contacts.edit', $contact) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline ">Modifică</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
