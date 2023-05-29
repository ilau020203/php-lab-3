<?php

namespace App\Domains\Drivers\Actions;

use App\Domains\Drivers\Models\Driver;

class CreateDriverAction
{
    public function execute(array $fields): Driver
    {
        return Driver::create($fields);
    }
}