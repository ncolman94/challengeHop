<?php

namespace App\Repositories;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleRepositoryLocal extends BaseRepository
{
    public function __construct(Vehicle $vehicle)
    {
        parent::__construct($vehicle);
    }

    public function getVehicle(Request $request)
    {
        return $this->model->where('name', 'LIKE', "%{$request->search}%")->first();
    }

    public function getVehicleByName(string $name)
    {
        return $this->model->where('name', 'LIKE', "%{$name}%")->first();
    }

    public function getVehicleId(int $id)
    {
        return $this->model->where('vehicle_id', '=', "{$id}")->first();
    }

    public function all()
    {
        return $this->model->all();
    }
}