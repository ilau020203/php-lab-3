<?php

namespace App\Http\Api\v1\Drivers\Controllers;

use App\Domains\Drivers\Actions\CreateDriverAction;
use App\Domains\Drivers\Actions\DeleteDriverAction;
use App\Domains\Drivers\Actions\GetAllDriversAction;
use App\Domains\Drivers\Actions\GetDriverAction;
use App\Domains\Drivers\Actions\UpdateDriverAction;
use App\Http\Api\v1\Drivers\Requests\DriverRequest;
use App\Http\Api\v1\Drivers\Requests\UpdateDriverRequest;
use App\Http\Api\v1\Drivers\Resources\DriverResource;
use App\Http\Api\v1\Helpers\Resources\EmptyResource;
use Illuminate\Routing\Controller;
class DriverController extends Controller
{
    public function getList(GetAllDriversAction $action)
    {
        $drivers = $action->execute();
        return response()->json(["data" => $drivers]);
    }

    public function post(CreateDriverAction $action, DriverRequest $request)
    {
        return new DriverResource($action->execute($request->validated()));
    }

    public function get(int $driverId, GetDriverAction $action)
    {
        return new DriverResource($action->execute($driverId));
    }

    public function patch(int $driverId, UpdateDriverAction $action, UpdateDriverRequest $request)
    {
        return new DriverResource($action->execute($driverId, $request->validated()));
    }

    public function put(int $driverId, UpdateDriverAction $action, DriverRequest $request)
    {
        return new DriverResource($action->execute($driverId, $request->validated()));
    }

    public function delete(int $driverId, DeleteDriverAction $action)
    {
        $action->execute($driverId);
        return new EmptyResource();
    }
}