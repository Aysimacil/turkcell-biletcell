@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 py-12 flex items-center justify-center">
    <div class="max-w-md w-full bg-white rounded-3xl overflow-hidden shadow-2xl transform transition-all hover:scale-[1.02]">

        <div class="bg-orange-500 p-8 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full mb-4 shadow-lg">
                <svg class="w-10 h-10 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-white uppercase tracking-wider">Biletiniz Hazır!</h2>
        </div>

        <div class="p-8 bg-white relative">
            <div class="absolute -left-4 top-1/2 -translate-y-1/2 w-8 h-8 bg-gray-900 rounded-full"></div>
            <div class="absolute -right-4 top-1/2 -translate-y-1/2 w-8 h-8 bg-gray-900 rounded-full"></div>

            <div class="border-b-2 border-dashed border-gray-200 pb-6 mb-6">
                <h3 class="text-xl font-extrabold text-gray-800 mb-1">{{ $ticket->event->title }}</h3>
                <p class="text-sm text-gray-500 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    {{ $ticket->event->venue->name }}
                </p>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-8">
                <div>
                    <p class="text-xs text-gray-400 uppercase font-bold">Koltuk</p>
                    <p class="text-lg font-bold text-orange-600">#{{ $ticket->seat_number }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 uppercase font-bold">Tarih</p>
                    <p class="text-sm font-bold text-gray-800">{{ $ticket->event->event_date }}</p>
                </div>
            </div>

            <div class="flex flex-col items-center justify-center p-4 bg-gray-50 rounded-2xl border-2 border-gray-100">
                <div class="w-32 h-32 bg-white flex items-center justify-center border border-gray-200 rounded-lg shadow-inner">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $ticket->id }}" alt="QR Code">
                </div>
                <p class="mt-2 text-[10px] text-gray-400 uppercase tracking-tighter">Bilet ID: {{ $ticket->id }}</p>
            </div>
        </div>

        <div class="p-6 bg-gray-50 border-t border-gray-100 flex gap-2">
            <a href="{{ route('events.index') }}" class="flex-1 text-center py-3 px-4 bg-gray-200 text-gray-700 rounded-xl font-bold hover:bg-gray-300 transition">Ana Sayfa</a>
            <button onclick="window.print()" class="flex-1 py-3 px-4 bg-orange-500 text-white rounded-xl font-bold hover:bg-orange-600 shadow-lg shadow-orange-200 transition">Yazdır / PDF</button>
        </div>
    </div>
</div>
@endsection
