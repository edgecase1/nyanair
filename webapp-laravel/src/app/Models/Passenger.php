<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Booking;

class Passenger extends Model
{
    protected $fillable = [
        'name',
        'passport',
        'birthday'
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'foreign_key');
    }
}
