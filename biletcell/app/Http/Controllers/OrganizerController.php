<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\Payment;
use Illuminate\Http\Request;

class OrganizerController extends Controller
{
    public function index()
    {
        $events = Event::where('user_id', auth()->id())->latest()->get();

        // Organizatörün etkinliklerine ait satılan biletler
        $eventIds = $events->pluck('id');

        $totalTickets = Ticket::whereIn('event_id', $eventIds)
                              ->where('status', 'paid')
                              ->count();

        $totalRevenue = Payment::whereIn('event_id', $eventIds)
                               ->where('status', 'success')
                               ->sum('amount');

        $totalEvents  = $events->count();
        $activeEvents = $events->where('status', 'active')->count();

        // Her etkinliğe ait satılan bilet sayısını hazırla
        $ticketCounts = Ticket::whereIn('event_id', $eventIds)
                              ->where('status', 'paid')
                              ->selectRaw('event_id, count(*) as total')
                              ->groupBy('event_id')
                              ->pluck('total', 'event_id');

        return view('organizer.dashboard', compact(
            'events', 'totalTickets', 'totalRevenue', 'totalEvents', 'activeEvents', 'ticketCounts'
        ));
    }

    public function destroy(Event $event)
    {
        // Sadece kendi etkinliğini silebilir
        if ($event->user_id !== auth()->id()) {
            abort(403);
        }

        $event->delete();
        return back()->with('success', "'{$event->title}' etkinliği silindi.");
    }

    public function archive(Request $request, Event $event)
    {
        if ($event->user_id !== auth()->id()) {
            abort(403);
        }

        $event->update(['status' => $request->status]); // 'cancelled' veya 'done'
        return back()->with('success', "Etkinlik durumu güncellendi.");
    }
}
