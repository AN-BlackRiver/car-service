<?php

namespace App\Http\Requests\Option;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOptionRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }
}
