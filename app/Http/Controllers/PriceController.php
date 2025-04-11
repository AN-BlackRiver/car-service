<?php

namespace App\Http\Controllers;

use App\Http\Requests\Price\StorePriceRequest;
use App\Http\Requests\Price\UpdatePriceRequest;
use App\Models\Price;

/**
 * @OA\Tag(
 *     name="Цены",
 *     description="Управление ценами для комплектаций"
 * )
 */
class PriceController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/prices",
     *     tags={"Цены"},
     *     summary="Получить список всех цен",
     *     @OA\Response(
     *         response=200,
     *         description="Список всех цен",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Price"))
     *     )
     * )
     */
    public function index()
    {
        return response()->json(Price::all());
    }


    /**
     * @OA\Post(
     *     path="/api/prices",
     *     tags={"Цены"},
     *     summary="Создать новую цену",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              required={"configuration_id", "price", "start_date"},
     *              @OA\Property(property="id", type="integer", example=1, description="ID цены"),
     *              @OA\Property(property="configuration_id", type="integer", example="2", description="ID конфигурации"),
     *              @OA\Property(property="price", type="float", example="135000.50", description="цена"),
     *              @OA\Property(property="start_date", type="string", example="2024-04-01T10:00:00Z", description="Дата начала лействия цены"),
     *              @OA\Property(property="end_date", type="string", example="2024-04-25T10:00:00Z", description="Дата окончания действия цены (Если установлена)"),
     *          )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Созданная цена",
     *         @OA\JsonContent(ref="#/components/schemas/Price")
     *     )
     * )
     */
    public function store(StorePriceRequest $request)
    {
        $price = Price::create($request->validated());

        return response()->json($price);
    }

    /**
     * @OA\Get(
     *     path="/api/prices/{id}",
     *     tags={"Цены"},
     *     summary="Получить информацию о конкретной цене по ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID цены",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Информация о цене",
     *         @OA\JsonContent(ref="#/components/schemas/Price")
     *     ),
     *     @OA\Response(response=404, description="Цена не найдена")
     * )
     */
    public function show(Price $price)
    {
        return response()->json($price);
    }

    /**
     * @OA\Patch(
     *     path="/api/prices/{id}",
     *     tags={"Цены"},
     *     summary="Обновить цену",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID цены",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *               required={"configuration_id", "price", "start_date"},
     *               @OA\Property(property="id", type="integer", example=1, description="ID цены"),
     *               @OA\Property(property="configuration_id", type="integer", example="2", description="ID конфигурации"),
     *               @OA\Property(property="price", type="float", example="135000.50", description="цена"),
     *               @OA\Property(property="start_date", type="string", example="2024-04-01T10:00:00Z", description="Дата начала лействия цены"),
     *               @OA\Property(property="end_date", type="string", example="2024-04-25T10:00:00Z", description="Дата окончания действия цены (Если установлена)"),
     *           )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Обновлённая цена",
     *         @OA\JsonContent(ref="#/components/schemas/Price")
     *     )
     * )
     */
    public function update(UpdatePriceRequest $request, Price $price)
    {
        $price->update($request->validated());

        return response()->json($price);
    }

    /**
     * @OA\Delete(
     *     path="/api/prices/{id}",
     *     tags={"Цены"},
     *     summary="Удалить цену",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID цены",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=204, description="Цена удалена")
     * )
     */
    public function destroy(Price $price)
    {
        $price->delete();

        return response()->json(null, 204);
    }
}
