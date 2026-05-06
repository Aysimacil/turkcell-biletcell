<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\Payment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers   = User::count();
        $totalRevenue = Payment::where('status', 'success')->sum('amount');
        $totalEvents  = Event::count();
        $totalTickets = Ticket::where('status', 'paid')->count();

        $users  = User::latest()->get();
        $events = Event::with('user')->latest()->get();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalRevenue', 'totalEvents', 'totalTickets',
            'users', 'events'
        ));
    }

    // Rol değiştir
    public function changeRole(Request $request, User $user)
    {
        // Admin kendini değiştiremesin
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Kendi rolünüzü değiştiremezsiniz.');
        }

        $newRole = $user->role === 'customer' ? 'organizer' : 'customer';
        $user->update(['role' => $newRole]);

        return back()->with('success', "{$user->name} kullanıcısının rolü '{$newRole}' yapıldı.");
    }

    // Etkinlik sil
    public function deleteEvent(Event $event)
    {
        $event->delete();
        return back()->with('success', "'{$event->title}' etkinliği silindi.");
    }
}
