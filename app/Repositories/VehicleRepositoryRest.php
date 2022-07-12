<?php

namespace App\Repositories;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VehicleRepositoryRest extends BaseRepository
{
    public function __construct(Vehicle $vehicle)
    {
        parent::__construct($vehicle);
    }

    public function all()
    {
        return Http::get('https://swapi.dev/api/vehicles/');
    }

    public function get(int $id)
    {
        return Http::get('https://swapi.dev/api/vehicles/' . $id . '/')->json();
    }

    public function getVehicles(Request $request)
    {
        return Http::get('https://swapi.dev/api/vehicles', $request->query())->json();
    }
}