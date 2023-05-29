<?php

namespace App\Http\Api\v1\Drivers\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDriverRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'full_name'=>'string|max:45',
            'car_name'=>'string|max:45',
            'car_type'=> 'integer|max:255',
        ];
    }
}