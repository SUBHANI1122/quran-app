<?php

namespace Database\Seeders;

use App\Models\Surah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;


class SurahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get('https://api.alquran.cloud/v1/surah');

        if ($response->successful()) {
            $surahs = $response->json()['data'];

            foreach ($surahs as $surah) {
                Surah::updateOrCreate(
                    ['number' => $surah['number']],
                    [
                        'name' => $surah['name'],
                        'english_name' => $surah['englishName'],
                        'english_name_translation' => $surah['englishNameTranslation'],
                        'number_of_ayahs' => $surah['numberOfAyahs'],
                        'revelation_type' => $surah['revelationType']
                    ]
                );
            }

            $this->command->info('Surahs imported successfully!');
        } else {
            $this->command->error('Failed to fetch Surahs from API.');
        }
    }
}
