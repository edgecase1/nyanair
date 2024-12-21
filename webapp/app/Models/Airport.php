<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    protected $fillable = [
        'code',
        'icao',
        'name',
        'latitude',
        'longitude',
        'elevation',
        'url',
        'time_zone',
        'city_code',
        'country',
        'city',
        'state',
        'county',
        'type'
        ];

}
