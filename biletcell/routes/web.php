<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/events', [EventController::class, 'index'])->name('events.index');
// Formu görüntülemek için
Route::get('/events/create', [EventController::class, 'create'])->name('events.create');

// Formdan gelen verileri kaydetmek için
Route::post('/events', [EventController::class, 'store'])->name('events.store');
// {event} burada bir ID'yi temsil eder (Örn: /events/5)
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
