<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use Illuminate\Support\Facades\File;

class CitySeeder extends Seeder
{
    public function run()
{
    $json = file_get_contents(database_path('data/cities.json'));
    $data = json_decode($json, true);

    // Ambil array dari key "data"
    foreach ($data as $entry) {
        // Hanya proses yang memiliki key "data"
        if ($entry['type'] === 'table' && isset($entry['data'])) {
            foreach ($entry['data'] as $city) {
                \App\Models\City::create([
                    'id_kota' => $city['city_id'],
                    'nama_kota' => $city['city_name'],
                    'id_provinsi' => $city['prov_id'],
                ]);
            }
        }
    }
}

}
