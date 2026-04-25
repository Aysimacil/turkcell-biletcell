@if ($errors->any())
    <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="max-w-2xl mx-auto p-8 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-bold mb-6">Yeni Etkinlik Oluştur</h2>

    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium">Etkinlik Başlığı</label>
            <input type="text" name="title" class="w-full border rounded-lg p-2" required>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium">Kategori</label>
                <select name="category" class="w-full border rounded-lg p-2">
                    <option value="Konser">Konser</option>
                    <option value="Tiyatro">Tiyatro</option>
                    <option value="Spor">Spor</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium">Mekan</label>
                <select name="venue_id" class="w-full border rounded-lg p-2">
                    @foreach($venues as $venue)
                        <option value="{{ $venue->id }}">{{ $venue->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium">Tarih</label>
                <input type="datetime-local" name="event_date" class="w-full border rounded-lg p-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium">Fiyat (TL)</label>
                <input type="number" name="price" class="w-full border rounded-lg p-2" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Açıklama</label>
            <textarea name="description" rows="4" class="w-full border rounded-lg p-2"></textarea>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium">Etkinlik Görseli</label>
            <input type="file" name="image" class="w-full border p-1">
        </div>

        <button type="submit" class="w-full bg-orange-600 text-white py-3 rounded-lg font-bold hover:bg-orange-700">
            Etkinliği Yayınla
        </button>
    </form>
</div>
