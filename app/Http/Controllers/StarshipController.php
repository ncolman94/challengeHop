<?php

namespace App\Http\Controllers;

use App\Services\StarshipService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class StarshipController extends Controller
{
    private $starshipService;

    public function __construct(StarshipService $starshipService)
    {
        $this->starshipService = $starshipService;
    }

    public function index()
    {
        $response = $this->starshipService->all();
        return $response;
    }

    public function store(Request $request, $id)
    {
        try {
            $starshipService = $this->starshipService->save($request, $id);
            return \Response()->json(['res' => true, 'message' => 'El inventario de naves espaciales se creó correctamente'], 200);
        } catch (\Exception $e) {
            return \Response()->json(['res' => false, 'message' => $e->getMessage()], 422);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $starshipService = $this->starshipService->update($request, $id);
            return \Response()->json(['res' => true, 'message' => 'El inventario de naves espaciales fue modificado correctamente'], 200);
        } catch (\Exception $e) {
            return \Response()->json(['res' => false, 'message' => $e->getMessage()], 422);
        }
    }

    public function increment($id)
    {
        try {
            $starshipService = $this->starshipService->increment($id);
            return \Response()->json(['res' => true, 'message' => 'El inventario de naves espaciales fue modificado correctamente'], 200);
        } catch (\Exception $e) {
            return \Response()->json(['res' => false, 'message' => $e->getMessage()], 422);
        }
    }

    public function decrement($id)
    {
        try {
            $starshipService = $this->starshipService->decrement($id);
            return \Response()->json(['res' => true, 'message' => 'El Inventario de naves espaciales fue modificado correctamente'], 200);
        } catch (\Exception $e) {
            return \Response()->json(['res' => false, 'message' => $e->getMessage()], 422);
        }
    }

    public function getStarships(Request $request)
    {
        try {
            $starship = $this->starshipService->getStarships($request);
            return \Response()->json(['data' => $starship], 200);
        } catch (\Exception $e) {
            return \Response()->json(['res' => false, 'message' => $e->getMessage()], 422);
        }
    }

    public function getStarship(int $id)
    {
        try {
            $starship = $this->starshipService->getStarship($id);
            return \Response()->json(['data' => $starship], 200);
        } catch (\Exception $e) {
            return \Response()->json(['res' => false, 'message' => $e->getMessage()], 422);
        }
    }
}