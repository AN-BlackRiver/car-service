<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Configuration extends Model
{
    protected $fillable = ['car_id', 'name'];

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function options(): BelongsToMany
    {
        return $this->belongsToMany(Option::class, 'configuration_options');
    }

    public function prices(): HasMany
    {
        return $this->hasMany(Price::class);
    }

    public function currentPrice()
    {
        return $this->hasOne(Price::class)
            ->where('start_date', '<=', now())
            ->where(function ($q) {
                $q->whereNull('end_date')->orWhere('end_date', '>=', now());
            });
    }
}
