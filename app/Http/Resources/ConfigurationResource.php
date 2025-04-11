<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="ConfigurationResource",
 *     type="object",
 *     title="Конфигурация автомобиля c актуальными ценами",
 *     description="Конфигурация с опциями и текущей ценой",
 *     required={"id", "name", "options", "current_price"},
 *
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         example=10,
 *         description="ID конфигурации"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         example="Комфорт",
 *         description="Название конфигурации"
 *     ),
 *     @OA\Property(
 *         property="options",
 *         type="array",
 *         description="Список названий опций",
 *         @OA\Items(type="string", example="Климат контроль")
 *     ),
 *     @OA\Property(
 *         property="current_price",
 *         type="number",
 *         format="float",
 *         example=135000,
 *         description="Актуальная цена конфигурации"
 *     )
 * )
 */


class ConfigurationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'options' => $this->options->pluck('name'),
            'current_price' => $this->currentPrice->price,
        ];
    }
}
