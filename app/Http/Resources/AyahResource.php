<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AyahResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return [
        //     'id' => $this->id,
        //     'number' => $this->number,          
        //     'text' => $this->text,
        //     'data' => $this->whenPivotLoaded('ayah_edition', function () {
        //         return $this->pivot->data;
        //     }),            
        //     'is_audio' => $this->whenPivotLoaded('ayah_edition', function () {
        //         return $this->pivot->is_audio;
        //     }),
        //     'number_in_surah' => (int)$this->number_in_surah,

        //     'surah_id' => $this->surah_id,
        //     'surah' => new SurahResource($this->whenLoaded('surah')),

        //     'hizb_id' => $this->hizb_id,
        //     'hizb' => new HizbResource($this->whenLoaded('hizb')),

        //     'juz_id' => $this->juz_id,
        //     'juz' => new JuzResource($this->whenLoaded('juz')),
        // ];
        return [
            'id' => $this->id,
            'ayah_number' => $this->ayah_number,
            'text' => $this->text,
            'english_text' => $this->english_text,
            'urdu_text' => $this->urdu_text,
            'audio' => $this->audio,
            'number_in_surah' => (int)$this->number_in_surah,
            'juz' => (int)$this->juz,
            'manzil' => (int)$this->manzil,
            'page' => (int)$this->page,
            'ruku' => (int)$this->ruku,
            'hizb_quarter' => (int)$this->hizb_quarter,
            'sajda' => $this->sajda, // Ensure this is stored as a boolean in DB

            // Load related Surah
            'surah' => new SurahResource($this->whenLoaded('surah')),
        ];
    }
}
