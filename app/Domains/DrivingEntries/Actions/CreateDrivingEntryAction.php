<?php

namespace App\Domains\DrivingEntries\Actions;

use App\Domains\DrivingEntries\Models\DrivingEntry;
use Illuminate\Support\Facades\Log;

class CreateDrivingEntryAction
{
    public function execute(array $fields): DrivingEntry
    {

        return DrivingEntry::create($fields);
    }
}