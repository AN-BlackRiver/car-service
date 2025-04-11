<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


/**
 * @OA\Schema(
 *     schema="CarResource",
 *     type="object",
 *     title="Автомобиль c актуальными ценами и конфигурациями",
 *     description="Автомобиль с конфигурациями, опциями и актуальной ценой",
 *     required={"id", "name", "configurations"},
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
 *         property="configurations",
 *         type="array",
 *         description="Актуальные комплектации автомобиля",
 *         @OA\Items(ref="#/components/schemas/ConfigurationResource")
 *     )
 * )
 */


class CarResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'configurations' => ConfigurationResource::collection($this->configurations),
        ];
    }
}
