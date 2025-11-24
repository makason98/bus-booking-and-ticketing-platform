@extends('layouts.app')

@section('content')
    <h1 class="text-2xl text-center font-bold mb-6">Modifică Contact</h1>

    <a href="{{ url()->previous() }}" class="inline-block mb-6 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-900">Înapoi</a>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
        <form action="{{ route('admin.contacts.update', $contact->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid gap-6 mb-6 md:grid-cols-2 mx-4 mt-6">
                <div>
                    <label for="contact_name" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Contact Name</label>
                    <input type="text" id="contact_name" name="contact_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('contact_name') border-red-500 @enderror" placeholder="Ex: WhatsApp" value="{{ $contact->contact_name }}" required />
                    @error('contact_name')
                        <p class="text-red-500 text-xs mt-1 rounded-md">{{ $message }}</p>
                    @enderror
                </div>  
                <div>
                    <label for="contact_number" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Contact Number</label>
                    <input type="text" id="contact_number" name="contact_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('contact_number') border-red-500 @enderror" placeholder="+37369597312" value="{{ $contact->contact_number }}" required />
                    @error('contact_number')
                        <p class="text-red-500 text-xs mt-1 rounded-md">{{ $message }}</p>
                    @enderror
                </div>          
            </div>
            <button type="submit" class="text-white ml-4 mb-4 bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-md w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
    </div>
@endsection
