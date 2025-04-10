<?php

namespace App\Http\Requests\Configuration;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConfigurationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'car_id' => 'required|exists:cars,id',
            'name' => 'required|string|max:255',
        ];
    }
}
