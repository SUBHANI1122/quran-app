<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Surah;
use App\Models\Ayah;
use App\Models\Topic;
use App\Models\TopicAyah;
use App\Models\TopicHadith;

class TopicWizard extends Component
{
    public $step = 1;

    public $topic_name, $topic_alternative_name, $topic_description;
    public $selectedSurah, $selectedAyah, $ayahDescription;
    public $ayahsList = [];
    public $ayahs = [];

    public $hadithTextArabic, $hadithTextUrdu, $hadithTextEnglish, $hadithDescription;
    public $hadiths = [];

    public function updatedSelectedSurah()
    {
        if ($this->selectedSurah) {
            $this->ayahsList = Ayah::where('surah_number', $this->selectedSurah)->get()->toArray();
        } else {
            $this->ayahsList = [];
        }
        $this->selectedAyah = null;
    }

    public function nextStep()
    {
        if ($this->step === 1) {
            $this->validate([
                'topic_name' => 'required|string|max:255',
                'topic_alternative_name' => 'nullable|string|max:255',
                'topic_description' => 'required|string',
            ]);
        }

        if ($this->step < 3) {
            $this->step++;
        }
    }

    public function prevStep()
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function addAyah()
    {
        if ($this->selectedSurah && $this->selectedAyah && $this->ayahDescription) {
            $this->ayahs[] = [
                'surah_id' => $this->selectedSurah,
                'ayah_id' => $this->selectedAyah,
                'description' => $this->ayahDescription
            ];

            $this->selectedAyah = null;
            $this->ayahDescription = null;
        }
    }

    public function removeAyah($index)
    {
        unset($this->ayahs[$index]);
        $this->ayahs = array_values($this->ayahs);
    }

    public function addHadith()
    {
        if ($this->hadithTextArabic && $this->hadithTextUrdu && $this->hadithTextEnglish && $this->hadithDescription) {
            $this->hadiths[] = [
                'text_arabic' => $this->hadithTextArabic,
                'text_urdu' => $this->hadithTextUrdu,
                'text_english' => $this->hadithTextEnglish,
                'description' => $this->hadithDescription
            ];

            $this->hadithTextArabic = null;
            $this->hadithTextUrdu = null;
            $this->hadithTextEnglish = null;
            $this->hadithDescription = null;
        }
    }

    public function removeHadith($index)
    {
        unset($this->hadiths[$index]);
        $this->hadiths = array_values($this->hadiths);
    }

    public function saveTopic()
    {
        $topic = Topic::create([
            'name' => $this->topic_name,
            'alternative_name' => $this->topic_alternative_name,
            'description' => $this->topic_description,
        ]);

        foreach ($this->ayahs as $ayah) {
            TopicAyah::create([
                'topic_id' => $topic->id,
                'surah_id' => $ayah['surah_id'],
                'ayah_id' => $ayah['ayah_id'],
                'description' => $ayah['description'],
            ]);
        }

        foreach ($this->hadiths as $hadith) {
            TopicHadith::create([
                'topic_id' => $topic->id,
                'hadith_text_arabic' => $hadith['text_arabic'],
                'hadith_text_urdu' => $hadith['text_urdu'],
                'hadith_text_english' => $hadith['text_english'],
                'description' => $hadith['description'],
            ]);
        }

        session()->flash('message', 'Topic saved successfully!');
        return redirect()->route('topics.index');
    }

    public function render()
    {
        return view('livewire.topic-wizard', [
            'surahs' => Surah::all(),
        ]);
    }
}
