<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        // Giriş yapan kullanıcının biletlerini, etkinlik ve mekan bilgileriyle birlikte çekiyoruz
        $tickets = Ticket::with(['event.venue'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('profile.tickets', compact('tickets'));
    }
}
