<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'event_id'     => 'required|exists:events,id',
            'seat_numbers' => 'required|string',
        ]);

        $seats = array_map('trim', explode(',', $request->seat_numbers));
        $seats = array_filter($seats); // Boş elemanları temizle

        if (count($seats) > 4) {
            return back()->with('error', 'Bir seferde en fazla 4 bilet alabilirsiniz.');
        }

        // FIX #1: Fiyatı formdan değil, veritabanından çekiyoruz (manipülasyon önleme)
        $event = Event::findOrFail($request->event_id);
        $totalPrice = $event->price * count($seats);

        try {
            $ticket = DB::transaction(function () use ($request, $seats, $totalPrice, $event) {

                foreach ($seats as $seat) {
                    // FIX #2: lockForUpdate() ile race condition önleniyor
                    $exists = Ticket::where('event_id', $request->event_id)
                                    ->where('seat_number', $seat)
                                    ->whereIn('status', ['confirmed', 'paid', 'pending'])
                                    ->lockForUpdate()
                                    ->exists();

                    if ($exists) {
                        throw new \Exception("Koltuk $seat az önce başkası tarafından alındı!");
                    }
                }

                $newTicket = Ticket::create([
                    'user_id'     => auth()->id(),
                    'event_id'    => $request->event_id,
                    'seat_number' => implode(', ', $seats),
                    'price'       => $totalPrice, // Veritabanından gelen güvenli fiyat
                    'status'      => 'pending',
                ]);

                return $newTicket;
            });

            return redirect()->route('payment.form', ['ticket' => $ticket->id]);

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function success(Ticket $ticket)
    {
        // FIX #3: Sadece bilete sahip olan kullanıcı görebilir
        if ($ticket->user_id !== auth()->id()) {
            abort(403, 'Bu bileti görüntüleme yetkiniz yok.');
        }

        return view('tickets.success', compact('ticket'));
    }
}
