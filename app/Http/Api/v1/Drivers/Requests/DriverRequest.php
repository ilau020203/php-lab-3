<?php

namespace App\Http\Api\v1\Drivers\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriverRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'full_name'=>'required|string|max:45',
            'car_name'=>'required|string|max:45',
            'car_type'=> 'required|integer|max:255',
        ];
    }
}