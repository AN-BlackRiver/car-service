<?php

namespace App\Http\Controllers;

use App\Http\Requests\Option\StoreOptionRequest;
use App\Http\Requests\Option\UpdateOptionRequest;
use App\Models\Option;

class OptionController extends Controller
{
    public function index()
    {
        return Option::all();
    }

    public function store(StoreOptionRequest $request)
    {
        $option = Option::create($request->validated());

        return response()->json($option, 201);
    }

    public function show(Option $option)
    {
        return response()->json($option);
    }

    public function update(UpdateOptionRequest $request, Option $option)
    {
        $option->update($request->validated());

        return response()->json($option);
    }

    public function destroy(Option $option)
    {
        $option->delete();

        return response()->json(null, 204);
    }
}
