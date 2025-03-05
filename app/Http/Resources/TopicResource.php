<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TopicResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'alternative_name' => $this->alternative_name,
            'description' => $this->description,
            'ayahs' => $this->ayahs->map(function ($ayah) {
                return [
                    'id' => $ayah->id,
                    'surah_id' => $ayah->ayah->surah_number,
                    'ayah_text' => $ayah->ayah->text,
                    'description' => $ayah->description
                ];
            }),
            'hadiths' => $this->hadiths->map(function ($hadith) {
                return [
                    'id' => $hadith->id,
                    'text_arabic' => $hadith->hadith_text_arabic,
                    'text_urdu' => $hadith->hadith_text_urdu,
                    'text_english' => $hadith->hadith_text_english,
                    'description' => $hadith->description
                ];
            }),
        ];
    }
}
