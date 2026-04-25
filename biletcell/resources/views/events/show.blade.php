<div class="container mx-auto p-8">
    <div class="flex flex-col md:flex-row gap-8">
        <div class="md:w-1/2">
            <img src="{{ asset('storage/' . $event->image_path) }}" class="w-full rounded-2xl shadow-xl">
        </div>

        <div class="md:w-1/2">
            <span class="bg-orange-100 text-orange-600 px-3 py-1 rounded-full text-sm font-bold">
                {{ $event->category }}
            </span>

            <h1 class="text-4xl font-bold mt-4">{{ $event->title }}</h1>

            <div class="mt-6 space-y-4 text-gray-700">
                <p>📍 <strong>Mekan:</strong> {{ $event->venue->title }}</p>
                <p>🏠 <strong>Adres:</strong> {{ $event->venue->address }}</p>
                <p>📅 <strong>Tarih:</strong> {{ $event->event_date }}</p>
                <p>💳 <strong>Fiyat:</strong> <span class="text-2xl text-green-600 font-bold">{{ $event->price }} ₺</span></p>
            </div>

            <div class="mt-8 p-6 bg-gray-50 rounded-xl">
                <h3 class="font-bold mb-2">Etkinlik Hakkında</h3>
                <p class="text-gray-600 leading-relaxed">{{ $event->description }}</p>
            </div>

            <a href="#" class="block w-full mt-8 bg-blue-600 text-white text-center py-4 rounded-xl font-bold text-lg hover:bg-blue-700 transition">
                Koltuk Seçimine Git
            </a>
        </div>
    </div>
</div>
