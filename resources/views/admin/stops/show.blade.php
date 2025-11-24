@extends('layouts.app')

@section('title', 'Stop Details for ' . $route->route_tur . ' to ' . $route->route_retur)

@section('content')
    <h1>Stop Details for {{ $route->route_tur }} to {{ $route->route_retur }}</h1>
    <p><strong>Route Stop:</strong> {{ $stop->route_stop }}</p>
    <p><strong>Stop Time:</strong> {{ $stop->stop_time }}</p>
    <p><strong>Price:</strong> {{ $stop->price }}</p>
    <a href="{{ route('admin.stops.index', $route) }}">Back to Stops</a>
@endsection
