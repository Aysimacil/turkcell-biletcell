<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-8 text-orange-600">BiletCell Etkinlik Keşfet</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($events as $event)
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
            <img src="{{ asset('storage/' . $event->image_path) }}" class="w-full h-48 object-cover">

            <div class="p-4">
                <span class="text-xs font-bold text-blue-500 uppercase">{{ $event->category }}</span>
                <h2 class="text-xl font-semibold mt-2">{{ $event->title }}</h2>
                <p class="text-gray-600 text-sm mt-1">📍 {{ $event->venue->title }} / {{ $event->venue->city }}</p>
                <p class="text-gray-500 text-xs mt-2">📅 {{ $event->event_date }}</p>

                <div class="mt-4 flex justify-between items-center">
                    <span class="text-lg font-bold text-green-600">{{ $event->price }} ₺</span>
                    <a href="#" class="bg-orange-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-orange-600">İncele</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
