<?php

namespace App\Services;

use App\Models\Car;

class CarService
{
    public function getAvailableCars()
    {
        return Car::with([
            'configurations' => function ($q) {
                $q->whereHas('currentPrice')->with(['options', 'currentPrice']);
            }
        ])->get()->filter(fn($car) => $car->configurations->isNotEmpty());
    }
}
