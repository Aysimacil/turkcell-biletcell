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
    $seats = explode(',', $request->seat_numbers);

    if (count($seats) > 4) {
        return back()->with('error', 'Bir seferde en fazla 4 bilet alabilirsiniz.');
    }

    try {
        // Değişkeni döngü dışında tanımlıyoruz ki return kısmında ulaşabilelim
        $lastTicket = null;

        return DB::transaction(function () use ($request, $seats, &$lastTicket) {
            foreach ($seats as $seat) {
                $exists = Ticket::where('event_id', $request->event_id)
                                ->where('seat_number', $seat)
                                ->exists();

                if ($exists) {
                    throw new \Exception("Koltuk $seat az önce başkası tarafından alındı!");
                }

                // Her seferinde $lastTicket değişkenini güncelliyoruz
                $lastTicket = Ticket::create([
                    'user_id' => auth()->id(),
                    'event_id' => $request->event_id,
                    'seat_number' => $seat,
                    'price' => $request->price,
                    'status' => 'confirmed',
                ]);
            }

            // Döngü bitti, elimizde en son oluşturulan biletin ID'si var
            return redirect()->route('tickets.success', $lastTicket->id)
                             ->with('success', count($seats) . ' adet biletiniz başarıyla rezerve edildi!');
        });
    } catch (\Exception $e) {
        return back()->with('error', $e->getMessage());
    }
}
    public function success(Ticket $ticket)
    {
        // Bilet detaylarını ve QR kodun görüneceği sayfa
        return view('tickets.success', compact('ticket'));
    }
}
