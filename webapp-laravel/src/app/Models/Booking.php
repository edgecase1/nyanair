<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

use App\Models\Passenger;
use App\Models\Airport;

class Booking extends Model
{
    protected $fillable = [
        'booking_code' => 'required',
        'from' => 'required',
        'to' => 'required',
        'departure' => 'required',
        'name' => 'required',
        'address' => 'required',
        'city' => 'required',
        'country' => 'required',
        'amount' => 'required'
        // passengers    
    ];

    public function passengers(): HasMany
    {
        return $this->hasMany(Passenger::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payments::class);
    }

    public function from(): HasOne
    {
        return $this->hasOne(Airport::class, 'id', 'from');
    }

    public function to(): HasOne
    {
        return $this->hasOne(Airport::class, 'id', 'to');
    }
}
