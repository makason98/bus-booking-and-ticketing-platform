@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">Reservation Details</h1>

    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-xl font-bold mb-4">Reservation #{{ $reservation->reservation_number }}</h2>

        <p><strong>Name:</strong> {{ $reservation->first_name }} {{ $reservation->last_name }}</p>
        <p><strong>Phone:</strong> {{ $reservation->phone }}</p>
        <p><strong>Date:</strong> {{ $reservation->date }}</p>
        <p><strong>Time:</strong> {{ $reservation->time }}</p>
        <p><strong>Route:</strong> {{ $reservation->busRoute->route_tur }} - {{ $reservation->busRoute->route_retur }}</p>
        <p><strong>Selected Route:</strong> {{ $reservation->from }} - {{ $reservation->to }}</p>
    </div>

    <a href="{{ route('admin.dashboards.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back to Dashboard</a>
</div>
@endsection
