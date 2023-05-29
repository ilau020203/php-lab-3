<?php

namespace App\Domains\DrivingEntries\Actions;

use App\Domains\DrivingEntries\Models\DrivingEntry;

class GetAllDrivingEntriesAction
{
    public function execute(): array
    {
        return DrivingEntry::all()->toArray();
    }
}