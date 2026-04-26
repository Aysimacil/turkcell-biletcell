<?php

namespace App\Http\Controllers;
use App\Models\Venue;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{

 public function index(Request $request)
{
    $events = \App\Models\Event::with('venue')
                ->filter($request->only(['category', 'city']))
                ->get();

    return view('events.index', compact('events'));
}
public function create()
{
    $venues = Venue::all(); // Mekanları seçebilmek için formun içine göndereceğiz
    return view('events.create', compact('venues'));
}
public function store(Request $request)
{
    
    // 1. Verileri doğrula
    $validated = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'category' => 'required',
        'event_date' => 'required|date',
        'price' => 'required|numeric',
        'venue_id' => 'required|exists:venues,id',
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // 2. Dosyayı yükle
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('event-images', 'public');
        $validated['image_path'] = $path;
    }


    $validated['user_id'] = auth()->id() ?? 1;

    Event::create($validated);

    return redirect()->route('events.index')->with('success', 'Etkinlik başarıyla oluşturuldu!');
}
public function show(\App\Models\Event $event)
{
    // Eager loading ile mekanı ve organizatörü de yüklüyoruz
    $event->load(['venue', 'user']);

    return view('events.show', compact('event'));
}
public function selectSeat(Event $event)
{
    // Bu etkinliğe ait satılmış biletlerin koltuk numaralarını çekiyoruz
    $occupiedSeats = $event->tickets()->pluck('seat_number')->toArray();

    return view('events.seats', compact('event', 'occupiedSeats'));
}
}
