<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Option",
 *     type="object",
 *     title="Опция",
 *     description="Опция, для конфигурации автомобиля",
 *     required={"id", "name"},
 *
 *     @OA\Property(property="id",type="integer",example=1,description="Уникальный идентификатор опции" ),
 *     @OA\Property(property="name",type="string",example="Климат-контроль",description="Название опции"),
 *     @OA\Property(property="created_at", type="string",format="date-time",example="2024-04-01T12:00:00Z",description="Дата создания"),
 *     @OA\Property( property="updated_at",type="string",format="date-time",example="2024-04-01T12:30:00Z",description="Дата последнего обновления"
 *     )
 * )
 */


class Option extends Model
{
    protected $fillable = ['name'];
}
