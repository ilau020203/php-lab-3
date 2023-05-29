<?php

namespace App\Domains\Drivers\Actions;

use App\Domains\Drivers\Models\Driver;

class GetDriverAction
{
    public function execute(int $driverId): Driver
    {
        return Driver::findOrFail($driverId);
    }
}