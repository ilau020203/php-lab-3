<?php

namespace App\Domains\DrivingEntries\Actions;

use App\Domains\DrivingEntries\Models\DrivingEntry;

class UpdateDrivingEntryAction
{
    public function execute(int $drivingEntryId, array $fields): DrivingEntry
    {
        $drivingEntry = DrivingEntry::findOrFail($drivingEntryId);
        $drivingEntry->update($fields);
        return $drivingEntry;
    }
}