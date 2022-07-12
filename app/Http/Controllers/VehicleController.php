<?php

namespace App\Http\Controllers;

use App\Services\VehicleService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class VehicleController extends Controller
{
    private $vehicleService;

    public function __construct(VehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    public function index()
    {
        $response = $this->vehicleService->all();
        return $response;
    }

    public function store(Request $request, $id)
    {
        try {
            $vehicleService = $this->vehicleService->save($request, $id);
            return \Response()->json(['res' => true, 'message' => 'El inventario de vehículos fue creado correctamente'], 200);
        } catch (\Exception $e) {
            return \Response()->json(['res' => false, 'message' => $e->getMessage()], 422);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $vehicleService = $this->vehicleService->update($request, $id);
            return \Response()->json(['res' => true, 'message' => 'El inventario de vehículos fue modificado correctamente'], 200);
        } catch (\Exception $e) {
            return \Response()->json(['res' => false, 'message' => $e->getMessage()], 422);
        }
    }

    public function increment($id)
    {
        try {
            $vehicleService = $this->vehicleService->increment($id);
            return \Response()->json(['res' => true, 'message' => 'El inventario de vehículos fue modificado correctamente'], 200);
        } catch (\Exception $e) {
            return \Response()->json(['res' => false, 'message' => $e->getMessage()], 422);
        }
    }

    public function decrement($id)
    {
        try {
            $vehicleService = $this->vehicleService->decrement($id);
            return \Response()->json(['res' => true, 'message' => 'El inventario de vehículos fue modificado correctamente'], 200);
        } catch (\Exception $e) {
            return \Response()->json(['res' => false, 'message' => $e->getMessage()], 422);
        }
    }

    public function getVehicles(Request $request)
    {
        try {
            $vehicle = $this->vehicleService->getVehicles($request);
            return \Response()->json(['data' => $vehicle], 200);
        } catch (\Exception $e) {
            return \Response()->json(['res' => false, 'message' => $e->getMessage()], 422);
        }
    }

    public function getVehicle(int $id)
    {
        try {
            $vehicle = $this->vehicleService->getVehicle($id);
            return \Response()->json(['data' => $vehicle], 200);
        } catch (\Exception $e) {
            return \Response()->json(['res' => false, 'message' => $e->getMessage()], 422);
        }
    }
}