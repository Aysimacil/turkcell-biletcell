<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category',
        'event_date',
        'status',
        'price',
        'image_path',
        'venue_id',
        'user_id'
    ];
    protected $casts = [
        'event_date' => 'datetime',
    ];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function scopeFilter($query, array $filters)
{
    // Kategoriye göre filtrele
    $query->when($filters['category'] ?? null, function ($query, $category) {
        $query->where('category', $category);
    });

    // Şehre göre filtrele (Venue üzerinden)
    $query->when($filters['city'] ?? null, function ($query, $city) {
        $query->whereHas('venue', function ($q) use ($city) {
            $q->where('city', 'like', '%' . $city . '%');
        });
    });
}
public function tickets()
{
    return $this->hasMany(Ticket::class);
}
}
