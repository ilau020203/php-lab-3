<?php

namespace App\Http\Api\v1\Drivers\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DriverResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'car_name' => $this->car_name,
            'car_type' => $this->car_type,
        ];
    }
}