<!-- resources/views/partials/seat_modal.blade.php -->
<div class="bg-white rounded-lg shadow p-6 w-3/4 md:w-1/2 lg:w-1/3">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-black">Alege-ți locul</h2>
        <button class="closeModal text-black font-bold">&times;</button>
    </div>
    <div class="grid grid-cols-4 gap-2 mb-4">
        <!-- Custom arrangement of seats with white spaces -->
        @php $skip = false; @endphp
        @foreach(range(1, 19) as $seatNumber)
            @if($seatNumber == 1 && !$skip)
                <div class="border rounded-lg p-4 text-center">--</div>
                <div class="white-space"></div> <!-- White space -->
                <div class="white-space"></div> <!-- White space -->
                <div class="seat {{ in_array(20, $occupiedSeats) ? 'occupied' : 'available' }} border rounded-lg p-4 text-center">20</div>
                @php $skip = true; @endphp
            @endif
            <div class="seat {{ in_array($seatNumber, $occupiedSeats) ? 'occupied' : 'available' }} border rounded-lg p-4 text-center">{{ $seatNumber }}</div>
            @if(in_array($seatNumber, [2, 5, 8, 11, 14]))
                <div class="white-space"></div> <!-- White space -->
            @endif
        @endforeach
    </div>
    <div id="selectedSeatsDisplay" class="selectedSeatsDisplay mb-4"></div>
    <div class="flex items-center justify-between">
        <div class="flex-wrap items-center space-x-2">
            <div class="flex items-center space-x-1">
                <span class="bg-red-500 w-4 h-4 rounded-full inline-block"></span>
                <span>Ocupat</span>
            </div>
            <div class="flex items-center space-x-1">
                <span class="bg-green-500 w-4 h-4 rounded-full inline-block"></span>
                <span>Libere</span>
            </div>
            <div class="flex items-center space-x-1">
                <span class="bg-blue-500 w-4 h-4 rounded-full inline-block"></span>
                <span>Selectat</span>
            </div>
        </div>
        <button class="confirmSelection bg-blue-600 text-white font-bold rounded-full px-4 py-2">Confirmă selecția</button>
    </div>
</div>
