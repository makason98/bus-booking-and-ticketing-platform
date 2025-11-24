@extends('layouts.app')

@section('content')
<h1 class="text-2xl text-center font-bold mb-6">Adaugă 'administrator'</h1>
<h3 class="text-xl text-center font-bold mb-6">Admin level 1 - Cel mai mare level de 'administrator'</h3>
<h3 class="text-xl text-center font-bold mb-6">Admin level 2 - Cel mai mic level de 'administrator' nu poate adauga Rute Sau Administratori</h3>
    <a href="{{ route('admin.users.index') }}" class="inline-block mb-6 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-900">Înapoi</a>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            @include('admin.users.partials.form')
            <button type="submit" class="btn btn-primary ml-4 mb-6 mt-6">Salvează</button>
        </form>
    </div>
@endsection