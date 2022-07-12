<?php

namespace App\Repositories;

use App\Models\Starship;
use Illuminate\Http\Request;

class StarshipRepositoryLocal extends BaseRepository
{
    public function __construct(Starship $starship)
    {
        parent::__construct($starship);
    }

    public function getStarship(Request $request)
    {
        return $this->model->where('name', 'LIKE', "%{$request->search}%")->first();
    }

    public function getStarshipByName(string $name)
    {
        return $this->model->where('name', 'LIKE', "%{$name}%")->first();
    }

    public function getStarshipId(int $id)
    {
        return $this->model->where('starship_id', '=', "{$id}")->first();
    }

    public function all()
    {
        return $this->model->all();
    }
}