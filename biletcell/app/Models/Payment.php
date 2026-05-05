<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    // FIX: Tekrar eden alanlar temizlendi
    protected $fillable = [
        'user_id',
        'event_id',
        'amount',
        'card_number',
        'transaction_id',
        'status',
        'seat_numbers',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
