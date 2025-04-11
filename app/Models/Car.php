<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @OA\Schema(
 *     schema="Car",
 *     type="object",
 *     title="Автомобиль",
 *     description="Модель автомобиля",
 *     required={"id", "name"},
 *
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         example=1,
 *         description="ID автомобиля"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         example="Лада Веста",
 *         description="Название модели автомобиля"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         example="2024-04-01T10:00:00Z",
 *         description="Дата создания записи"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         example="2024-04-01T10:00:00Z",
 *         description="Дата обновления записи"
 *     )
 * )
 */


class Car extends Model
{
    protected $fillable = ['name'];

    public function configurations(): HasMany
    {
        return $this->hasMany(Configuration::class);
    }
}
