<?php

namespace App\Services;

use App\Http\Request\UpdateStarshipRequest;
use App\Http\Request\CreateStarshipRequest;
use App\Models\Starship;
use App\Repositories\StarshipRepositoryLocal;
use App\Repositories\StarshipRepositoryRest;
use Illuminate\Http\Request;

class StarshipService
{
    private $starshipRepositoryRest;
    private $starshipRepositoryLocal;

    public function __construct(StarshipRepositoryRest $starshipRepositoryRest, StarshipRepositoryLocal $starshipRepositoryLocal)
    {
        $this->starshipRepositoryRest = $starshipRepositoryRest;
        $this->starshipRepositoryLocal = $starshipRepositoryLocal;
    }

    public function save(Request $request, int $id)
    {
        $starship = $this->starshipRepositoryRest->get($id);
        $starshipInventory = new Starship();
        $starshipInventory->starship_id = $id;
        $starshipInventory->name = $starship['name'];
        $starshipInventory->count = $request['count'];
        $this->starshipRepositoryLocal->save($starshipInventory);
    }

    public function update(Request $request, int $id)
    {
        $starshipLocal = $this->starshipRepositoryLocal->getStarshipId($id);
        $starshipLocal->count = $request['count'];
        $this->starshipRepositoryLocal->save($starshipLocal);
    }

    public function increment(int $id)
    {
        $starshipLocal = $this->starshipRepositoryLocal->getStarshipId($id);
        $starshipLocal->increment('count', 1);
        $this->starshipRepositoryLocal->save($starshipLocal);
    }

    public function decrement(int $id)
    {
        $starshipLocal = $this->starshipRepositoryLocal->getStarshipId($id);
        if ($starshipLocal->count > 0) {
            $starshipLocal->decrement('count', 1);
        }
        $this->starshipRepositoryLocal->save($starshipLocal);
    }

    public function all()
    {
        $starshipsLocal = $this->starshipRepositoryLocal->all();
        $starships = [];
        foreach ($starshipsLocal as $starship) {
            $starshipsArray = $this->starshipRepositoryRest->get($starship->starship_id);
            $starshipsArray['count'] = $starship->count;
            array_push($starships, $starshipsArray);
        }
        return $starships;
    }

    public function getStarships(Request $request)
    {
        $starshipsRest = $this->starshipRepositoryRest->getStarships($request);
        $starships = [];
        foreach ($starshipsRest['results'] as $starship) {
            $localStarship = $this->starshipRepositoryLocal->getStarshipByName($starship['name']);
            $starship['count'] = $localStarship->count;
            array_push($starships, $starship);
        }
        $starshipsRest['results'] = $starships;

        return $starshipsRest;
    }

    public function getStarship(int $id)
    {
        $starshipLocal = $this->starshipRepositoryLocal->getStarshipId($id);
        $starshipRest = $this->starshipRepositoryRest->get($starshipLocal->starship_id);
        $starshipRest['count'] = $starshipLocal->count;
        return $starshipRest;
    }

    public function get(int $id)
    {
        return $this->starshipRepositoryLocal->get($id);
    }

    public function saveFromRequest(CreateStarshipRequest $request)
    {
        $starship = new Starship($request->all());
        $this->starshipRepositoryLocal->save($starship);
        return $starship;
    }

    public function updateFromRequest(UpdateStarshipRequest $request, Starship $starship)
    {
        $starship->fill($request->all());
        $this->starshipRepositoryLocal->save($starship);
        return $starship;
    }

    public function delete(Starship $starship)
    {
        $this->starshipRepositoryLocal->delete($starship);
        return $starship;
    }
}