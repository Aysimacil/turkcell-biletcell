<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use   HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'gsm',
        'role',
        'is_turkcell',
        'api_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_turkcell' => 'boolean',
        ];
    }
     public function events()
    {
        return $this->hasMany(Event::class);
    }
    public function tickets()
{
    return $this->hasMany(Ticket::class);
}
public function isAdmin()
{
    return $this->role === 'admin';
}

public function isOrganizer()
{
    return $this->role === 'organizer';
}

public function isCustomer()
{
    return $this->role === 'customer';
}
}
