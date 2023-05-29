<?php

namespace App\Http\Api\v1\DrivingEntries\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DrivingEntryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'entry_name'=>'string|max:45',
            'student_name'=>'string|max:45',
            'price'=> 'integer',
            'status'=> 'integer',
            'entry_start'=>'date_format:Y-m-d\TH:i:s\Z',
            'entry_end'=>'date_format:Y-m-d\TH:i:s\Z',
            'driver_id'=>'integer',
        ];
    }
}