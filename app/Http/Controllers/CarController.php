<?php

namespace App\Http\Controllers;

use App\Http\Requests\Car\StoreCarRequest;
use App\Http\Requests\Car\UpdateCarRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Services\CarService;
use Illuminate\Support\Facades\Cache;

/**
 * @OA\Info(
 *     title="Car API",
 *     version="1.0.0",
 *     description="API для управления автомобилями"
 * )
 *
 * @OA\Tag(
 *     name="Автомобили",
 *     description="Управление автомобилями"
 * )
 */
class CarController extends Controller
{
    public function __construct(protected CarService $carService)
    {
    }

    /**
     * @OA\Get(
     *     path="/api/cars",
     *     tags={"Автомобили"},
     *     summary="Получить список всех автомобилей",
     *     @OA\Response(
     *         response=200,
     *         description="Список автомобилей",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Car"))
     *     )
     * )
     */
    public function index()
    {
        return response()->json(Car::all());
    }

    /**
     * @OA\Post(
     *     path="/api/cars",
     *     summary="Создать новый автомобиль",
     *     tags={"Автомобили"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Toyota Camry", description="Название автомобиля")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Автомобиль успешно создан",
     *         @OA\JsonContent(ref="#/components/schemas/Car")
     *     ),
     *     @OA\Response(response=400, description="Некорректные данные")
     * )
     */
    public function store(StoreCarRequest $request)
    {
        $car = Car::create($request->validated());

        return response()->json($car, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/cars/{id}",
     *     tags={"Автомобили"},
     *     summary="Получить информацию об автомобиле по ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Информация об автомобиле",
     *         @OA\JsonContent(ref="#/components/schemas/Car")
     *     )
     * )
     */
    public function show(Car $car)
    {
        return $car;
    }

    /**
     * @OA\Patch(
     *     path="/api/cars/{id}",
     *     tags={"Автомобили"},
     *     summary="Обновить информацию об автомобиле",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              required={"name"},
     *              @OA\Property(property="name", type="string", example="Toyota Camry", description="Название автомобиля")
     *          )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Автомобиль обновлен",
     *         @OA\JsonContent(ref="#/components/schemas/Car")
     *     )
     * )
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        $car->update($request->validated());

        return response()->json($car);
    }

    /**
     * @OA\Delete(
     *     path="/api/cars/{id}",
     *     tags={"Автомобили"},
     *     summary="Удалить автомобиль",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Автомобиль удален"
     *     )
     * )
     */
    public function destroy(Car $car)
    {
        $car->delete();

        return response()->json(null, 204);
    }

    /**
     * @OA\Get(
     *     path="/api/cars/available",
     *     tags={"Автомобили"},
     *     summary="Получить список автомобилей с актуальными ценами",
     *     @OA\Response(
     *         response=200,
     *         description="Список автомобилей с актуальными ценами",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/CarResource"))
     *     )
     * )
     */
    public function available()
    {
        $cars = Cache::remember('cars_available', 600, function () {
            return $this->carService->getAvailableCars();
        });

        return CarResource::collection($cars)->resolve();
    }
}
