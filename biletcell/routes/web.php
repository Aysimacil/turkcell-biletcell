<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrganizerController;



// --- Herkese Açık Rotalar ---
Route::get('/', [EventController::class, 'index'])->name('home');
Route::get('/events', [EventController::class, 'index'])->name('events.index');

// --- Auth (Giriş / Kayıt) Rotaları ---
Route::get('/login', function() { return view('auth.login'); })->name('login');
Route::post('/login', [AuthController::class, 'webLogin'])->name('login.post');
Route::get('/register', function() { return view('auth.register'); })->name('register');
Route::post('/register', [AuthController::class, 'webRegister'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- Sadece Giriş Yapanların (Müşteri/Admin/Organizer) Erişebileceği Rotalar ---
Route::middleware(['auth'])->group(function () {
// Admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    });

    // Organizatör
    Route::middleware('role:organizer,admin')->group(function () {
        Route::get('/organizer/dashboard', [OrganizerController::class, 'index'])->name('organizer.dashboard');
        // ... mevcut events create/store route'ları buraya taşınabilir
    });
    // Ödeme Formu ve İşlemi (Bilet ID bekler)
    Route::get('/payment/{ticket}', [PaymentController::class, 'showForm'])->name('payment.form');
    Route::post('/payment/{ticket}', [PaymentController::class, 'process'])->name('payment.process');

    // Biletleme İşlemleri
    Route::get('/events/{event}/select-seat', [EventController::class, 'selectSeat'])->name('events.selectSeat');
    Route::post('/tickets/book', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/success/{ticket}', [TicketController::class, 'success'])->name('tickets.success');

    // Profil & Biletlerim
    Route::get('/my-tickets', [ProfileController::class, 'index'])->name('profile.tickets');
});

// --- Sadece Organizatör ve Adminlerin Erişebileceği Rotalar ---
Route::middleware(['auth', 'role:organizer,admin'])->group(function () {
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events/store', [EventController::class, 'store'])->name('events.store');
});
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::patch('/admin/users/{user}/role', [AdminController::class, 'changeRole'])->name('admin.changeRole');
    Route::delete('/admin/events/{event}', [AdminController::class, 'deleteEvent'])->name('admin.deleteEvent');
});
Route::middleware(['auth', 'role:organizer,admin'])->group(function () {
    Route::get('/organizer/dashboard', [OrganizerController::class, 'index'])->name('organizer.dashboard');
    Route::delete('/organizer/events/{event}', [OrganizerController::class, 'destroy'])->name('organizer.destroy');
    Route::patch('/organizer/events/{event}/archive', [OrganizerController::class, 'archive'])->name('organizer.archive');
Route::get('/events/{event}/edit',    [EventController::class, 'edit'])   ->name('events.edit');
Route::put('/events/{event}',         [EventController::class, 'update']) ->name('events.update');

});
