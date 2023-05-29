<?php

namespace App\Domains\Drivers\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Domains\DrivingEntries\Models\DrivingEntry;

class Driver extends Model
{
    use HasFactory;
    protected $fillable = ['full_name', 'car_name', 'car_type'];
    protected $guarded = ['id'];

    /**
     * Get the user's largest order.
     */
    public function drivingEntries(): HasOne
    {
        return $this->HasOne(DrivingEntry::class);
    }
}