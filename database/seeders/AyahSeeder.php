<?php

namespace Database\Seeders;

use App\Models\Ayah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AyahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get('https://api.alquran.cloud/v1/quran/ar.alafasy');

        if ($response->successful()) {
            $data = $response->json();

            if (isset($data['data']['surahs'])) {
                foreach ($data['data']['surahs'] as $surah) {
                    foreach ($surah['ayahs'] as $ayah) {
                        // Convert sajda field properly
                        $sajda = is_array($ayah['sajda']) ? ($ayah['sajda']['id'] ?? 0) : ($ayah['sajda'] ? 1 : 0);

                        // Insert into database
                        DB::table('ayahs')->insert([
                            'ayah_number'   => $ayah['number'],
                            'surah_number'  => $surah['number'],
                            'text'          => $ayah['text'],
                            'audio'         => $ayah['audio'],
                            'number_in_surah' => $ayah['numberInSurah'],
                            'juz'           => $ayah['juz'],
                            'manzil'        => $ayah['manzil'],
                            'page'          => $ayah['page'],
                            'ruku'          => $ayah['ruku'],
                            'hizb_quarter'  => $ayah['hizbQuarter'],
                            'sajda'         => $sajda, // JSON encoding for correct insertion
                            'created_at'    => now(),
                            'updated_at'    => now(),
                        ]);
                    }
                }
                $this->command->info('Ayahs data inserted successfully.');
            } else {
                $this->command->error('Invalid API response format.');
            }
        } else {
            $this->command->error('Failed to fetch data from API.');
        }
    }
}
