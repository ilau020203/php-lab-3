<?php

namespace App\Domains\DrivingEntries\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Domains\Drivers\Models\Driver;

class DrivingEntry extends Model
{
    use HasFactory;
    protected $fillable = ['entry_name', 'price', 'status', 'entry_start', 'entry_end', 'student_name', 'driver_id'];
    public function driver(): HasOne
    {
        return $this->HasOne(Driver::class);
    }
}