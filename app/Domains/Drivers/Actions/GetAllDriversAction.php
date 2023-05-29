<?php

namespace App\Domains\Drivers\Actions;

use App\Domains\Drivers\Models\Driver;

class GetAllDriversAction
{
    public function execute(): array
    {
        return Driver::all()->toArray();
    }
}