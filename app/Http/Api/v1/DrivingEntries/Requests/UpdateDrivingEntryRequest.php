<?php

namespace App\Http\Api\v1\DrivingEntries\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDrivingEntryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule','array','string>
     */
    public function rules(): array
    {
        return [
            'entry_name'=>['sometimes','required','string','max:45'],
            'student_name'=>['sometimes','required','string','max:45'],
            'price'=> ['sometimes','required','integer'],
            'status'=> ['sometimes','required','integer'],
            'entry_start'=>['sometimes','required','date_format:Y-m-d\TH:i:s\Z'],
            'entry_end'=>['sometimes','required','date_format:Y-m-d\TH:i:s\Z'],
            'driver_id'=>['sometimes','required','integer'],
        ];
    }
}