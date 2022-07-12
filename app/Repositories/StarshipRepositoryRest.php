<?php

namespace App\Repositories;

use App\Models\Starship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StarshipRepositoryRest extends BaseRepository
{
    public function __construct(Starship $starship)
    {
        parent::__construct($starship);
    }

    public function all()
    {
        return Http::get('https://swapi.dev/api/starships/');
    }

    public function get(int $id)
    {
        return Http::get('https://swapi.dev/api/starships/' . $id . '/')->json();
    }

    public function getStarships(Request $request)
    {
        return Http::get('https://swapi.dev/api/starships', $request->query())->json();
    }
}