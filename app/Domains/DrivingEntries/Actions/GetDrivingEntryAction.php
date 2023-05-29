<?php

namespace App\Domains\DrivingEntries\Actions;

use App\Domains\DrivingEntries\Models\DrivingEntry;

class GetDrivingEntryAction
{
    public function execute(int $drivingEntryId): DrivingEntry
    {
        return DrivingEntry::findOrFail($drivingEntryId);
    }
}