<?php

namespace App\Http\Controllers;

use App\Http\Requests\Option\StoreOptionRequest;
use App\Http\Requests\Option\UpdateOptionRequest;
use App\Models\Option;

/**
 * @OA\Tag(
 *     name="Опции",
 *     description="Управление опциями для конфигураций"
 * )
 */
class OptionController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/options",
     *     tags={"Опции"},
     *     summary="Получить все доступные опции",
     *     @OA\Response(
     *         response=200,
     *         description="Список всех опций",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Option")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return  response()->json(Option::all());
    }

    /**
     * @OA\Post(
     *     path="/api/options",
     *     tags={"Опции"},
     *     summary="Создать новую опцию",
     *     @OA\RequestBody(
     *         required=true,
     *        @OA\JsonContent(
     *                required={"name"},
     *                @OA\Property(property="name",type="string",example="Климат-контроль",description="Название опции"),
     *            )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Опция успешно создана",
     *         @OA\JsonContent(ref="#/components/schemas/Option")
     *     )
     * )
     */
    public function store(StoreOptionRequest $request)
    {
        $option = Option::create($request->validated());

        return response()->json($option, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/options/{id}",
     *     tags={"Опции"},
     *     summary="Получить информацию об опции по ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Информация об опции",
     *         @OA\JsonContent(ref="#/components/schemas/Option")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Опция не найдена"
     *     )
     * )
     */
    public function show(Option $option)
    {
        return response()->json($option);
    }

    /**
     * @OA\Patch(
     *     path="/api/options/{id}",
     *     tags={"Опции"},
     *     summary="Обновить информацию об опции",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *                 required={"name"},
     *                 @OA\Property(property="name",type="string",example="Климат-контроль",description="Название опции"),
     *             )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Опция успешно обновлена",
     *         @OA\JsonContent(ref="#/components/schemas/Option")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Опция не найдена"
     *     )
     * )
     */
    public function update(UpdateOptionRequest $request, Option $option)
    {
        $option->update($request->validated());

        return response()->json($option);
    }

    /**
     * @OA\Delete(
     *     path="/api/options/{id}",
     *     tags={"Опции"},
     *     summary="Удалить опцию",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Опция успешно удалена"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Опция не найдена"
     *     )
     * )
     */
    public function destroy(Option $option)
    {
        $option->delete();

        return response()->json(null, 204);
    }
}
