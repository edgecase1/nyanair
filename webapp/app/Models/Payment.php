<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Model\Booking;

class Payment extends Model
{
    protected $fillable = [
        'card_holder_name',
        'expiry_date',
        'pan',
        'service_code',
        'amount'
    ]; 

    public function booking(): HasOne
    {
        return $this->hasOne(Booking::class);
    }
}
