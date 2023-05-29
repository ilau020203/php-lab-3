<?php

namespace App\Domains\Drivers\Actions;

use App\Domains\Drivers\Models\Driver;

class UpdateDriverAction
{
    public function execute(int $driverId, array $fields): Driver
    {
        $driver = Driver::findOrFail($driverId);
        $driver->update($fields);
        return $driver;
    }
}