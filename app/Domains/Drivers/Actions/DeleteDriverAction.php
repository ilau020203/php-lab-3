<?php

namespace App\Domains\Drivers\Actions;

use App\Domains\Drivers\Models\Driver;

class DeleteDriverAction
{
    public function execute(int $driverId)
    {
        $driver = Driver::findOrFail($driverId);
        $driver->delete();
    }
}