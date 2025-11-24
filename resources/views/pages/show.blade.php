@extends('layouts.view')

@section('content')

<div class="max-w-7xl mx-auto bg-white shadow-md rounded-md p-6 mt-8 mb-8">
    <!-- Success or Error Message -->
    @if(session('success') || session('error'))
        <div class="{{ session('success') ? 'bg-green-100 border border-green-400 text-green-700' : 'bg-red-100 border border-red-400 text-red-700' }} px-4 py-3 rounded relative mb-6">
            <span class="block sm:inline">{{ session('success') ? session('success') : session('error') }}</span>
        </div>
    @endif

    <!-- Content -->
    @if(session('success'))
        <div class='mb-20 mt-20'>
            <h1 class="text-xl font-semibold text-center">Rezervare finalizată</h1>
            <p class='text-center'>Biletul cu rezervarea a fost trimis pe e-mail</p>
        </div>
    @endif


</div>

@endsection
