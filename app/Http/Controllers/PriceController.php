<?php

namespace App\Http\Controllers;

use App\Http\Requests\Price\StorePriceRequest;
use App\Http\Requests\Price\UpdatePriceRequest;
use App\Models\Price;

class PriceController extends Controller
{

    public function index()
    {
        $price = Price::all();

        return response()->json($price);
    }


    public function store(StorePriceRequest $request)
    {
        $price = Price::create($request->validated());

        return response()->json($price);
    }


    public function show(Price $price)
    {
        return response()->json($price);
    }


    public function update(UpdatePriceRequest $request, Price $price)
    {
        $price->update($request->validated());

        return response()->json($price);
    }


    public function destroy(Price $price)
    {
        $price->delete();

        return response()->json(null, 204);
    }
}
