<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Ticket</title>
    <style>
        @font-face {
            font-family: 'Liberation Sans';
            src: url('{{ storage_path('fonts/DejaVuSerif-Bold.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        body {
            font-family: 'Liberation Sans', sans-serif;
            background-color: #f7fafc;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 24px0px;
            margin-bottom: 5px;
        }
        .header {
            text-align: center;
            margin-bottom: 5px;
        }
        .header h1 {
            font-size: 36px;
            font-weight: bold;
            margin: 0;
        }
        .header h2 {
            font-size: 24px;
            font-weight: 600;
            color: #4a5568;
            margin: 0;
        }
        .info, .contact {
            background-color: #f7fafc;
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 24px;
        }
        .info p, .contact p {
            margin: 8px 0;
            color: #4a5568;
        }
        .info strong, .contact strong {
            color: #2d3748;
        }
        .contact {
            text-align: center;
        }
        .contact1 {
            text-align: center;
        }
        .contact2 {
            text-align: center;
        }
    </style>
</head>
<body>
    @php
        use Carbon\Carbon;
        Carbon::setLocale('ro');

        $imagePath = public_path('storage/logo/scor.png');
        $imageData = base64_encode(file_get_contents($imagePath));
        $src = 'data:image/png;base64,' . $imageData;
    @endphp

    @if(isset($reservations[0]))
    <!-- Outbound (Dus) Reservation -->
    <div class="container">
        <div class="header">
            <h1>{{ \App\Helpers\TextHelper::removeDiacritics($reservations[0]->from) }} - {{ \App\Helpers\TextHelper::removeDiacritics($reservations[0]->to) }}</h1>
        </div>
        <img src="{{ $src }}" class='w-48 h-26' alt="Logo">
        <div class="contact1">
            <p><strong>BILET DUS</strong></p>
        </div>
        <div class="info">
            <p><strong>DATA :</strong> {{ Carbon::parse($reservations[0]->date)->translatedFormat('d F Y') }}</p>
            <p><strong>E-REZERVARE :</strong> #{{ $reservations[0]->reservation_number }}</p>
            <p><strong>LOC-PORNIRE :</strong> {{ \App\Helpers\TextHelper::removeDiacritics($reservations[0]->start_place) }}</p>
            <p><strong>PORNIRE-ORA :</strong> {{ $reservations[0]->time }}</p>
            <p><strong>LOC-DESTINATIE :</strong> {{ \App\Helpers\TextHelper::removeDiacritics($reservations[0]->end_place) }}</p>
            <p><strong>DESTINATIE-ORA :</strong> {{ $reservations[0]->time_arrival }}</p>
            

                <p><strong>NR PASAGERI :</strong> {{ $pasageri }}</p>


            <p><strong>LOCUL REZERVAT :#</strong> {{ $reservations[0]->seats }}</p>
            <p><strong>SPRE ACHITARE :</strong> {{ $reservations[0]->price }} - {{ $reservations[0]->currency }}</p>
        </div>
        <div class="contact">
            <p><strong>TRANSFERURI ZILNICE BUCURESTI - CHISINAU</strong></p>
            <p><strong>EMAIL:</strong> SCORPANTUR@GMAIL.COM</p>
            <p><strong>TEL:</strong> 079141110, 079033321</p>
            <p><strong>“SCORPAN TUR” SRL</strong></p>
            <p><strong>C/F:</strong> 1017600021037</p>
            <p><strong>ADRESA JURIDICA:</strong> MUN CHISINAU, COM TRUSENI, STR.GRIGORE URECHE 1C</p>
        </div>
    </div>
    @endif

    @if(isset($reservations[1]))
    <!-- Return (Inapoi) Reservation -->
    <div class="container">
        <div class="header">
            <h1>{{ \App\Helpers\TextHelper::removeDiacritics($reservations[1]->from) }} - {{ \App\Helpers\TextHelper::removeDiacritics($reservations[1]->to) }}</h1>
        </div>
        <img src="{{ $src }}" class='w-48 h-26' alt="Logo">
        <div class="contact1">
            <p><strong>BILET DUS</strong></p>
        </div>
        <div class="info">
            <p><strong>DATA :</strong> {{ Carbon::parse($reservations[1]->date)->translatedFormat('d F Y') }}</p>
            <p><strong>E-REZERVARE :</strong> #{{ $reservations[1]->reservation_number }}</p>
            <p><strong>LOC-PORNIRE :</strong> {{ \App\Helpers\TextHelper::removeDiacritics($reservations[1]->start_place) }}</p>
            <p><strong>PORNIRE-ORA :</strong> {{ $reservations[1]->time }}</p>
            <p><strong>LOC-DESTINATIE :</strong>{{ \App\Helpers\TextHelper::removeDiacritics($reservations[1]->end_place) }}</p>
            <p><strong>DESTINATIE-ORA :</strong> {{ $reservations[1]->time_arrival }}</p>
            
                    <p><strong>NR PASAGERI :</strong> {{ $pasageri }}</p>

            <p><strong>LOCUL REZERVAT DUS :#</strong> {{ $reservations[1]->seats }}</p>
        </div>
    </div>
    @endif

     @if(isset($reservations[2]))
    <!-- Return (Inapoi) Reservation -->
    <div class="container">
        <div class="header">
            <h2>{{ \App\Helpers\TextHelper::removeDiacritics($reservations[2]->from) }} - {{ \App\Helpers\TextHelper::removeDiacritics($reservations[2]->to) }}</h2>
        </div>
        <div class="contact2">
            <p><strong>BILET ÎNAPOI</strong></p>
        </div>
        <div class="info">
            <p><strong>DATA :</strong> {{ Carbon::parse($reservations[2]->date)->translatedFormat('d F Y') }}</p>
            <p><strong>E-REZERVARE :</strong> #{{ $reservations[2]->reservation_number }}</p>
            <p><strong>LOC-PORNIRE :</strong> {{ \App\Helpers\TextHelper::removeDiacritics($reservations[2]->start_place) }}</p>
            <p><strong>PORNIRE-ORA :</strong> {{ $reservations[2]->time }}</p>
            <p><strong>LOC-DESTINATIE :</strong>{{ \App\Helpers\TextHelper::removeDiacritics($reservations[2]->end_place) }}</p>
            <p><strong>LOC-ORA :</strong> {{ $reservations[2]->time_arrival }}</p>
            
            <p><strong>NR PASAGERI :</strong> {{ $pasageri }}</p>

            <p><strong>LOCUL REZERVAT INTORS :#</strong> {{ $reservations[2]->seats }}</p>
            <p><strong>SPRE ACHITARE TOTAL :</strong> {{ $reservations[2]->price }} - {{ $reservations[2]->currency }}</p>
        </div>
        <div class="contact">
            <p><strong>TRANSFERURI ZILNICE BUCURESTI - CHISINAU</strong></p>
            <p><strong>EMAIL:</strong> SCORPANTUR@GMAIL.COM</p>
            <p><strong>TEL:</strong> 079141110, 079033321</p>
            <p><strong>“SCORPAN TUR” SRL</strong></p>
            <p><strong>C/F:</strong> 1017600021037</p>
            <p><strong>ADRESA JURIDICA:</strong> MUN CHISINAU, COM TRUSENI, STR.GRIGORE URECHE 1C</p>
        </div>
    </div>
    @endif
</body>
</html>
