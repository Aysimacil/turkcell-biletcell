@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-900 min-h-screen text-white">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-3xl font-bold mb-8 border-b border-gray-800 pb-4">
            <span class="text-orange-500">Cüzdanım:</span> Biletlerim
        </h1>

        @if($tickets->isEmpty())
            <div class="text-center py-20 bg-gray-800 rounded-2xl border border-dashed border-gray-700">
                <p class="text-gray-400 mb-6">Henüz hiç biletiniz bulunmuyor.</p>
                <a href="{{ route('events.index') }}" class="bg-orange-600 px-6 py-3 rounded-lg font-bold hover:bg-orange-700 transition">
                    Etkinlikleri Keşfet
                </a>
            </div>
        @else
            <div class="grid gap-6">
                @foreach($tickets as $ticket)
                    <div class="bg-gray-800 rounded-xl overflow-hidden border border-gray-700 flex flex-col md:flex-row shadow-lg">
                        <div class="md:w-48 bg-orange-600 flex items-center justify-center p-4">
                            <div class="text-center">
                                <span class="block text-4xl font-black">#{{ $ticket->seat_number }}</span>
                                <span class="text-xs uppercase tracking-widest opacity-80 font-bold">Koltuk</span>
                            </div>
                        </div>

                        <div class="flex-grow p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h2 class="text-xl font-bold text-white">{{ $ticket->event->title }}</h2>
                                <span class="bg-green-500/10 text-green-500 text-[10px] px-2 py-1 rounded-full border border-green-500/20 uppercase font-bold">
                                    {{ $ticket->status == 'confirmed' ? 'Onaylandı' : 'Beklemede' }}
                                </span>
                            </div>

                            <div class="space-y-2 text-sm text-gray-400">
                                <p class="flex items-center">
                                    <span class="mr-2">📍</span> {{ $ticket->event->venue->name ?? 'Konum Belirtilmedi' }}
                                </p>
                                <p class="flex items-center">
                                    <span class="mr-2">📅</span> {{ $ticket->event->event_date->format('d.m.Y H:i') }}
                                </p>
                                <p class="text-orange-500 font-bold mt-4 text-lg">
                                    {{ number_format($ticket->price, 2) }} TL
                                </p>
                            </div>
                        </div>

                        <div class="p-6 border-t md:border-t-0 md:border-l border-gray-700 flex items-center justify-center">
                            <a href="{{ route('tickets.success', $ticket->id) }}" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-bold transition">
                                Bileti Görüntüle
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
