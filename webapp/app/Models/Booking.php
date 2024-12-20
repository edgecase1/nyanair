<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Model\Passenger;

class Booking extends Model
{
    protected $fillable = [
        'booking_code',
        'from' => 'required',
        'to' => 'required',
        'departure' => 'required',
        'name' => 'required',
        'address' => 'required',
        'city' => 'required',
        'country' => 'required',
        // passengers    
    ];

    public function passengers(): HasMany
    {
        return $this->hasMany(Passenger::class);
    }

    public function from(): HasOne
    {
        return $this->hasOne(Airport::class);
    }

    public function to(): HasOne
    {
        return $this->hasOne(Airport::class);
    }
}
