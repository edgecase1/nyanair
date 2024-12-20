<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Model\Booking;

class Payment extends Model
{
    protected $fillable = [
        'name',
        'address',
        'city',
        'country'
    ]; 

    public function to(): HasOne
    {
        return $this->hasOne(Booking::class);
    }
}
