<?php

namespace App\Domains\DrivingEntries\Actions;

use App\Domains\DrivingEntries\Models\DrivingEntry;

class DeleteDrivingEntryAction
{
    public function execute(int $drivingEntryId)
    {
        $drivingEntry = DrivingEntry::findOrFail($drivingEntryId);
        $drivingEntry->delete();
    }
}