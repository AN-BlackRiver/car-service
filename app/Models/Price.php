<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = [
        'configuration_id',
        'price',
        'start_date',
        'end_date',
    ];
}
