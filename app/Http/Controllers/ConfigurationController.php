<?php

namespace App\Http\Controllers;

use App\Http\Requests\Configuration\StoreConfigurationRequest;
use App\Http\Requests\Configuration\UpdateConfigurationRequest;
use App\Models\Configuration;

class ConfigurationController extends Controller
{

    public function index()
    {
        return Configuration::all();
    }

    public function store(StoreConfigurationRequest $request)
    {
        $configuration = Configuration::create($request->validated());

        return response()->json($configuration, 201);
    }


    public function show(Configuration $configuration)
    {
        return response()->json($configuration);
    }


    public function update(UpdateConfigurationRequest $request, Configuration $configuration)
    {
        $configuration->update($request->validated());

        return response()->json($configuration);
    }


    public function destroy(Configuration $configuration)
    {
        $configuration->delete();

        return response()->json(null, 204);
    }
}
