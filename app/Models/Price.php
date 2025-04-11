<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Price",
 *     type="object",
 *     title="Цена",
 *     description="Цена для комплектации автомобиля",
 *     required={"configuration_id", "price", "start_date"},
 *
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         example=1,
 *         description="Уникальный идентификатор цены"
 *     ),
 *     @OA\Property(
 *         property="configuration_id",
 *         type="integer",
 *         example=1,
 *         description="ID комплектации, к которой относится цена"
 *     ),
 *     @OA\Property(
 *         property="price",
 *         type="number",
 *         format="float",
 *         example=35000.50,
 *         description="Цена комплектации"
 *     ),
 *     @OA\Property(
 *         property="start_date",
 *         type="string",
 *         format="date-time",
 *         example="2024-04-01T10:00:00Z",
 *         description="Дата начала действия цены"
 *     ),
 *     @OA\Property(
 *         property="end_date",
 *         type="string",
 *         format="date-time",
 *         example="2024-06-01T10:00:00Z",
 *         description="Дата окончания действия цены (Если установлена)"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         example="2024-04-01T10:00:00Z",
 *         description="Дата создания"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         example="2024-04-01T10:30:00Z",
 *         description="Дата последнего обновления"
 *     )
 * )
 */


class Price extends Model
{
    protected $fillable = [
        'configuration_id',
        'price',
        'start_date',
        'end_date',
    ];
}
