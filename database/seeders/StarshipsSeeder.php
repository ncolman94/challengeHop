<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class StarshipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->pageSeeder('https://swapi.dev/api/starships/');
    }

    public function pageSeeder(String $url)
    {

        $starships = Http::get($url)->json();
        foreach ($starships['results'] as $value) {
            DB::table('starship')->insert([
                'starship_id' => preg_replace('/[^0-9]+/', '', $value['url']),
                'name' => $value['name'],
                'count' => 0
            ]);
        }

        if ($starships['next']) {
            $this->pageSeeder($starships['next']);
        }
    }
}