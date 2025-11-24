@extends('layouts.app')


@section('content')
    <h1>Route Details</h1>
    <p><strong>Route TUR:</strong> {{ $route->route_tur }}</p>
    <p><strong>Route RETUR:</strong> {{ $route->route_retur }}</p>
    <p><strong>Start Time:</strong> {{ $route->start_time }}</p>
    <p><strong>Arrival Time:</strong> {{ $route->arrival_time }}</p>
    <p><strong>Price:</strong> {{ $route->price }}</p>
    <a href="{{ route('admin.routes.index') }}">Back to Routes</a>
@endsection
