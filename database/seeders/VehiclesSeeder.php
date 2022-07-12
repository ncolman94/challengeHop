<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class VehiclesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->pageSeeder('https://swapi.dev/api/vehicles/');
    }

    public function pageSeeder(String $url)
    {

        $vehicles = Http::get($url)->json();
        foreach ($vehicles['results'] as $value) {
            DB::table('vehicles')->insert([
                'vehicle_id' => preg_replace('/[^0-9]+/', '', $value['url']),
                'name' => $value['name'],
                'count' => 0
            ]);
        }

        if ($vehicles['next']) {
            $this->pageSeeder($vehicles['next']);
        }
    }
}