<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function showForm($ticketId)
    {
        $ticket = Ticket::with('event')->findOrFail($ticketId);

        // FIX #1: Sadece biletin sahibi ödeme formunu görebilir
        if ($ticket->user_id !== auth()->id()) {
            abort(403, 'Bu ödeme sayfasına erişim yetkiniz yok.');
        }

        // FIX #2: Zaten ödenmiş bir bilet için forma tekrar erişimi engelle
        if ($ticket->status === 'paid') {
            return redirect()->route('tickets.success', $ticket->id)
                             ->with('info', 'Bu bilet zaten ödenmiş.');
        }

        return view('payments.form', compact('ticket'));
    }

    public function process(Request $request, $ticketId)
    {
        $request->validate([
            'card_number'  => 'required|string',
            'card_expiry'  => 'required|string',
            'cvv'          => 'required|string|min:3|max:4',
        ]);

        $ticket = Ticket::findOrFail($ticketId);

        // FIX #3: Yetkilendirme — başkasının bileti ödenemez
        if ($ticket->user_id !== auth()->id()) {
            abort(403, 'Bu işlem için yetkiniz yok.');
        }

        // FIX #4: Zaten ödenmiş bileti tekrar işleme alma
        if ($ticket->status === 'paid') {
            return redirect()->route('tickets.success', $ticket->id)
                             ->with('info', 'Bu bilet zaten ödenmiş.');
        }

        $cardNumber = str_replace(' ', '', $request->card_number);

        // Paycell Simülasyon Kuralları
        $isSuccess = ($cardNumber === '4242424242424242');

        if (!$isSuccess) {
            return back()->with('error', 'Ödeme reddedildi! Lütfen geçerli bir test kartı kullanın.');
        }

        $txnId = 'TXN-' . strtoupper(Str::random(10));

        // Bilet durumunu güncelle
        $ticket->update([
            'status'         => 'paid',
            'transaction_id' => $txnId,
        ]);

        // Ödeme kaydını oluştur
        Payment::create([
            'user_id'        => auth()->id(),
            'event_id'       => $ticket->event_id,
            'amount'         => $ticket->price,
            'status'         => 'success',
            'transaction_id' => $txnId,
            'card_number'    => substr($cardNumber, -4), // Güvenlik: sadece son 4 hane
            'seat_numbers'   => $ticket->seat_number,
        ]);

        return redirect()->route('tickets.success', $ticket->id)
                         ->with('success', 'Ödeme başarılı! Biletiniz hazır.');
    }
}
