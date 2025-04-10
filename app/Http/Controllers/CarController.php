<?php

namespace App\Http\Controllers;

use App\Http\Requests\Car\StoreCarRequest;
use App\Http\Requests\Car\UpdateCarRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Services\CarService;
use Illuminate\Support\Facades\Cache;


class CarController extends Controller
{
    public function __construct(protected CarService $carService)
    {
    }


    public function index()
    {
        return response()->json(Car::all());
    }
    
    public function store(StoreCarRequest $request)
    {
        $car = Car::create($request->validated());

        return response()->json($car, 201);
    }


    public function show(Car $car)
    {
        return $car;
    }


    public function update(UpdateCarRequest $request, Car $car)
    {
        $car->update($request->validated());

        return response()->json($car);
    }


    public function destroy(Car $car)
    {
        $car->delete();

        return response()->json(null, 204);
    }


    public function available()
    {
        $cars = Cache::remember('cars_available', 600, function () {
            return $this->carService->getAvailableCars();
        });

        return CarResource::collection($cars)->resolve();
    }
}
