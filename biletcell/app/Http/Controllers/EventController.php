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
        $venues = Venue::all();
        return view('events.create', compact('venues'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|max:255',
            'description' => 'required',
            'category'    => 'required',
            'event_date'  => 'required|date',
            'price'       => 'required|numeric',
            'venue_id'    => 'required|exists:venues,id',
            'image'       => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

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
        $event->load(['venue', 'user']);
        return view('events.show', compact('event'));
    }

    // ─── YENİ: Edit ───────────────────────────────────────────────────────────
    public function edit(Event $event)
    {
        // Sadece etkinliğin sahibi düzenleyebilir
        if ($event->user_id !== auth()->id()) {
            abort(403);
        }

        $venues = Venue::all();
        return view('events.edit', compact('event', 'venues'));
    }

    // ─── YENİ: Update ─────────────────────────────────────────────────────────
    public function update(Request $request, Event $event)
    {
        if ($event->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title'       => 'required|max:255',
            'description' => 'required',
            'category'    => 'required',
            'event_date'  => 'required|date',
            'price'       => 'required|numeric',
            'venue_id'    => 'required|exists:venues,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // nullable — mevcut görsel kalabilir
        ]);

        // Yeni görsel yüklendiyse eskisini sil, yenisini kaydet
        if ($request->hasFile('image')) {
            if ($event->image_path) {
                Storage::disk('public')->delete($event->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('event-images', 'public');
        }

        $event->update($validated);

        return redirect()->route('organizer.dashboard')
                         ->with('success', "'{$event->title}' etkinliği güncellendi.");
    }
    // ──────────────────────────────────────────────────────────────────────────

    public function selectSeat(Event $event)
    {
        $occupiedSeats = $event->tickets()->pluck('seat_number')->toArray();
        return view('events.seats', compact('event', 'occupiedSeats'));
    }
}
