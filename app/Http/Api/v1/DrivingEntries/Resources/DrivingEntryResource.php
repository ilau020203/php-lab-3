<?php

namespace App\Http\Api\v1\DrivingEntries\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DrivingEntryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'entry_name' => $this->entry_name,
            'status' => $this->status,
            'price' => $this->price,
            'entry_start' => $this->entry_start,
            'entry_end' => $this->entry_end,
            'student_name' => $this->student_name,
            'driver_id' => $this->driver_id,
        ];
    }
}