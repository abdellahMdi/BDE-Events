<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'place',
        'date',
        'houre',
        'price',
        'places_limite',
        'description',
        'created_by',
    ];

    protected $casts = [
        'date' => 'date',
        'price' => 'decimal:2',
        'places_limite' => 'integer',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}