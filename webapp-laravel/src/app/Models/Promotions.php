<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotions extends Model
{
    protected $fillable = [
        'campaign',
        'text',
        'rule',
        'code'
    ];
    
}
