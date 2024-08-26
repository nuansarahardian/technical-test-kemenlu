<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Negara;
use GuzzleHttp\Client;

class NegaraTableSeeder extends Seeder
{
    public function run()
    {
        $countries = [
            ['name' => 'MALAYSIA', 'code' => 'MY', 'id_kawasan' => 2, 'id_direktorat' => 1],
            ['name' => 'INDIA', 'code' => 'IN', 'id_kawasan' => 3, 'id_direktorat' => 1],
            ['name' => 'AMERIKA SERIKAT', 'code' => 'US', 'id_kawasan' => 4, 'id_direktorat' => 2],
            ['name' => 'BELANDA', 'code' => 'NL', 'id_kawasan' => 5, 'id_direktorat' => 2],
            ['name' => 'JERMAN', 'code' => 'DE', 'id_kawasan' => 6, 'id_direktorat' => 2],
            ['name' => 'ARGENTINA', 'code' => 'RA', 'id_kawasan' => 7, 'id_direktorat' => 2],
        ];

        foreach ($countries as $country) {
            $coordinates = $this->getCoordinates($country['name']);
            
            // Debug output
            if ($coordinates['latitude'] === null || $coordinates['longitude'] === null) {
                \Log::warning("Coordinates not found for country: " . $country['name']);
            }

            Negara::create([
                'nama_negara' => $country['name'],
                'kode_negara' => $country['code'],
                'id_kawasan' => $country['id_kawasan'],
                'id_direktorat' => $country['id_direktorat'],
                'latitude' => $coordinates['latitude'],
                'longitude' => $coordinates['longitude'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function getCoordinates($country)
    {
        $client = new Client();
        $apiKey = '67c414be95344d94b16d822e7427d459';
        try {
            $response = $client->get("https://api.opencagedata.com/geocode/v1/json", [
                'query' => [
                    'q' => $country,
                    'key' => $apiKey,
                    'limit' => 1,
                ],
                'verify' => false, // Nonaktifkan verifikasi SSL
            ]);
            

            $data = json_decode($response->getBody(), true);

            // Debug output
            \Log::info("API response for country '{$country}':", $data);

            if (!empty($data['results'])) {
                $geometry = $data['results'][0]['geometry'];
                return [
                    'latitude' => $geometry['lat'],
                    'longitude' => $geometry['lng'],
                ];
            }

            return [
                'latitude' => null,
                'longitude' => null,
            ];
        } catch (\Exception $e) {
            \Log::error("Error fetching coordinates for country '{$country}': " . $e->getMessage());
            return [
                'latitude' => null,
                'longitude' => null,
            ];
        }
    }
}
