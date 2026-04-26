<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div class="py-12 bg-gray-900 text-white min-h-screen"
     x-data="{
        selectedSeats: [],
        toggleSeat(seatId) {
            if (this.selectedSeats.includes(seatId)) {
                // Zaten seçiliyse çıkar
                this.selectedSeats = this.selectedSeats.filter(id => id !== seatId);
            } else {
                // 4'ten azsa ekle, değilse uyarı ver
                if (this.selectedSeats.length < 4) {
                    this.selectedSeats.push(seatId);
                } else {
                    alert('Maksimum 4 bilet seçebilirsiniz!');
                }
            }
        }
     }">

    <div class="max-central mx-auto px-4">
        <h1 class="text-3xl font-bold mb-8 text-center">{{ $event->title }} - Koltuk Seçimi</h1>

        <div class="text-center mb-6">
            <span class="text-sm bg-gray-800 px-4 py-2 rounded-full border border-gray-700">
                Seçilen: <span class="text-orange-500 font-bold" x-text="selectedSeats.length"></span> / 4
            </span>
        </div>

        <div class="grid grid-cols-5 gap-4 md:grid-cols-10 justify-center mb-10">
            @for ($i = 1; $i <= 50; $i++)
                @php $isFull = in_array((string)$i, $occupiedSeats); @endphp

                <button
                    type="button"
                    class="h-10 w-10 rounded-t-lg transition-all duration-200 flex items-center justify-center text-xs font-bold shadow-md"
                    :class="{
                        'bg-red-600 cursor-not-allowed opacity-50': {{ $isFull ? 'true' : 'false' }},
                        'bg-green-500 hover:scale-110': !{{ $isFull ? 'true' : 'false' }} && !selectedSeats.includes({{ $i }}),
                        'bg-orange-500 ring-4 ring-white scale-110': selectedSeats.includes({{ $i }})
                    }"
                    @click="toggleSeat({{ $i }})"
                    {{ $isFull ? 'disabled' : '' }}
                >
                    {{ $i }}
                </button>
            @endfor
        </div>

        <div class="mt-10 p-6 bg-gray-800 rounded-xl border border-gray-700 shadow-xl" x-show="selectedSeats.length > 0">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-400">Seçilen Koltuklar:</p>
                    <p class="text-2xl font-bold text-orange-500">
                        <template x-for="(seat, index) in selectedSeats" :key="index">
                            <span>#<span x-text="seat"></span><span x-show="index !== selectedSeats.length - 1">, </span></span>
                        </template>
                    </p>
                </div>

                <form action="{{ route('tickets.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="event_id" value="{{ $event->id }}">
                    <input type="hidden" name="seat_numbers" :value="selectedSeats.join(',')">
                    <input type="hidden" name="price" value="{{ $event->price }}">

                    <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white px-8 py-3 rounded-lg font-bold transition-all">
                        <span x-text="selectedSeats.length"></span> Bilet İçin Ödemeye Geç
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
