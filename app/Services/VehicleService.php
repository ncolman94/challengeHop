<?php

namespace App\Services;

use App\Http\Request\UpdateVehicleRequest;
use App\Http\Request\CreateVehicleRequest;
use App\Models\Vehicle;
use App\Repositories\VehicleRepositoryLocal;
use App\Repositories\VehicleRepositoryRest;
use Illuminate\Http\Request;

class VehicleService
{
    private $vehicleRepositoryRest;
    private $vehicleRepositoryLocal;

    public function __construct(VehicleRepositoryRest $vehicleRepositoryRest, VehicleRepositoryLocal $vehicleRepositoryLocal)
    {
        $this->vehicleRepositoryRest = $vehicleRepositoryRest;
        $this->vehicleRepositoryLocal = $vehicleRepositoryLocal;
    }

    public function save(Request $request, int $id)
    {
        $vehicleRest = $this->vehicleRepositoryRest->get($id);
        $vehicle = new Vehicle();
        $vehicle->vehicle_id = $id;
        $vehicle->name = $vehicleRest['name'];
        $vehicle->count = $request['count'];
        $this->vehicleRepositoryLocal->save($vehicle);
    }

    public function update(Request $request, int $id)
    {
        $vehicleLocal = $this->vehicleRepositoryLocal->getVehicleId($id);
        $vehicleLocal->count = $request['count'];
        $this->vehicleRepositoryLocal->save($vehicleLocal);
    }

    public function increment(int $id)
    {
        $vehicleLocal = $this->vehicleRepositoryLocal->getVehicleId($id);
        $vehicleLocal->increment('count', 1);
        $this->vehicleRepositoryLocal->save($vehicleLocal);
    }

    public function decrement(int $id)
    {
        $vehicleLocal = $this->vehicleRepositoryLocal->getVehicleId($id);
        if ($vehicleLocal->count > 0) {
            $vehicleLocal->decrement('count', 1);
        }
        $this->vehicleRepositoryLocal->save($vehicleLocal);
    }

    public function all()
    {
        $vehiclesLocal = $this->vehicleRepositoryLocal->all();
        $vehicles = [];
        foreach ($vehiclesLocal as $vehicle) {
            $vehicleArray = $this->vehicleRepositoryRest->get($vehicle->vehicle_id);
            $vehicleArray['count'] = $vehicle->count;
            array_push($vehicles, $vehicleArray);
        }
        return $vehicles;
    }

    public function getVehicles(Request $request)
    {
        $vehicleRest = $this->vehicleRepositoryRest->getVehicles($request);
        $vehicles = [];
        foreach ($vehicleRest['results'] as $vehicle) {
            $localVehicle = $this->vehicleRepositoryLocal->getVehicleByName($vehicle['name']);
            $vehicle['count'] = $localVehicle->count;
            array_push($vehicles, $vehicle);
        }
        $vehicleRest['results'] = $vehicles;

        return $vehicleRest;
    }

    public function getVehicle(int $id)
    {
        $vehicle = $this->vehicleRepositoryLocal->getVehicleId($id);
        $vehicleRest = $this->vehicleRepositoryRest->get($vehicle->vehicle_id);
        $vehicleRest['count'] = $vehicle->count;
        return $vehicleRest;
    }

    public function getVehicleByName(Request $request)
    {
        $vehicleLocal = $this->vehicleRepositoryLocal->getVehicle($request);
        $vehicleRest = $this->vehicleRepositoryRest->get($vehicleLocal->vehicle_id);
        $vehicleRest['count'] = $vehicleLocal->count;
        return $vehicleRest;
    }

    public function get(int $id)
    {
        return $this->vehicleRepositoryLocal->get($id);
    }

    public function saveFromRequest(CreateVehicleRequest $request)
    {
        $vehicle = new Vehicle($request->all());
        $this->vehicleRepositoryLocal->save($vehicle);
        return $vehicle;
    }

    public function updateFromRequest(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        $vehicle->fill($request->all());
        $this->vehicleRepositoryLocal->save($vehicle);
        return $vehicle;
    }

    public function delete(Vehicle $vehicle)
    {
        $this->vehicleRepositoryLocal->delete($vehicle);
        return $vehicle;
    }
}