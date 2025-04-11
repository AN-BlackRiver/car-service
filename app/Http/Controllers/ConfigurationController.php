<?php

namespace App\Http\Controllers;

use App\Http\Requests\Configuration\StoreConfigurationRequest;
use App\Http\Requests\Configuration\UpdateConfigurationRequest;
use App\Models\Configuration;

/**
 * @OA\Tag(
 *     name="Конфигурации",
 *     description="Управление конфигурациями автомобилей"
 * )
 */
class ConfigurationController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/configurations",
     *     summary="Получить список всех конфигураций",
     *     tags={"Конфигурации"},
     *     @OA\Response(
     *         response=200,
     *         description="Список конфигураций",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Configuration"))
     *     )
     * )
     */
    public function index()
    {
        return response()->json(Configuration::all());
    }

    /**
     * @OA\Post(
     *     path="/api/configurations",
     *     summary="Создать новую конфигурацию",
     *     tags={"Конфигурации"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"car_id", "name"},
     *             @OA\Property(property="car_id", type="integer", example=1, description="ID автомобиля"),
     *             @OA\Property(property="name", type="string", example="Comfort", description="Название конфигурации")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Конфигурация успешно создана",
     *         @OA\JsonContent(ref="#/components/schemas/Configuration")
     *     ),
     *     @OA\Response(response=400, description="Некорректные данные")
     * )
     */
    public function store(StoreConfigurationRequest $request)
    {
        $configuration = Configuration::create($request->validated());

        return response()->json($configuration, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/configurations/{id}",
     *     summary="Получить одну конфигурацию по ID",
     *     tags={"Конфигурации"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID конфигурации",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Конфигурация найдена",
     *         @OA\JsonContent(ref="#/components/schemas/Configuration")
     *     ),
     *     @OA\Response(response=404, description="Конфигурация не найдена")
     * )
     */
    public function show(Configuration $configuration)
    {
        return response()->json($configuration);
    }

    /**
     * @OA\Patch(
     *     path="/api/configurations/{id}",
     *     summary="Обновить конфигурацию",
     *     tags={"Конфигурации"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID конфигурации",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="car_id", type="integer", example=2, description="ID автомобиля"),
     *             @OA\Property(property="name", type="string", example="Premium", description="Название конфигурации")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Конфигурация обновлена",
     *         @OA\JsonContent(ref="#/components/schemas/Configuration")
     *     ),
     *     @OA\Response(response=404, description="Конфигурация не найдена")
     * )
     */
    public function update(UpdateConfigurationRequest $request, Configuration $configuration)
    {
        $configuration->update($request->validated());

        return response()->json($configuration);
    }

    /**
     * @OA\Delete(
     *     path="/api/configurations/{id}",
     *     summary="Удалить конфигурацию",
     *     tags={"Конфигурации"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID конфигурации",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(response=204, description="Конфигурация удалена"),
     *     @OA\Response(response=404, description="Конфигурация не найдена")
     * )
     */
    public function destroy(Configuration $configuration)
    {
        $configuration->delete();

        return response()->json(null, 204);
    }
}
