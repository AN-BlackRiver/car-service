<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
