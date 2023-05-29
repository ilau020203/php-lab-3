<?php

namespace App\Http\Api\v1\DrivingEntries\Controllers;

use App\Domains\DrivingEntries\Actions\CreateDrivingEntryAction;
use App\Domains\DrivingEntries\Actions\DeleteDrivingEntryAction;
use App\Domains\DrivingEntries\Actions\GetAllDrivingEntriesAction;
use App\Domains\DrivingEntries\Actions\GetDrivingEntryAction;
use App\Domains\DrivingEntries\Actions\UpdateDrivingEntryAction;
use App\Http\Api\v1\DrivingEntries\Requests\DrivingEntryRequest;
use App\Http\Api\v1\DrivingEntries\Resources\DrivingEntryResource;
use App\Http\Api\v1\Helpers\Resources\EmptyResource;
use Illuminate\Routing\Controller;

class DrivingEntryController extends Controller
{
    public function getList(GetAllDrivingEntriesAction $action)
    {
        $DrivingEntries = $action->execute();
        return response()->json(["data" => $DrivingEntries]);
    }

    public function post(CreateDrivingEntryAction $action, DrivingEntryRequest $request)
    {
        return new DrivingEntryResource($action->execute($request->validated()));
    }

    public function get(int $DrivingEntryId, GetDrivingEntryAction $action)
    {
        return new DrivingEntryResource($action->execute($DrivingEntryId));
    }

    public function patch(int $DrivingEntryId, UpdateDrivingEntryAction $action, DrivingEntryRequest $request)
    {
        return new DrivingEntryResource($action->execute($DrivingEntryId, $request->validated()));
    }

    public function put(int $DrivingEntryId, UpdateDrivingEntryAction $action, DrivingEntryRequest $request)
    {
        return new DrivingEntryResource($action->execute($DrivingEntryId, $request->validated()));
    }

    public function delete(int $DrivingEntryId, DeleteDrivingEntryAction $action)
    {
        $action->execute($DrivingEntryId);
        return new EmptyResource();
    }
}