<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SurahResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'number' => $this->number,
            'name' => $this->name,
            'english_name' => $this->english_name,
            'english_name_translation' => $this->english_name_translation,
            'number_of_ayahs' => (int)$this->number_of_ayahs,
            'revelation_type' => $this->revelation_type,

            // Load related Ayahs
            'ayahs' => AyahResource::collection($this->whenLoaded('ayahs')),
        ];
    }
}
