<!DOCTYPE html>
<html>
<head>
    <title>Rezervari</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
 @php
        use Carbon\Carbon;
        Carbon::setLocale('ro');
    @endphp
     <h1 class="text-xl text-center font-bold mb-6">Rezervari pentru ruta : {{ \App\Helpers\TextHelper::removeDiacritics($selectedRouteDetails['route_tur']) }} - {{ \App\Helpers\TextHelper::removeDiacritics($selectedRouteDetails['route_retur']) }}</h1>
    <h3>Rezervari pentru data de : {{ Carbon::parse($reservations->first()->date)->translatedFormat('d F Y') }}</h3>

    <table>
        <thead>
            <tr>
                <th>NR</th>
                <th>Nume</th>
                <th>Prenume</th>
                <th>Telefon</th>
                <th>Data</th>
                <th>Ora</th>
                <th>Pornire-Destinatie</th>
                {{-- <th>Pornire-Destinatie</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $reservation->first_name }}</td>
                    <td>{{ $reservation->last_name }}</td>
                    <td>{{ $reservation->phone }}</td>
                    <td>{{ $reservation->date }}</td>
                    <td>{{ $reservation->time }}</td>
                     {{-- <td>{{ \App\Helpers\TextHelper::removeDiacritics($reservation->busRoute->route_tur) }} - {{ \App\Helpers\TextHelper::removeDiacritics($reservation->busRoute->route_retur) }}</td> --}}
                      <td>{{ \App\Helpers\TextHelper::removeDiacritics($reservation->from) }} - {{ \App\Helpers\TextHelper::removeDiacritics($reservation->to) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
