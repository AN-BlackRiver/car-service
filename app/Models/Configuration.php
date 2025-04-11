<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @OA\Schema(
 *     schema="Configuration",
 *     type="object",
 *     title="Конфигурация",
 *     required={"car_id", "name"},
 *     @OA\Property(property="id", type="integer", example=1, description="ID конфигурации"),
 *     @OA\Property(property="car_id", type="integer", example=1, description="ID автомобиля"),
 *     @OA\Property(property="name", type="string", example="Лада Веста", description="Название конфигурации"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-04-01T10:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-04-01T10:00:00Z")
 * )
 */

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
