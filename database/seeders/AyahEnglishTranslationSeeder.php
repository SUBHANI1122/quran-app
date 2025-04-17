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
        // Fetch English translation
        $englishResponse = Http::get('https://api.alquran.cloud/v1/quran/en.asad');
        // Fetch Urdu translation
        $urduResponse = Http::get('https://api.alquran.cloud/v1/quran/ur.ahmedali');
    
        if ($englishResponse->successful() && $urduResponse->successful()) {
            $englishData = $englishResponse->json();
            $urduData = $urduResponse->json();
    
            if (isset($englishData['data']['surahs']) && isset($urduData['data']['surahs'])) {
                foreach ($englishData['data']['surahs'] as $surahIndex => $englishSurah) {
                    $urduSurah = $urduData['data']['surahs'][$surahIndex];
    
                    foreach ($englishSurah['ayahs'] as $ayahIndex => $englishAyah) {
                        $urduAyah = $urduSurah['ayahs'][$ayahIndex];
    
                        // Update the ayah with both English and Urdu translations
                        DB::table('ayahs')
                            ->where('ayah_number', $englishAyah['number']) // assumes global ayah number
                            ->update([
                                'english_text' => $englishAyah['text'],
                                'urdu_text' => $urduAyah['text'],
                                'updated_at' => now(),
                            ]);
                    }
                }
    
                $this->command->info('English and Urdu translations added successfully.');
            } else {
                $this->command->error('Invalid API response format.');
            }
        } else {
            $this->command->error('Failed to fetch translation(s) from API.');
        }
    }
    
}
