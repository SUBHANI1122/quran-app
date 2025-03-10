<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AyahEnglishTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get('https://api.alquran.cloud/v1/quran/en.asad');

        if ($response->successful()) {
            $data = $response->json();

            if (isset($data['data']['surahs'])) {
                foreach ($data['data']['surahs'] as $surah) {
                    foreach ($surah['ayahs'] as $ayah) {
                        // Update the existing ayah with its English translation
                        DB::table('ayahs')
                            ->where('ayah_number', $ayah['number'])
                            ->update([
                                'english_text' => $ayah['text'], // Save English translation
                                'updated_at' => now(),
                            ]);
                    }
                }
                $this->command->info('English translation added successfully.');
            } else {
                $this->command->error('Invalid API response format.');
            }
        } else {
            $this->command->error('Failed to fetch English translation from API.');
        }
    }
}
