<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
   public function index()
{
    // Tüm etkinlikleri mekan bilgisiyle beraber çekiyoruz
    $events = \App\Models\Event::with('venue')->get();

    return view('events.index', compact('events'));
}
}
